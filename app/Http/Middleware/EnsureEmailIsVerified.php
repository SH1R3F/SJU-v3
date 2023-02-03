<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Subscriber;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class EnsureEmailIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $redirectToRoute
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse|null
     */
    public function handle($request, Closure $next, $redirectToRoute = null)
    {
        if (!$request->user() || ($request->user() instanceof MustVerifyEmail && !$request->user()->hasVerifiedEmail())) {
            if ($request->expectsJson()) {
                return abort(403, __('Your email address is not verified.'));
            }

            // Verification route for subscribers
            if ($request->user() instanceof Subscriber) {
                return Redirect::guest(URL::route($redirectToRoute ?: 'subscriber.verification.notice'));
            } else if ($request->user() instanceof Volunteer) {
                return Redirect::guest(URL::route($redirectToRoute ?: 'volunteer.verification.notice'));
            }


            return Redirect::guest(URL::route($redirectToRoute ?: 'verification.notice'));
        }

        return $next($request);
    }
}
