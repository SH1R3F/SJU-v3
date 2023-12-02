<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdController;
use App\Http\Controllers\Admin\UrlController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\VolunteerController;
use App\Http\Controllers\Admin\InvitationController;
use App\Http\Controllers\Admin\SiteOptionController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\Admin\CompetitionController;
use App\Http\Controllers\Admin\TrainingBagController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\Course\CourseController;
use App\Http\Controllers\Admin\Course\QuestionController;
use App\Http\Controllers\Admin\Course\TemplateController;
use App\Http\Controllers\Admin\TechnicalSupportController;
use App\Http\Controllers\Admin\MembershipTransferController;
use App\Http\Controllers\Admin\Course\QuestionnaireController;
use App\Http\Controllers\Admin\BranchTechnicalSupportController;
use App\Http\Controllers\Admin\CandidateController;

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

        // Manage employees
        Route::post('employees/{employee}/permissions', [EmployeeController::class, 'permissions'])->name('employees.permissions');
        Route::resource('employees', EmployeeController::class);


        // Send notification to members
        Route::get('members/notify', [MemberController::class, 'showNotifyForm'])->name('members.notify');
        Route::get('members/notify/chuncks', [MemberController::class, 'chuncks'])->name('members.notify.chuncks');
        Route::post('members/notify', [MemberController::class, 'notify']);


        /**
         * Members transfers
         */
        Route::get('members/transfers', [MembershipTransferController::class, 'index'])->name('members.transfers');;
        Route::get('members/transfers/create', [MembershipTransferController::class, 'create'])->name('members.transfers.create');;
        Route::post('members/transfers/store', [MembershipTransferController::class, 'store'])->name('members.transfers.transfer');;
        Route::post('members/transfers/{transfer}/approve', [MembershipTransferController::class, 'approve'])->name('members.transfers.approve');;
        Route::post('members/transfers/{transfer}/disapprove', [MembershipTransferController::class, 'disapprove'])->name('members.transfers.disapprove');;
        Route::delete('members/transfers/{transfer}', [MembershipTransferController::class, 'destroy'])->name('members.transfers.destroy');;


        /**
         * Members management
         */
        Route::post('members/{member}/set-paid', [MemberController::class, 'setPaid'])->name('members.set-paid');
        Route::get('members/branch-approval', [MemberController::class, 'branch'])->name('members.branch-approval');
        Route::get('members/admin-acceptance', [MemberController::class, 'acceptance'])->name('members.admin-acceptance');
        Route::get('members/refused', [MemberController::class, 'refused'])->name('members.refused');
        Route::post('admins/import', [MemberController::class, 'import'])->name('members.import');
        Route::get('members/export/{page}', [MemberController::class, 'export'])->name('members.export');
        Route::get('members/export/{page}/pdf', [MemberController::class, 'exportPdf'])->name('members.export.pdf');
        Route::get('members/stats/pdf', [MemberController::class, 'statsPdf'])->name('members.stats.pdf');
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
        Route::get('members/{member}/edit/experiences', [MemberController::class, 'experiences'])->name('members.edit.experiences');
        Route::put('members/{member}/edit/experiences', [MemberController::class, 'updateExperiences'])->name('members.update.experiences');
        Route::get('members/{member}/edit/documents', [MemberController::class, 'documents'])->name('members.edit.documents');
        Route::put('members/{member}/edit/documents', [MemberController::class, 'updateDocuments'])->name('members.update.documents');
        Route::resource('members', MemberController::class);

        /**
         * Invoices and transactions management
         */
        Route::resource('invoices', InvoiceController::class)->only(['index', 'show']);
        Route::resource('transactions', TransactionController::class)->only(['index', 'show']);

        // Send notification to subscribers
        Route::get('subscribers/notify', [SubscriberController::class, 'showNotifyForm'])->name('subscribers.notify');
        Route::get('subscribers/notify/chuncks', [SubscriberController::class, 'chuncks'])->name('subscribers.notify.chuncks');
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
        Route::get('volunteers/notify/chuncks', [VolunteerController::class, 'chuncks'])->name('volunteers.notify.chuncks');
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
        Route::get('technical-support/export/{type}', [TechnicalSupportController::class, 'export'])->name('tickets.export');
        Route::get('technical-support/managers-tickets', [TechnicalSupportController::class, 'managers'])->name('tickets.managers');
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

            Route::get('{course}/results/export', [CourseController::class, 'exportQuestionnaire'])->name('questionnaires.export');
            Route::get('{course}/results', [CourseController::class, 'results'])->name('courses.results');
            Route::resource('questionnaires', QuestionnaireController::class)->except(['show']);
            Route::resource('questionnaires/{questionnaire}/questions', QuestionController::class)->except(['show']);
        });

        /**
         * Courses Notification
         */
        Route::get('courses/{course}/export', [CourseController::class, 'exportCoursables'])->name('course.export');
        Route::get('courses/{course}/notify', [CourseController::class, 'showNotificationForm'])->name('courses.notify');
        Route::get('courses/{course}/chunck', [CourseController::class, 'chuncks'])->name('courses.notify.chuncks');
        Route::post('courses/{course}/notify', [CourseController::class, 'notify']);

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

            /**
             * Ads section
             */
            Route::post('ads/{ad}/toggle', [AdController::class, 'toggle'])->name('ads.toggle');
            Route::resource('ads', AdController::class)->except(['show']);

            /**
             * Urls section
             */
            Route::post('urls/{url}/toggle', [UrlController::class, 'toggle'])->name('urls.toggle');
            Route::resource('urls', UrlController::class)->except(['show']);
        });

        /**
         * Studio
         */
        Route::get('studio/{type?}', [MediaController::class, 'index'])->where('type', 'photo|video')->name('media.index');
        Route::get('studio/create', [MediaController::class, 'create'])->name('media.create');
        Route::post('studio/', [MediaController::class, 'store'])->name('media.store');
        Route::delete('studio/{media}', [MediaController::class, 'destroy'])->name('media.destroy');

        /**
         * Invitations management
         */
        Route::get('invitations/{invitation}/export', [InvitationController::class, 'export'])->name('invitations.export');
        Route::post('invitations/{invitation}/toggle', [InvitationController::class, 'toggle'])->name('invitations.toggle');
        Route::resource('invitations', InvitationController::class);

        /**
         * Training bags
         */
        Route::get('training-bag', [TrainingBagController::class, 'index'])->name('training-bag.index');
        Route::get('training-bag/create', [TrainingBagController::class, 'create'])->name('training-bag.create');
        Route::post('training-bag', [TrainingBagController::class, 'store'])->name('training-bag.store');
        Route::delete('training-bag/{file}', [TrainingBagController::class, 'destroy'])->name('training-bag.destroy');


        /**
         * Competitions related routes
         */
        Route::get('competitions/submission/{submission}', [CompetitionController::class, 'submission'])->name('competitions.submission.show');
        Route::resource('competitions', CompetitionController::class);


        /**
         * Technical support for branch managers
         */
        Route::prefix('technical-issues')->middleware('role:Branch manager')->group(function() {
            Route::get('/tickets', [BranchTechnicalSupportController::class, 'index'])->name('branch-issues.index');
            Route::get('/create', [BranchTechnicalSupportController::class, 'create'])->name('branch-issues.create');
            Route::post('/store', [BranchTechnicalSupportController::class, 'store'])->name('branch-issues.store');
            Route::get('/tickets/{ticket}', [BranchTechnicalSupportController::class, 'show'])->name('branch-issues.show');
            Route::post('/tickets/{ticket}/toggle', [BranchTechnicalSupportController::class, 'toggle'])->name('branch-issues.toggle');
            Route::post('/tickets/{ticket}/message', [BranchTechnicalSupportController::class, 'message'])->name('branch-issues.message');
            Route::delete('/tickets/{ticket}', [BranchTechnicalSupportController::class, 'destroy'])->name('branch-issues.destroy');
        });

        /**
         * Elections
         */
        Route::get('/export', [CandidateController::class, 'export'])->name('candidates.export');
        Route::get('/chuncks', [CandidateController::class, 'chuncks'])->name('candidates.chuncks');
        Route::resource('candidates', CandidateController::class);
    });
});
