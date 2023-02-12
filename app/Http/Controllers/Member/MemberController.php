<?php

namespace App\Http\Controllers\Member;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Models\Course\Course;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CourseResource;
use App\Notifications\MembershipResend;

class MemberController extends Controller
{
    /**
     * The default home page for the logged in member.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $member = Auth::guard('member')->user();
        $notifications = $member->unreadNotifications()->orderBy('created_at', 'DESC')->get();
        $old_notifications = DB::table('old_notifications')->where('member_id', $member->id)->where('read', false)->orderBy('id', 'DESC')->get();
        return inertia('Members/Index', compact('notifications', 'old_notifications'));
    }

    /**
     * Member's prompt page to complete information.
     *
     * @return \Illuminate\Http\Response
     */
    public function complete()
    {
        if (Auth::guard('member')->user()->complete()) return redirect()->route('member.home');
        return inertia('Members/Complete');
    }

    /**
     * Member's subscription information page.
     *
     * @return \Illuminate\Http\Response
     */
    public function subscription()
    {
        return inertia('Members/Subscription');
    }

    /**
     * resend subscription request after refusal.
     *
     * @return \Illuminate\Http\Response
     */
    public function resend()
    {
        $member = Auth::guard('member')->user();
        if ($member->status !== Member::STATUS_REFUSED) return;

        $member->update(['status' => Member::STATUS_UNAPPROVED]);
        $member->notify(new MembershipResend);

        return redirect()->back()->with('message', __('Subscription requested successfully'));
    }

    /**
     * Display my courses page for members
     */
    public function courses()
    {
        $upcoming = Course::query()
            ->whereIn('status', [1, 2, 3, 4])
            // Uncomment this if you want registered courses not to appear in upcoming courses
            // ->whereNotIn('id', Auth::guard('member')->user()->courses->pluck('id'))
            ->whereDate('date_from', '>=', now())->orderBy('date_from', 'ASC')
            ->get();

        $registered = Auth::guard('member')->user()
            ->courses()
            ->orderBy('date_from', 'DESC')
            ->get();

        return inertia('Members/Courses', [
            'upcoming' => CourseResource::collection($upcoming),
            'registered' => CourseResource::collection($registered),
        ]);
    }
}
