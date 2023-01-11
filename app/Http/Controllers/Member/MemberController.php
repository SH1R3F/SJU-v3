<?php

namespace App\Http\Controllers\Member;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    /**
     * The default home page for the logged in member.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return inertia('Members/Index');
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
}
