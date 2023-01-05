<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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


// Member routes
require_once 'members/web.php';

// Admin routes
require_once 'admins/web.php';
