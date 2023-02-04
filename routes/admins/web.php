<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\VolunteerController;
use App\Http\Controllers\Admin\SiteOptionController;
use App\Http\Controllers\Admin\SubscriberController;
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

        /* My profile routes */
        Route::get('my-profile', [ProfileController::class, 'index'])->name('my-profile');
        Route::put('my-profile', [ProfileController::class, 'update']);

        /* Site options */
        Route::get('site-options', [SiteOptionController::class, 'index'])->name('site.options');
        Route::post('site-options', [SiteOptionController::class, 'update']);

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
        Route::post('members/{member}/toggle', [MemberController::class, 'toggle'])->name('members.toggle');
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

        // Send notification to subscribers
        Route::get('subscribers/notify', [SubscriberController::class, 'showNotifyForm'])->name('subscribers.notify');
        Route::post('subscribers/notify', [SubscriberController::class, 'notify']);

        /**
         * Subscribers management
         */
        Route::post('subscribers/{subscriber}/toggle', [SubscriberController::class, 'toggle'])->name('subscribers.toggle');
        Route::get('subscribers/{status?}/export', [SubscriberController::class, 'export'])->where('status', 'active|inactive')->name('subscribers.export');
        Route::get('subscribers/{status?}', [SubscriberController::class, 'index'])->where('status', 'active|inactive')->name('subscribers.index');
        Route::get('subscribers/{subscriber}/certificate/{course}', [SubscriberController::class, 'certificate'])->name('subscribers.certificate');
        Route::resource('subscribers', SubscriberController::class)->except('index');

        // Send notification to volunteers
        Route::get('volunteers/notify', [VolunteerController::class, 'showNotifyForm'])->name('volunteers.notify');
        Route::post('volunteers/notify', [VolunteerController::class, 'notify']);

        /**
         * Volunteers management
         */
        Route::post('volunteers/{volunteer}/toggle', [VolunteerController::class, 'toggle'])->name('volunteers.toggle');
        Route::get('volunteers/{status?}/export', [VolunteerController::class, 'export'])->where('status', 'active|inactive')->name('volunteers.export');
        Route::get('volunteers/{status?}', [VolunteerController::class, 'index'])->where('status', 'active|inactive')->name('volunteers.index');
        Route::get('volunteers/{volunteer}/certificate/{course}', [VolunteerController::class, 'certificate'])->name('volunteers.certificate');
        Route::resource('volunteers', VolunteerController::class)->except('index');


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
        Route::get('courses/export', [CourseController::class, 'export'])->name('courses.export');
        Route::post('courses/{course}/{type}/{id}/attendance/toggle', [CourseController::class, 'toggleAttendance'])->name('courses.attendance.toggle');
        Route::delete('courses/{course}/{type}/{id}/attendance/delete', [CourseController::class, 'deleteAttendance'])->name('courses.attendance.delete');
        Route::post('courses/{course}/toggle', [CourseController::class, 'toggle'])->name('courses.toggle');
        Route::resource('courses', CourseController::class);

        /**
         * News section
         */
        Route::prefix('news')->group(function () {

            /**
             * Categories management
             */
            Route::resource('categories', CategoryController::class)->except(['show']);

            /**
             * Pages section
             */
            Route::resource('pages', PageController::class)->except(['show']);

            /**
             * Articles section
             */
            Route::resource('articles', ArticleController::class)->except(['show']);
        });

        /**
         * Studio
         */
        Route::get('studio/{type?}', [MediaController::class, 'index'])->where('type', 'photo|video')->name('media.index');
        Route::get('studio/create', [MediaController::class, 'create'])->name('media.create');
        Route::post('studio/', [MediaController::class, 'store'])->name('media.store');
        Route::delete('studio/{media}', [MediaController::class, 'destroy'])->name('media.destroy');
    });
});
