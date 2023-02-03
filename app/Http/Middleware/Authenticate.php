<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {

            if ($request->is('admin*')) return route('admin.login');
            if ($request->is('members*')) return route('member.login');
            if ($request->is('subscribers*')) return route('subscriber.login');
            if ($request->is('volunteers*')) return route('volunteer.login');

            return route('member.login');
        }
    }
}
