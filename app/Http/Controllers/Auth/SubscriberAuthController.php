<?php

namespace App\Http\Controllers\Auth;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\Events\SubscriberRegistered;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Subscriber\LoginRequest;
use App\Http\Requests\Subscriber\RegisterRequest;
use App\Http\Requests\Subscriber\EmailVerificationRequest;

class SubscriberAuthController extends Controller
{

    /**
     * Display the login view.
     */
    public function showLoginForm()
    {
        return inertia('Subscribers/Auth/Login');
    }

    /**
     * Perform the login action.
     * 
     * @param \App\Http\Requests\Subscriber\LoginRequest  $request
     */
    public function login(LoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();
        return redirect()->intended(Subscriber::HOME);
    }

    /**
     * Perform the login action.
     * 
     * @param \Illuminate\Http\Request  $request
     */
    public function logout(Request $request)
    {
        Auth::guard('subscriber')->logout();
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();
        return redirect()->route('subscriber.login');
    }

    /**
     * Display the registration view.
     * Asks for national id
     */
    public function showRegisterForm()
    {
        return inertia('Subscribers/Auth/Register', [
            'countries' => config('sju.countries', []),
            'cities' => config('sju.cities', []),
            'nationalities' => config('sju.nationalities_ar', []),
            'qualifications' => config('sju.qualifications', []),
            'sources' => config('sju.sources', []),
        ]);
    }

    /**
     * Register the subscriber
     * 
     * @param \App\Http\Requests\Subscriber\RegisterRequest  $request
     */
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $data['city'] = $data['city'] ?? 0;
        $data['password'] = bcrypt($data['password']);

        // Create
        $subscriber = Subscriber::create($data);

        // Fire event
        event(new SubscriberRegistered($subscriber));

        // Log him in
        Auth::guard('subscriber')->login($subscriber);
        $request->session()->regenerate();
        return redirect()->to(Subscriber::HOME);
    }

    /**
     * Send a new email verification notification.
     */
    public function send(Request $request)
    {
        if (Auth::guard('subscriber')->user()->hasVerifiedEmail()) {
            return redirect()->intended(Subscriber::HOME);
        }

        Auth::guard('subscriber')->user()->sendEmailVerificationNotification();

        return back()->with('message', __('Email verification has been sent'));
    }

    /**
     * Mark the authenticated subscriber's email address as verified.
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
        return Auth::guard('subscriber')->user()->hasVerifiedEmail()
            ? redirect()->intended(Subscriber::HOME)
            : inertia('Subscribers/Auth/Verify');
    }
}
