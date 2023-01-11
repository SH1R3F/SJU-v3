<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Member\ProfileInfoRequest;
use App\Http\Requests\Member\ProfileExperiencesRequest;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            // User cannot update his data if he is already branch approved
            abort_if($request->isMethod('POST') && Auth::guard('member')->user()->status >= 1, Response::HTTP_FORBIDDEN);

            return $next($request);
        });
    }

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
        return redirect()->back()->with('message', __('Your information has been updated successfully'));
    }

    /**
     * Display member profile experiences form.
     *
     * @return \Illuminate\Http\Response
     */
    public function experiences()
    {
        return inertia('Members/Profile/Experiences');
    }

    /**
     * Post member profile experiences form.
     *
     * @param \App\Http\Requests\ProfileExperiencesRequest $request
     * @return \Illuminate\Http\Response
     */
    public function postExperiences(ProfileExperiencesRequest $request)
    {
        $user = Auth::guard('member')->user();
        if ($user->status < 1) $user->update($request->validated());
        return redirect()->back()->with('message', __('Your information has been updated successfully'));
    }

    /**
     * Display member's photo update form.
     *
     * @return \Illuminate\Http\Response
     */
    public function photo()
    {
        return inertia('Members/Profile/Photo');
    }

    /**
     * Post member's photo update.
     *
     * @param \Illuminate\Http\Request $Request
     * @return \Illuminate\Http\Response
     */
    public function postPhoto(Request $request)
    {
        $user = Auth::guard('member')->user();
        $request->validate(['profile_photo' => ['required', 'image', 'mimes:jpg,png,jpeg,gif', 'max:2048']]);

        // Save image
        $path = $request->file('profile_photo')->store("members/{$user->national_id}");

        $user->update(['profile_photo' => $path]);
        return redirect()->back()->with('message', __('Your information has been updated successfully'));
    }

    /**
     * Display member's password update form.
     *
     * @return \Illuminate\Http\Response
     */
    public function password()
    {
        return inertia('Members/Profile/Password');
    }

    /**
     * Post member's password update.
     *
     * @param \Illuminate\Http\Request $Request
     * @return \Illuminate\Http\Response
     */
    public function postPassword(Request $request)
    {
        $user = Auth::guard('member')->user();
        $request->validate([
            'password' => ['required', function ($attribute, $value, $fail) use ($user) {
                if (!Hash::check($value, $user->password)) $fail(__('Password is incorrect'));
            }],
            'new_password' => ['required', 'min:6', 'confirmed']
        ]);

        // Save password
        $user->update(['password' => Hash::make($request->new_password)]);

        return redirect()->back()->with('message', __('Your information has been updated successfully'));
    }

    /**
     * Display member's national id photo update form.
     *
     * @return \Illuminate\Http\Response
     */
    public function id()
    {
        return inertia('Members/Profile/Id');
    }

    /**
     * Post member's national id photo update.
     *
     * @param \Illuminate\Http\Request $Request
     * @return \Illuminate\Http\Response
     */
    public function postId(Request $request)
    {
        $user = Auth::guard('member')->user();
        $request->validate(['national_id_photo' => ['required', 'image', 'mimes:jpg,png,jpeg,gif', 'max:2048']]);

        // Save image
        $path = $request->file('national_id_photo')->store("members/{$user->national_id}");

        $user->update(['national_id_photo' => $path]);
        return redirect()->back()->with('message', __('Your information has been updated successfully'));
    }

    /**
     * Display member's job statement photo update form.
     *
     * @return \Illuminate\Http\Response
     */
    public function statement()
    {
        return inertia('Members/Profile/Statement');
    }

    /**
     * Post member's job statement photo update.
     *
     * @param \Illuminate\Http\Request $Request
     * @return \Illuminate\Http\Response
     */
    public function postStatement(Request $request)
    {
        $user = Auth::guard('member')->user();
        $request->validate(['statement_photo' => ['required', 'image', 'mimes:jpg,png,jpeg,gif', 'max:2048']]);

        // Save image
        $path = $request->file('statement_photo')->store("members/{$user->national_id}");

        $user->update(['statement_photo' => $path]);
        return redirect()->back()->with('message', __('Your information has been updated successfully'));
    }

    /**
     * Display member's job contract photo update form.
     *
     * @return \Illuminate\Http\Response
     */
    public function contract()
    {
        return inertia('Members/Profile/Contract');
    }

    /**
     * Post member's job contract photo update.
     *
     * @param \Illuminate\Http\Request $Request
     * @return \Illuminate\Http\Response
     */
    public function postContract(Request $request)
    {
        $user = Auth::guard('member')->user();
        $request->validate(['contract_photo' => ['required', 'image', 'mimes:jpg,png,jpeg,gif', 'max:2048']]);

        // Save image
        $path = $request->file('contract_photo')->store("members/{$user->national_id}");

        $user->update(['contract_photo' => $path]);
        return redirect()->back()->with('message', __('Your information has been updated successfully'));
    }

    /**
     * Display member's newspaper license photo update form.
     *
     * @return \Illuminate\Http\Response
     */
    public function license()
    {
        return inertia('Members/Profile/License');
    }

    /**
     * Post member's newspaper license photo update.
     *
     * @param \Illuminate\Http\Request $Request
     * @return \Illuminate\Http\Response
     */
    public function postLicense(Request $request)
    {
        $user = Auth::guard('member')->user();
        $request->validate(['license_photo' => ['required', 'image', 'mimes:jpg,png,jpeg,gif', 'max:2048']]);

        // Save image
        $path = $request->file('license_photo')->store("members/{$user->national_id}");

        $user->update(['license_photo' => $path]);
        return redirect()->back()->with('message', __('Your information has been updated successfully'));
    }
}
