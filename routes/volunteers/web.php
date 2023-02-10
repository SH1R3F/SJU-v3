<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\VolunteerAuthController;
use App\Http\Controllers\Volunteer\ForgotPasswordController;
use App\Http\Controllers\Volunteer\VolunteerController;

/*
|--------------------------------------------------------------------------
| Web Volunteers Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your volunteers side of the application.
|
*/

Route::group(['prefix' => 'volunteers', 'as' => 'volunteer.'], function () {

    /**
     * Authentication routes
     */
    Route::prefix('auth')->middleware('guest:member,subscriber,volunteer')->group(function () {
        Route::get('/login', [VolunteerAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [VolunteerAuthController::class, 'login']);

        Route::get('/register', [VolunteerAuthController::class, 'showRegisterForm'])->name('register');
        Route::post('/register', [VolunteerAuthController::class, 'register']);


        /**
         * Forgot password routes
         */
        Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
        Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
        Route::get('/password/reset/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
        Route::post('/password/reset', [ForgotPasswordController::class, 'reset'])->name('password.change');
    });


    /**
     * Authenticated volunteer routes
     */
    Route::group(['middleware' => ['auth:volunteer']], function () {
        // Logout route
        Route::post('auth/logout', [VolunteerAuthController::class, 'logout'])->name('logout');

        /**
         * Verification routes
         */
        Route::prefix('email')->group(function () {
            Route::post('/verification-notification', [VolunteerAuthController::class, 'send'])->middleware('throttle:6,1')->name('verification.send');
            Route::get('/verify-email/{id}/{hash}', [VolunteerAuthController::class, 'verifyEmail'])->name('verification.verify');
            Route::get('/verify-email', [VolunteerAuthController::class, 'notice'])->name('verification.notice');
        });


        /**
         * Volunteer homepage
         * Displays notifications
         */
        Route::redirect('/', '/volunteers/courses')->name('home');

        Route::middleware('verified')->group(function () {
            /**
             * My Courses
             * Displays current registered courses and upcoming courses
             */
            Route::get('/', [VolunteerController::class, 'courses'])->middleware('volunteer-has-branch');
            Route::get('/courses', [VolunteerController::class, 'courses'])->name('courses');

            /**
             * Profile page
             */
            Route::prefix('profile')->group(function () {
                Route::get('/', [VolunteerController::class, 'info'])->name('profile.info');
                Route::post('/', [VolunteerController::class, 'postInfo']);

                Route::get('/password', [VolunteerController::class, 'password'])->name('profile.password');
                Route::post('/password', [VolunteerController::class, 'postPassword']);
            });
        });
    });
});
