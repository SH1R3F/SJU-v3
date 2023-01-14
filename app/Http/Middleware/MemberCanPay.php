<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberCanPay
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
        if (Auth::guard('member')->check()) {
            $member = Auth::guard('member')->user();

            // Check if member subscription ended or is not active
            if ($member->canPay()) {
                return $next($request);
            }
        }

        return redirect()->route('member.subscription');
    }
}
