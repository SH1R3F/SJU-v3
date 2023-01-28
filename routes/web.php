<?php

use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
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
Route::middleware('auth:member')->group(function () {

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

Route::get('certval', function () {
    return 'Here you verify certificates';
})->name('verify-certificate');

/**
 * Courses routes
 */
Route::get('courses/{status?}', [CourseController::class, 'index'])->where('status', 'upcoming|recent')->name('courses.index');
Route::get('courses/{course}', [CourseController::class, 'showRegisterForm'])->name('courses.register');
Route::post('courses/{course}', [CourseController::class, 'register'])->middleware('auth:member'); // Other authentications to be added too auth:member,subscriber,volunteer
Route::get('courses/{course}/attend', [CourseController::class, 'showAttendForm'])->name('courses.attend');
Route::post('courses/{course}/attend', [CourseController::class, 'attend'])->middleware('auth:member'); // Other authentications to be added too auth:member,subscriber,volunteer
Route::get('courses/{course}/certificate', [CourseController::class, 'certificate'])->name('courses.certificate')->middleware('auth:member'); // Other authentications to be added too auth:member,subscriber,volunteer
Route::get('courses/{course}/questionnaire', [CourseController::class, 'questionnaire'])->name('courses.questionnaire')->middleware('auth:member'); // Other authentications to be added too auth:member,subscriber,volunteer
Route::post('courses/questions/{question}', [CourseController::class, 'question'])->name('courses.question')->middleware('auth:member'); // Other authentications to be added too auth:member,subscriber,volunteer
// Route::resource('courses', CourseController::class)->except([]);

// Member routes
require_once 'members/web.php';

// Admin routes
require_once 'admins/web.php';
