<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use PDO;

class MigrateToCloud extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:migrate-to-cloud';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate local MySQL database tables and data to Supabase PostgreSQL or other cloud database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("==============================================");
        $this->info("   Laravel Local to Cloud Database Migrator   ");
        $this->info("==============================================");

        // 1. Gather connection credentials
        $connection = env('CLOUD_DB_CONNECTION') ?: $this->ask('Target cloud database connection type (mysql/pgsql)', 'pgsql');
        $host = env('CLOUD_DB_HOST') ?: $this->ask('Target cloud database host (e.g. aws-0-us-east-1.pooler.supabase.com)');
        $port = env('CLOUD_DB_PORT') ?: $this->ask('Target cloud database port', '5432');
        $database = env('CLOUD_DB_DATABASE') ?: $this->ask('Target cloud database name', 'postgres');
        $username = env('CLOUD_DB_USERNAME') ?: $this->ask('Target cloud database username (e.g. postgres.your-id)');
        $password = env('CLOUD_DB_PASSWORD') ?: $this->secret('Target cloud database password');

        if (empty($host) || empty($username) || empty($password)) {
            $this->error("Error: Database host, username, and password are required!");
            return Command::FAILURE;
        }

        $this->info("Connecting to target cloud database...");

        // 2. Configure the dynamic database connection
        $config = [
            'driver' => $connection,
            'host' => $host,
            'port' => $port,
            'database' => $database,
            'username' => $username,
            'password' => $password,
            'prefix' => '',
            'prefix_indexes' => true,
        ];

        if ($connection === 'pgsql') {
            $config['charset'] = 'utf8';
            $config['search_path'] = 'public';
            $config['sslmode'] = 'require'; // Supabase requires SSL!
        } else {
            $config['charset'] = 'utf8mb4';
            $config['collation'] = 'utf8mb4_unicode_ci';
            $config['strict'] = true;
            $config['engine'] = null;
        }

        config(['database.connections.cloud' => $config]);

        // 3. Test target connection
        try {
            DB::connection('cloud')->getPdo();
            $this->info("Successfully connected to the cloud database!");
        } catch (\Exception $e) {
            $this->error("Failed to connect to the cloud database!");
            $this->error($e->getMessage());
            return Command::FAILURE;
        }

        // 4. Run migrations on the cloud database
        $this->info("\nRunning migrations on the cloud database to prepare schemas...");
        try {
            Artisan::call('migrate', [
                '--database' => 'cloud',
                '--force' => true,
            ]);
            $this->line(Artisan::output());
            $this->info("Database migrations completed successfully on the cloud database!");
        } catch (\Exception $e) {
            $this->error("Failed to run migrations on the cloud database!");
            $this->error($e->getMessage());
            return Command::FAILURE;
        }

        // 5. Migrate Data Table by Table
        // Core tables listed in forward order (satisfying constraints if FK checks enabled)
        $tables = ['users', 'employers', 'job', 'job_applications'];

        $this->info("\nStarting data migration... Truncating and copying tables...");

        try {
            // Disable foreign key constraints dynamically
            if ($connection === 'pgsql') {
                try {
                    DB::connection('cloud')->statement("SET session_replication_role = 'replica';");
                } catch (\Exception $e) {
                    $this->warn("Could not set session_replication_role, will rely on delete/insert ordering.");
                }
            } else {
                DB::connection('cloud')->statement("SET FOREIGN_KEY_CHECKS = 0;");
            }

            // Truncate/delete remote tables in REVERSE order to respect constraints
            $reverseTables = array_reverse($tables);
            foreach ($reverseTables as $table) {
                $this->line("Cleaning table '$table' in cloud database...");
                DB::connection('cloud')->table($table)->delete();
            }

            // Copy data in FORWARD order
            foreach ($tables as $table) {
                // Get local count
                $localCount = DB::table($table)->count();
                $this->info("Migrating table '$table' ($localCount records from local)...");

                if ($localCount === 0) {
                    $this->line("Skipping '$table' (no records).");
                    continue;
                }

                $bar = $this->output->createProgressBar($localCount);
                $bar->start();

                DB::table($table)->orderBy('id')->chunk(100, function ($rows) use ($table, $bar) {
                    $insertData = [];
                    foreach ($rows as $row) {
                        $insertData[] = (array) $row;
                    }
                    DB::connection('cloud')->table($table)->insert($insertData);
                    $bar->advance(count($rows));
                });

                $bar->finish();
                $this->newLine();
            }

            // Re-enable foreign keys
            if ($connection === 'pgsql') {
                try {
                    DB::connection('cloud')->statement("SET session_replication_role = 'origin';");
                } catch (\Exception $e) {
                    // Ignore
                }
            } else {
                DB::connection('cloud')->statement("SET FOREIGN_KEY_CHECKS = 1;");
            }

            $this->info("\n==============================================");
            $this->info("   SUCCESS! Data migration completed!         ");
            $this->info("==============================================");
            $this->info("All tables migrated to your cloud database!");
            $this->info("Next Steps:");
            $this->info("1. Set DB_CONNECTION=pgsql in your Vercel Environment Variables");
            $this->info("2. Set DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD in Vercel.");
            $this->info("3. Try running your local app against the cloud database to confirm!");

        } catch (\Exception $e) {
            $this->error("\nMigration failed during copying!");
            $this->error($e->getMessage());

            // Try to re-enable foreign keys in case of error
            try {
                if ($connection === 'pgsql') {
                    DB::connection('cloud')->statement("SET session_replication_role = 'origin';");
                } else {
                    DB::connection('cloud')->statement("SET FOREIGN_KEY_CHECKS = 1;");
                }
            } catch (\Exception $ex) {
                // Ignore
            }

            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
