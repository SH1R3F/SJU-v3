<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Admin;
use App\Models\Member;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {

                $redirectTo = RouteServiceProvider::HOME;

                switch ($guard) {
                    case 'admin':
                        $redirectTo = Admin::HOME;
                        break;
                    case 'member':
                        $redirectTo = Member::HOME;
                        break;
                    case 'subscriber':
                        $redirectTo = Subscriber::HOME;
                        break;
                        // Add more guard checks
                }

                return redirect($redirectTo);
            }
        }

        return $next($request);
    }
}
