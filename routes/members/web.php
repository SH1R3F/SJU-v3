<?php

use App\Http\Controllers\Auth\MemberAuthController;
use App\Http\Controllers\Member\MemberController;
use App\Http\Controllers\Member\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Members Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your admin side of the application.
|
*/

Route::group(['prefix' => 'members', 'as' => 'member.'], function () {

    /**
     * Authentication routes
     */
    Route::prefix('auth')->middleware('guest:member')->group(function () {
        Route::get('/login', [MemberAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [MemberAuthController::class, 'login']);

        // Register a new member
        Route::group([
            'prefix'     => 'register',
            'middleware' => 'register-member', // To handle steps redirections
        ], function () {
            Route::get('/', [MemberAuthController::class, 'showRegisterForm'])->name('register');
            Route::match(['GET', 'POST'], '/step-2', [MemberAuthController::class, 'registerStep2'])->name('register.step2');
            Route::post('/mobile/send', [MemberAuthController::class, 'sendVerificationCode'])->name('register.verify.send');

            Route::match(['GET', 'POST'], '/step-3', [MemberAuthController::class, 'registerStep3'])->name('register.step3');
            Route::match(['GET', 'POST'], '/step-4', [MemberAuthController::class, 'registerStep4'])->name('register.step4');
            Route::match(['GET', 'POST'], '/step-5', [MemberAuthController::class, 'registerStep5'])->name('register.step5');
            Route::match(['GET', 'POST'], '/step-6', [MemberAuthController::class, 'registerStep6'])->name('register.step6');
            Route::post('/', [MemberAuthController::class, 'register']);
        });

        /**
         * Forgot password routes
         * TO BE ADDED
         */
    });


    /**
     * Authenticated member routes
     */
    Route::group(['middleware' => ['auth:member']], function () {

        /**
         * Complete profile information
         */
        Route::get('complete-profile', [MemberController::class, 'complete'])->name('complete-profile');

        /**
         * Profile page
         */
        Route::prefix('profile')->group(function () {
            Route::get('/', [ProfileController::class, 'info'])->name('profile.info');
            Route::post('/', [ProfileController::class, 'postInfo']);

            Route::get('/experiences', [ProfileController::class, 'experiences'])->name('profile.experiences');
            Route::post('/experiences', [ProfileController::class, 'postExperiences']);

            Route::get('/photo', [ProfileController::class, 'photo'])->name('profile.photo');
            Route::post('/photo', [ProfileController::class, 'postPhoto']);

            Route::get('/password', [ProfileController::class, 'password'])->name('profile.password');
            Route::post('/password', [ProfileController::class, 'postPassword']);

            Route::get('/id', [ProfileController::class, 'id'])->name('profile.id');
            Route::post('/id', [ProfileController::class, 'postId']);

            Route::get('/statement', [ProfileController::class, 'statement'])->name('profile.statement');
            Route::post('/statement', [ProfileController::class, 'postStatement']);

            Route::get('/contract', [ProfileController::class, 'contract'])->name('profile.contract');
            Route::post('/contract', [ProfileController::class, 'postContract']);

            Route::get('/license', [ProfileController::class, 'license'])->name('profile.license');
            Route::post('/license', [ProfileController::class, 'postLicense']);
        });


        /**
         * Routes that require member information to be complete
         * Otherwise redirected to complete-profile page
         */
        Route::middleware('profile-is-complete')->group(function () {
            /**
             * Member homepage
             * Displays notifications
             */
            Route::get('/', [MemberController::class, 'index'])->name('home');
            /**
             * Member subscription
             * Displays current subscription information
             */
            Route::get('/subscription', [MemberController::class, 'subscription'])->name('subscription');
        });
    });
});
