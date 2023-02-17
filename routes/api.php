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
// include __DIR__ . '/seeds/news.php';
// include __DIR__ . '/seeds/pages.php';
// include __DIR__ . '/seeds/templates.php';
// include __DIR__ . '/seeds/polls.php';
// include __DIR__ . '/seeds/questions.php';
// include __DIR__ . '/seeds/mem_ques.php';
// include __DIR__ . '/seeds/sub_ques.php';
// include __DIR__ . '/seeds/courses.php';
// include __DIR__ . '/seeds/cert.php';
// include __DIR__ . '/seeds/cert_sub.php';
// include __DIR__ . '/seeds/notifications.php';
// include __DIR__ . '/seeds/subs.php';
// include __DIR__ . '/seeds/bills.php';
// include __DIR__ . '/seeds/media.php';
// include __DIR__ . '/seeds/courses_users.php';
// include __DIR__ . '/seeds/courses_members.php';
// include __DIR__ . '/seeds/urls.php';
