<?php

namespace App\Http\Controllers\Volunteer;

use App\Models\Branch;
use Illuminate\Http\Request;
use App\Models\Course\Course;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\CourseResource;

class VolunteerController extends Controller
{
    /**
     * Display my courses page for volunteer
     */
    public function courses()
    {
        $upcoming = Course::query()
            ->whereIn('status', [1, 2, 3, 4])
            // Uncomment this if you want registered courses not to appear in upcoming courses
            // ->whereNotIn('id', Auth::guard('volunteer')->user()->courses->pluck('id'))
            ->whereDate('date_from', '>=', now())->orderBy('date_from', 'ASC')
            ->get();

        $registered = Auth::guard('volunteer')->user()
            ->courses()
            ->orderBy('date_from', 'DESC')
            ->get();

        return inertia('Volunteers/Courses', [
            'upcoming' => CourseResource::collection($upcoming),
            'registered' => CourseResource::collection($registered),
        ]);
    }

    /**
     * Display volunteer profile information form.
     *
     * @return \Illuminate\Http\Response
     */
    public function info()
    {
        $countries = config('sju.countries', []);
        $cities = config('sju.cities', []);
        $qualifications = config('sju.qualifications', []);
        $nationalities = config('sju.nationalities_ar', []);
        $branches = Branch::orderBy('id')->get(['id', 'name']);
        return inertia('Volunteers/Profile/Info', compact('countries', 'qualifications', 'cities', 'nationalities', 'branches'));
    }

    /**
     * Post volunteer profile information form.
     *
     * @param \Illuminate\Http\Request $Request
     * @return \Illuminate\Http\Response
     */
    public function postInfo(Request $request)
    {
        $data = $request->validate([
            'country' => ['required', 'string', Rule::in(array_keys(config('sju.countries')))],
            'city' => ['nullable', 'required_if:country,المملكة العربية السعودية', 'numeric', Rule::in(array_keys(config('sju.cities')))],
            'branch_id' => ['required', 'numeric', 'exists:branches,id'],
            'nationality' => ['required', 'string', Rule::in(array_keys(config('sju.nationalities_ar')))],
            'qualification' => ['required', 'numeric', Rule::in(array_keys(config('sju.qualifications')))],
            'gender' => ['required', 'string', 'in:male,female'],
            'mobile' => ['required', 'numeric'],
            'mobile_key' => ['required', 'numeric', Rule::in(array_values(config('sju.countries')))],
        ]);

        Auth::guard('volunteer')->user()->update($data);
        return redirect()->back()->with('message', __('Your information has been updated successfully'));
    }

    /**
     * Display volunteer's password update form.
     *
     * @return \Illuminate\Http\Response
     */
    public function password()
    {
        return inertia('Volunteers/Profile/Password');
    }

    /**
     * Post volunteer's password update.
     *
     * @param \Illuminate\Http\Request $Request
     * @return \Illuminate\Http\Response
     */
    public function postPassword(Request $request)
    {
        $user = Auth::guard('volunteer')->user();
        $request->validate([
            'password' => ['required', function ($attribute, $value, $fail) use ($user) {
                if (!Hash::check($value, $user->password)) $fail(__('Password is incorrect'));
            }],
            'new_password' => ['required', 'min:6', 'confirmed']
        ]);

        // Save password
        $user->update(['password' => Hash::make($request->new_password)]);

        return redirect()->back()->with('message', __('Your information has been updated successfully'));
    }
}
