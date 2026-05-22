<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\MyJobApplicationController;
use App\Http\Controllers\MyJobController;
use Illuminate\Support\Facades\Route;

// Landing page (home)
Route::get('/', fn() => view('landing'))->name('landing');

// Job listings
Route::resource('jobs', JobController::class)
    ->only(['index', 'show']);

// Auth: Login
Route::get('login', fn() => to_route('Auth.create'))->name('login');
Route::resource('Auth', AuthController::class)
    ->only(['create', 'store']);

// Auth: Register
Route::get('register', [AuthController::class, 'showRegister'])->name('register');
Route::post('register', [AuthController::class, 'register'])->name('register.store');

// Auth: Logout
Route::delete('logout', fn() => to_route('Auth.destroy'))->name('logout');
Route::delete('Auth', [AuthController::class, 'destroy'])
    ->name('Auth.destroy');

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::resource('job.application', JobApplicationController::class)
        ->only(['create', 'store']);

    Route::resource('my-job-application', MyJobApplicationController::class)
        ->only(['index', 'destroy']);

    Route::resource('employer', EmployerController::class)
        ->only(['create', 'store']);

    Route::middleware('employer')
        ->resource('my-jobs', MyJobController::class)
        ->except(['show']);
});
