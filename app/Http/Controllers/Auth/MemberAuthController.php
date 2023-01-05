<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MemberAuthController extends Controller
{

    /**
     * Display the login view.
     */
    public function showLoginForm()
    {
        return inertia('Members/Auth/Login');
    }
}
