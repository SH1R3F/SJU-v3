<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteOption;
use Illuminate\Http\Request;

class SiteOptionController extends Controller
{
    public function index()
    {
        $this->authorize('manage', SiteOption::class);

        $categories = SiteOption::all()->groupBy('category');

        return inertia('Admin/SiteOptions/Index', compact('categories'));
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
