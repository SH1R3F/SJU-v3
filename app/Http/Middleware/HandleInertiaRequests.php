<?php

namespace App\Http\Middleware;

use App\Http\Resources\AdminResource;
use Inertia\Middleware;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    public function rootView(Request $request)
    {
        if ($request->is('admin*')) {
            return 'admin';
        }
        return parent::rootView($request);
    }

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        if ($request->is('admin*') && Auth::guard('admin')->check()) {
            $auth = new AdminResource(Auth::guard('admin')->user());
        } else {
            // Perform guard checks (Two different users can't be logged in)
        }

        return array_merge(parent::share($request), [
            'locale' => function () {
                return app()->getLocale();
            },
            'language' => function () {
                return translations(
                    base_path('lang/' . app()->getLocale() . '.json')
                );
            },
            'flash' => [
                'message' => fn () => $request->session()->get('message')
            ],
            'authUser' => isset($auth) ? $auth : null
        ]);
    }
}
