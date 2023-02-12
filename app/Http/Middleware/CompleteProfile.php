<?php

namespace App\Http\Middleware;

use App\Notifications\MemberCompletionNotification;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompleteProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if (Auth::guard('member')->check() && !Auth::guard('member')->user()->complete() && Auth::guard('member')->user()->status <= 0) {
            return redirect()->route('member.complete-profile');
        }

        if (Auth::guard('member')->check() && !Auth::guard('member')->user()->finish_all) {
            Auth::guard('member')->user()->update(['finish_all' => 1]);
            Auth::guard('member')->user()->notify(new MemberCompletionNotification);
        }

        return $next($request);
    }
}
