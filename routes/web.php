<?php

use Illuminate\Http\Request;
use App\Models\Course\Certificate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\InviteController;
use App\Http\Controllers\ArticleController;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\TechnicalSupportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('notifications/read-all', function (Request $request) {
    Auth::guard('admin')->user()->unreadNotifications->markAsRead();
})->middleware('auth:member,subscriber,volunteer,admin')->name('read-all-notifications');

Route::post('notifications/{id}/read', function (Request $request, $id) {
    $user = Auth::guard('admin')->user() ?? $request->user();
    $user->unreadNotifications->where('id', $id)->markAsRead();
})->middleware('auth:member,subscriber,volunteer,admin')->name('read-notification');

Route::post('old-notifications/{id}/read', function (Request $request, $id) {
    DB::table('old_notifications')->where('member_id', Auth::guard('member')->user()->id)->where('id', $id)->update(['read' => true]);
})->middleware('auth:member')->name('read-old-notification');

/**
 * Language and notifications routes
 */
Route::get('language/{language}', function ($language) {
    Session()->put('locale', $language);
    return redirect()->back();
})->name('language')->where('language', 'en|ar');



// Home page
Route::get('/', [PageController::class, 'home'])->name('home');


/**
 * Routes that any user must be logged in.
 */
Route::middleware('auth:member,subscriber,volunteer')->group(function () {

    /**
     * Technical Support routes
     */
    Route::get('/technical-support', [TechnicalSupportController::class, 'index'])->name('support.index');
    Route::get('/technical-support/create', [TechnicalSupportController::class, 'create'])->name('support.create');
    Route::post('/technical-support/create', [TechnicalSupportController::class, 'store']);
    Route::get('/technical-support/{ticket}', [TechnicalSupportController::class, 'show'])->name('support.show');
    Route::post('/technical-support/{ticket}', [TechnicalSupportController::class, 'message'])->name('support.message');
    Route::post('/technical-support/{ticket}/toggle', [TechnicalSupportController::class, 'toggle'])->name('support.toggle');
});

Route::get('certval', fn () => inertia('Courses/Validate'))->name('verify-certificate');

Route::post('certval', function (Request $request) {
    $request->validate(['code' => 'required']);
    if (Certificate::where('code', $request->code)->count()) {
        return redirect()->back()->with('message', __('Certificate with this code found successfully!'));
    } else {
        return redirect()->back()->with('error', __("We don't have certificate with this code"));
    }
});

/**
 * Courses routes
 */
Route::get('courses/{status?}', [CourseController::class, 'index'])->where('status', 'upcoming|recent')->name('courses.index');
Route::get('courses/{course}', [CourseController::class, 'showRegisterForm'])->name('courses.register');
Route::post('courses/{course}', [CourseController::class, 'register'])->middleware('auth:member,subscriber,volunteer');
Route::get('courses/{course}/attend', [CourseController::class, 'showAttendForm'])->name('courses.attend')->middleware('auth:member,subscriber,volunteer');
Route::post('courses/{course}/attend', [CourseController::class, 'attend'])->middleware('auth:member,subscriber,volunteer');
Route::get('courses/{course}/certificate', [CourseController::class, 'certificate'])->name('courses.certificate')->middleware('auth:member,subscriber,volunteer');
Route::get('courses/{course}/questionnaire', [CourseController::class, 'questionnaire'])->name('courses.questionnaire')->middleware('auth:member,subscriber,volunteer');
Route::post('courses/questions/{question}', [CourseController::class, 'question'])->name('courses.question')->middleware('auth:member,subscriber,volunteer');

/**
 * Pages Routes
 */
Route::get('page/training-bag', [PageController::class, 'trainingBag'])->name('pages.training-bag');
Route::get('page/studio', [PageController::class, 'studio'])->name('pages.studio');

Route::get('page/{slug}', [PageController::class, 'page'])->name('pages.show');

/**
 * Articles Routes
 */
Route::get('article/{article}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('articles/{category_id?}', [ArticleController::class, 'articles'])->name('articles.index');

/**
 * Invitation routes
 */
Route::get('invitations/{invitation}', [InviteController::class, 'show'])->name('invitation.show');
Route::post('invitations/{invitation}', [InviteController::class, 'store'])->name('invitate.store');
Route::get('invitations/{invite:code}/attend', [InviteController::class, 'attend'])->name('invitation.attend');


/**
 * Competitions Routes
 */
Route::get('competitions/{competition}', [CompetitionController::class, 'show'])->name('competitions.show');
Route::post('competitions/{competition}', [CompetitionController::class, 'submit'])->name('competitions.submit');


// Member routes
require_once 'members/web.php';

// Subscriber routes
require_once 'subscribers/web.php';

// Subscriber routes
require_once 'volunteers/web.php';

// Admin routes
require_once 'admins/web.php';
