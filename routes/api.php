<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// include __DIR__ . '/seeds/subscriber.php';
// include __DIR__ . '/seeds/volunteers.php';
// include __DIR__ . '/seeds/members.php';
// include __DIR__ . '/seeds/support_tickets.php';
// include __DIR__ . '/seeds/support_messages.php';
include __DIR__ . '/seeds/news.php';
