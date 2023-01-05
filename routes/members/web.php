<?php

use App\Http\Controllers\Auth\MemberAuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Members Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your admin side of the application.
|
*/

Route::group(['prefix' => 'member', 'as' => 'member.'], function () {

    Route::get('/auth/login', [MemberAuthController::class, 'showLoginForm'])->name('login');

    // /**
    //  * Authentication routes
    //  */
    // Route::prefix('auth')->group(function () {
    //     Route::get('/login', [MemberAuthController::class, 'showLoginForm'])->middleware('guest:admin')->name('login');
    //     Route::post('/login', [MemberAuthController::class, 'login'])->middleware('guest:admin');

    //     Route::post('/logout', [MemberAuthController::class, 'logout'])->middleware('auth:admin')->name('logout');
    // });

    // /**
    //  * Authenticated routes
    //  * Members must be authenticated to enter this routes.
    //  */
    // Route::middleware('auth:member')->group(function () {

    // });
});
