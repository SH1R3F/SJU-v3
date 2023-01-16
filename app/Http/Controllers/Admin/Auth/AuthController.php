<?php

namespace App\Http\Controllers\Admin\Auth;

use Inertia\Inertia;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\Auth\LoginRequest;

class AuthController extends Controller
{

    /**
     * Display the login view.
     */
    public function showLoginForm()
    {
        return inertia('Admin/Auth/Login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function login(LoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();
        // Force redirect for external js files to be run
        return Inertia::location(redirect()->intended(Admin::HOME)->getTargetUrl());
    }

    /**
     * Destroy an authenticated session.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}
