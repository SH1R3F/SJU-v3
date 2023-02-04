<?php

namespace App\Http\Controllers\Admin;

use App\Facades\Sms;
use App\Models\SiteOption;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class SiteOptionController extends Controller
{
    public function index()
    {
        $this->authorize('manage', SiteOption::class);

        $categories = SiteOption::all()->groupBy('category');

        $service = [
            'provider' => config('sms.default'),
            'balance'  => Cache::remember('sms-balance', 60 * 60, fn () => Sms::balance())
        ];

        return inertia('Admin/SiteOptions/Index', compact('categories', 'service'));
    }

    public function update(Request $request)
    {
        $this->authorize('manage', SiteOption::class);

        $data = $request->validate(['categories' => ['required', 'array']]);

        foreach ($data['categories'] as $category => $options) {
            foreach ($options as $option) {
                SiteOption::find($option['id'])->update($option);
            }
        }

        return redirect()->back()->with('message', __('Updated successfully'));
    }
}
