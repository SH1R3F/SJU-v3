<?php

use App\Http\Controllers\ElectionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\Member\MemberController;
use App\Http\Controllers\Member\PaymentController;
use App\Http\Controllers\Member\ProfileController;
use App\Http\Controllers\Auth\MemberAuthController;
use App\Http\Controllers\Member\ForgotPasswordController;

/*
|--------------------------------------------------------------------------
| Web Members Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your members side of the application.
|
*/

Route::group(['prefix' => 'members', 'as' => 'member.'], function () {

    /**
     * Authentication routes
     */
    Route::prefix('auth')->middleware('guest:member,subscriber,volunteer')->group(function () {
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
         */
        Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
        Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
        Route::get('/password/reset/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
        Route::post('/password/reset', [ForgotPasswordController::class, 'reset'])->name('password.change');
    });


    /**
     * Authenticated member routes
     */
    Route::group(['middleware' => ['auth:member']], function () {
        // Logout route
        Route::post('auth/logout', [MemberAuthController::class, 'logout'])->name('logout');

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
         * My Courses
         * Displays current registered courses and upcoming courses
         */
        Route::get('/courses', [MemberController::class, 'courses'])->name('courses');

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
            Route::post('/subscription', [MemberController::class, 'resend'])->name('subscription.resend');
            Route::get('/subscription', [MemberController::class, 'subscription'])->name('subscription');

            /**
             * Payment routes
             */
            Route::middleware('can-pay')->group(function () {
                Route::get('/payment/card', [PaymentController::class, 'card'])->name('payment-card');
                Route::post('/payment/gateway', [PaymentController::class, 'gateway'])->name('payment-gateway');
                Route::get('/payment/gateway', fn () => redirect()->route('member.payment-card'));
                Route::get('/payment/response', [PaymentController::class, 'response'])->name('payment-response');
            });
        });

        /**
         * Elections routes
         */
        Route::prefix('elections')->group(function () {
            Route::get('/subscribed', [ElectionController::class, 'subscribed']);
            Route::get('/candidates', [ElectionController::class, 'candidates']);
            Route::post('/vote/{candidate}', [ElectionController::class, 'vote'])->name('elections.vote');
        });
    });
});
