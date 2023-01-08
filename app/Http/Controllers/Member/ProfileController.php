<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Member\ProfileInfoRequest;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display member profile information form.
     *
     * @return \Illuminate\Http\Response
     */
    public function info()
    {
        $nationalities = config('sju.nationalities', []);
        return inertia('Members/Profile/Info', compact('nationalities'));
    }

    /**
     * Post member profile information form.
     *
     * @param \App\Http\Requests\ProfileInfoRequest $request
     * @return \Illuminate\Http\Response
     */
    public function postInfo(ProfileInfoRequest $request)
    {
        Auth::guard('member')->user()->update($request->validated());
        return redirect()->back()->with('message', __('Your information have been updated successfully'));
    }
}
