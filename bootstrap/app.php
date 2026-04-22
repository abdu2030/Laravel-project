<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'employer'=>\App\Http\Middleware\Employer::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

if (isset($_ENV['VERCEL']) || isset($_SERVER['VERCEL'])) {
    $appStorage = '/tmp/storage';
    if (!is_dir($appStorage)) {
        mkdir($appStorage, 0777, true);
        mkdir($appStorage . '/framework/cache/data', 0777, true);
        mkdir($appStorage . '/framework/views', 0777, true);
        mkdir($appStorage . '/framework/sessions', 0777, true);
        mkdir($appStorage . '/logs', 0777, true);
    }
    $app->useStoragePath($appStorage);
}

return $app;
