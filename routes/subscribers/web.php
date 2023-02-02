<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Member\MemberController;
use App\Http\Controllers\Member\ProfileController;
use App\Http\Controllers\Auth\SubscriberAuthController;
use App\Http\Controllers\Subscriber\SubscriberController;

/*
|--------------------------------------------------------------------------
| Web Subscribers Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your subscribers side of the application.
|
*/

Route::group(['prefix' => 'subscribers', 'as' => 'subscriber.'], function () {

    /**
     * Authentication routes
     */
    Route::prefix('auth')->middleware('guest:member,subscriber,volunteer')->group(function () {
        Route::get('/login', [SubscriberAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [SubscriberAuthController::class, 'login']);

        Route::get('/register', [SubscriberAuthController::class, 'showRegisterForm'])->name('register');
        Route::post('/register', [SubscriberAuthController::class, 'register']);

        /**
         * Forgot password routes
         * TO BE ADDED
         */
    });


    /**
     * Authenticated subscriber routes
     */
    Route::group(['middleware' => ['auth:subscriber']], function () {
        // Logout route
        Route::post('auth/logout', [SubscriberAuthController::class, 'logout'])->name('logout');

        /**
         * Subscriber homepage
         * Displays notifications
         */
        Route::redirect('/', '/subscribers/courses')->name('home');

        /**
         * My Courses
         * Displays current registered courses and upcoming courses
         */
        Route::get('/courses', [SubscriberController::class, 'courses'])->name('courses');

        /**
         * Profile page
         */
        Route::prefix('profile')->group(function () {
            Route::get('/', [SubscriberController::class, 'info'])->name('profile.info');
            Route::post('/', [SubscriberController::class, 'postInfo']);

            Route::get('/password', [SubscriberController::class, 'password'])->name('profile.password');
            Route::post('/password', [SubscriberController::class, 'postPassword']);
        });
    });
});
