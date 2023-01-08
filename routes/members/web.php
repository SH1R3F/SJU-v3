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
            Route::post('/mobile/send', [MemberAuthController::class, 'sendVerificationCode'])->name('register.verify.send')->middleware('throttle:1,2');

            Route::match(['GET', 'POST'], '/step-3', [MemberAuthController::class, 'registerStep3'])->name('register.step3');
            Route::match(['GET', 'POST'], '/step-4', [MemberAuthController::class, 'registerStep4'])->name('register.step4');
            Route::match(['GET', 'POST'], '/step-5', [MemberAuthController::class, 'registerStep5'])->name('register.step5');
            Route::match(['GET', 'POST'], '/step-6', [MemberAuthController::class, 'registerStep6'])->name('register.step6');
            Route::post('/', [MemberAuthController::class, 'register']);
        });
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
         * Member homepage
         */
        Route::get('/', [MemberController::class, 'index'])->name('home');

        /**
         * Profile page
         */
        Route::prefix('profile')->group(function () {
            Route::get('/', [ProfileController::class, 'info'])->name('profile.info');
            Route::post('/', [ProfileController::class, 'postInfo']);
            Route::get('/experiences', [ProfileController::class, 'experiences'])->name('profile.experiences');
            Route::get('/photo', [ProfileController::class, 'photo'])->name('profile.photo');
            Route::get('/password', [ProfileController::class, 'password'])->name('profile.password');
            Route::get('/id', [ProfileController::class, 'id'])->name('profile.id');
            Route::get('/statement', [ProfileController::class, 'statement'])->name('profile.statement');
        });
    });
});
