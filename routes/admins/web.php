<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\MemberController;

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

        /**
         * Admins Management
         */
        // Send notification to admins
        Route::get('admins/notify', [AdminController::class, 'showNotifyForm'])->name('admins.notify');
        Route::post('admins/notify', [AdminController::class, 'notify']);

        // Manage admin resource
        Route::get('admins/export', [AdminController::class, 'export'])->name('admins.export');
        Route::post('admins/{admin}/toggle', [AdminController::class, 'toggle'])->name('admins.toggle');
        Route::resource('admins', AdminController::class);

        /**
         * Members management
         */
        Route::post('members/{member}/toggle', [MemberController::class, 'toggle'])->name('members.toggle');
        Route::get('/members/{member}/contact', [MemberController::class, 'showContact'])->name('members.show.contact');
        Route::get('/members/{member}/experiences', [MemberController::class, 'showExperiences'])->name('members.show.experiences');
        Route::get('/members/{member}/documents', [MemberController::class, 'showDocuments'])->name('members.show.documents');
        Route::resource('members', MemberController::class);
    });
});
