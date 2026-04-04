# Deploying Your Laravel App on Vercel

Vercel is an incredible platform designed specifically for the frontend web. Although it natively operates on Node.js and static generators, we have successfully configured this monolithic Laravel app to deploy on Vercel seamlessly using the `vercel-php` community builder!

Here is your step-by-step guide to get your application live.

## Prerequisites
1. A [Vercel](https://vercel.com) account.
2. Your project source code must reside on a Git provider (e.g., GitHub, GitLab, or Bitbucket) so Vercel can automatically build from it.
3. An externally hosted MySQL or PostgreSQL database (Vercel does not host databases directly - consider **Supabase**, **PlanetScale**, **Neon**, or **AWS RDS**).

---

## Deployment Steps

### 1. Push to GitHub
Ensure all recent changes you made (including the `vercel.json` and `api/index.php` files we just created) are committed and pushed to your chosen Git provider.

### 2. Import your Repository on Vercel
1. Log in to your Vercel Dashboard.
2. Click the **"Add New..."** button, then select **"Project"**.
3. Locate your Git repository and click **"Import"**.

### 3. Configure the Project Setup
Before hitting "Deploy", you must configure a specific setting for Laravel.

- **Framework Preset**: Vercel might automatically try to guess the framework. Switch it to **Other**.
- **Root Directory**: Leave it as `./` (the default).
- **Build and Output Settings**: Expand this section.
  - Set the `Build Command` to: `npm run build` or `npm install && npm run build` (This tells Vite to compile any frontend assets).
  - Set the `Output Directory` to: `public`

### 4. Create your Environment Variables
In the **Environment Variables** section before deploying, you need to add your necessary `.env` variables from Laravel. 

The most important ones are:

> [!IMPORTANT]
> - `APP_KEY`: Your application key (e.g., `base64:xxx...`). You can find this in your local `.env`.
> - `APP_ENV`: Set it to `production`.
> - `APP_URL`: The URL provided by Vercel when deployed. You may need to edit this setting *after* the first deployment once Vercel gives you your custom `.vercel.app` domain.
> - `DB_CONNECTION`: e.g., `mysql` or `pgsql`.
> - `DB_HOST`: Database hosting URL (from Supabase/Planetscale).
> - `DB_PORT`: e.g., `3306` or `5432`.
> - `DB_DATABASE`: Your database name.
> - `DB_USERNAME`: Database username.
> - `DB_PASSWORD`: Database password.

### 5. Deploy
Click the **Deploy** button. Vercel will pull your code, install dependencies (managed under the hood by `vercel-php` for composer and building `public`), and start up your function.

---

## Post-Deployment Actions

**Database Migrations & Seeding:**
Because Vercel is a serverless platform, it spins down your environment when inactive. It is not suitable to run `php artisan migrate` securely via SSH on Vercel. 
Instead, you must connect to your remote database (e.g., Supabase, Neon) locally, and run your migrations from your computer pointing towards the remote database:

1. Update your local `.env` briefly to point to the remote production database.
2. Run `php artisan migrate --force` locally.
3. *(Optional)* Run `php artisan db:seed --force`.
4. Revert your local `.env` back to your local development database.

> [!TIP]
> **Vercel Edge Functions**
> Standard sessions (`file`-based) will fail on Vercel because the filesystem is read-only in production. You must configure Laravel to use a database, Redis, or cookies for sessions. Update your `SESSION_DRIVER` env variable appropriately (usually `cookie` or `database`).

Congratulations! The beautiful new Job Board is now live efficiently on Vercel Edge Networks!
