<?php

namespace App\Http\Controllers\Auth;

use App\Models\Branch;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Events\VolunteerRegistered;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use App\Http\Requests\Volunteer\LoginRequest;
use App\Http\Requests\Volunteer\RegisterRequest;
use App\Http\Requests\Volunteer\EmailVerificationRequest;

class VolunteerAuthController extends Controller
{
    /**
     * Display the login view.
     */
    public function showLoginForm()
    {
        return inertia('Volunteers/Auth/Login');
    }

    /**
     * Perform the login action.
     * 
     * @param \App\Http\Requests\Volunteer\LoginRequest  $request
     */
    public function login(LoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();
        return redirect()->intended(Volunteer::HOME);
    }

    /**
     * Perform the login action.
     * 
     * @param \Illuminate\Http\Request  $request
     */
    public function logout(Request $request)
    {
        Auth::guard('volunteer')->logout();
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();
        return redirect()->route('volunteer.login');
    }

    /**
     * Display the registration view.
     * Asks for national id
     */
    public function showRegisterForm()
    {
        return inertia('Volunteers/Auth/Register', [
            'countries' => config('sju.countries', []),
            'cities' => config('sju.cities', []),
            'nationalities' => config('sju.nationalities_ar', []),
            'qualifications' => config('sju.qualifications', []),
            'sources' => config('sju.sources', []),
            'branches' => Branch::orderBy('id')->get(['id', 'name'])
        ]);
    }

    /**
     * Register the volunteer
     * 
     * @param \App\Http\Requests\Volunteer\RegisterRequest  $request
     */
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $data['city'] = $data['city'] ?? 0;
        $data['fields'] = implode(',', $data['fields']);
        $data['password'] = bcrypt($data['password']);

        // Save image
        if (isset($data['profile_photo']) && $data['profile_photo'] instanceof UploadedFile) {
            $data['profile_photo'] = $data['profile_photo']->store("volunteers/photos");
        }

        // Create
        $volunteer = Volunteer::create($data);

        // Fire event
        event(new VolunteerRegistered($volunteer));

        // Log him in
        Auth::guard('volunteer')->login($volunteer);
        $request->session()->regenerate();
        return redirect()->to(Volunteer::HOME);
    }

    /**
     * Send a new email verification notification.
     */
    public function send(Request $request)
    {
        if (Auth::guard('volunteer')->user()->hasVerifiedEmail()) {
            return redirect()->intended(Volunteer::HOME);
        }

        Auth::guard('volunteer')->user()->sendEmailVerificationNotification();

        return back()->with('message', __('Email verification has been sent'));
    }

    /**
     * Mark the authenticated volunteer's email address as verified.
     */
    public function verifyEmail(EmailVerificationRequest $request)
    {
        return $request->verify();
    }

    /**
     * Display the email verification prompt.
     */
    public function notice(Request $request)
    {
        return Auth::guard('volunteer')->user()->hasVerifiedEmail()
            ? redirect()->intended(Volunteer::HOME)
            : inertia('Volunteers/Auth/Verify');
    }
}
