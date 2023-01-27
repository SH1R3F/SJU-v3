<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\Course\CourseController;
use App\Http\Controllers\Admin\Course\QuestionController;
use App\Http\Controllers\Admin\Course\TemplateController;
use App\Http\Controllers\Admin\TechnicalSupportController;
use App\Http\Controllers\Admin\Course\QuestionnaireController;

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


        // Send notification to members
        Route::get('members/notify', [MemberController::class, 'showNotifyForm'])->name('members.notify');
        Route::post('members/notify', [MemberController::class, 'notify']);

        /**
         * Members management
         */
        Route::get('members/branch-approval', [MemberController::class, 'branch'])->name('members.branch-approval');
        Route::get('members/admin-acceptance', [MemberController::class, 'acceptance'])->name('members.admin-acceptance');
        Route::get('members/refused', [MemberController::class, 'refused'])->name('members.refused');
        Route::get('members/export/{page}', [MemberController::class, 'export'])->name('members.export');
        Route::post('members/{member}/toggle', [MemberController::class, 'toggle'])->name('members.toggle'); // To be changed
        Route::post('members/{member}/accept', [MemberController::class, 'accept'])->name('members.accept');
        Route::post('members/{member}/unaccept', [MemberController::class, 'unaccept'])->name('members.unaccept');
        Route::post('members/{member}/approve', [MemberController::class, 'approve'])->name('members.approve');
        Route::post('members/{member}/disapprove', [MemberController::class, 'disapprove'])->name('members.disapprove');
        Route::post('members/{member}/refuse', [MemberController::class, 'refuse'])->name('members.refuse');
        Route::get('members/{member}/contact', [MemberController::class, 'showContact'])->name('members.show.contact');
        Route::get('members/{member}/experiences', [MemberController::class, 'showExperiences'])->name('members.show.experiences');
        Route::get('members/{member}/documents', [MemberController::class, 'showDocuments'])->name('members.show.documents');
        Route::get('members/{member}/card', [MemberController::class, 'card'])->name('members.card');
        Route::get('members/{member}/form', [MemberController::class, 'form'])->name('members.form');
        Route::resource('members', MemberController::class);

        /**
         * Invoices management
         */
        Route::resource('invoices', InvoiceController::class)->only(['index', 'show']);


        /**
         * Technical Support Management
         */
        Route::get('technical-support/volunteers-tickets', [TechnicalSupportController::class, 'volunteers'])->name('tickets.volunteers');
        Route::get('technical-support/subscribers-tickets', [TechnicalSupportController::class, 'subscribers'])->name('tickets.subscribers');
        // Route::get('technical-support/members-tickets', [TechnicalSupportController::class, 'members'])->name('tickets.members');
        Route::post('technical-support/{ticket}/toggle', [TechnicalSupportController::class, 'toggle'])->name('tickets.toggle');
        Route::post('technical-support/{ticket}/', [TechnicalSupportController::class, 'message'])->name('tickets.message');
        Route::resource('technical-support/tickets', TechnicalSupportController::class)->only(['index', 'show', 'destroy']);

        /**
         * Courses related routes
         */
        Route::prefix('courses')->group(function () {
            Route::resource('templates', TemplateController::class);
            Route::resource('questionnaires', QuestionnaireController::class)->except(['show']);
            Route::resource('questionnaires/{questionnaire}/questions', QuestionController::class)->except(['show']);
        });

        /**
         * Courses management
         */
        Route::post('courses/{course}/toggle', [CourseController::class, 'toggle'])->name('courses.toggle');
        Route::resource('courses', CourseController::class);
    });
});
