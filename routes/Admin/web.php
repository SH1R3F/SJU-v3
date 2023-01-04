<?php

use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\RoleController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your admin side of the application.
|
*/

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {


    /**
     * Authentication routes
     */
    Route::prefix('auth')->group(function () {
        Route::get('/login', [AuthController::class, 'showLoginForm'])->middleware('guest:admin')->name('login');
        Route::post('/login', [AuthController::class, 'login'])->middleware('guest:admin');

        Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:admin')->name('logout');
    });

    /**
     * Authenticated routes
     * Admin mus be authenticated to enter this routes.
     */
    Route::middleware('auth:admin')->group(function () {
        Route::get('/', function () {
            return inertia('Admin/Dashboard');
        })->name('dashboard');

        /* Roles Management */
        Route::resource('roles', RoleController::class)->except(['create', 'edit', 'show']);
    });
});
