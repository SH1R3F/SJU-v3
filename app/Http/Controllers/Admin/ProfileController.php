<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\AdminResource;

class ProfileController extends Controller
{
    /**
     * Update my profile
     */
    public function index()
    {
        return inertia('Admin/Profile', [
            'admin' => new AdminResource(Auth::guard('admin')->user()->load('branch')),
        ]);
    }

    /**
     * Update my profile
     */
    public function update(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $data = $request->validate([
            'fname_ar' => ['required', 'string', 'max:255'],
            'lname_ar' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', Rule::unique('admins')->ignore($admin)],
            'email' => ['required', 'string', 'max:255', Rule::unique('admins')->ignore($admin)],
            'mobile' => ['required', 'numeric', 'digits_between:1,13', Rule::unique('admins')->ignore($admin)],
            'password' => ['nullable', 'string', 'min:6', 'max:255', 'confirmed']
        ]);

        // Hash password
        if ($data['password']) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        // Update
        $admin->update($data);

        return redirect()->back()->with('message', __('Updated successfully'));
    }
}
