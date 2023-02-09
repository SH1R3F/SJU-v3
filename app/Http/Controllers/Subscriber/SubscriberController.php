<?php

namespace App\Http\Controllers\Subscriber;

use Illuminate\Http\Request;
use App\Models\Course\Course;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\CourseResource;

class SubscriberController extends Controller
{

    /**
     * Display my courses page for subscribers
     */
    public function courses()
    {
        $upcoming = Course::query()
            ->whereIn('status', [1, 2, 3, 4])
            // Uncomment this if you want registered courses not to appear in upcoming courses
            // ->whereNotIn('id', Auth::guard('subscriber')->user()->courses->pluck('id'))
            ->whereDate('date_from', '>=', now())->orderBy('date_from', 'ASC')
            ->get();

        $registered = Auth::guard('subscriber')->user()
            ->courses()
            ->orderBy('date_from', 'DESC')
            ->get();

        return inertia('Subscribers/Courses', [
            'upcoming' => CourseResource::collection($upcoming),
            'registered' => CourseResource::collection($registered),
        ]);
    }

    /**
     * Display subscriber profile information form.
     *
     * @return \Illuminate\Http\Response
     */
    public function info()
    {
        $countries = config('sju.countries', []);
        $cities = config('sju.cities', []);
        $qualifications = config('sju.qualifications', []);
        return inertia('Subscribers/Profile/Info', compact('countries', 'qualifications', 'cities'));
    }

    /**
     * Post subscriber profile information form.
     *
     * @param \Illuminate\Http\Request $Request
     * @return \Illuminate\Http\Response
     */
    public function postInfo(Request $request)
    {
        $data = $request->validate([
            'country' => ['required', 'string', Rule::in(array_keys(config('sju.countries')))],
            'city' => ['nullable', 'required_if:country,المملكة العربية السعودية', 'numeric', Rule::in(array_keys(config('sju.cities')))],
            'qualification' => ['required', 'numeric', Rule::in(array_keys(config('sju.qualifications')))],
            'mobile' => ['required', 'numeric'],
            'mobile_key' => ['required', 'numeric', Rule::in(array_values(config('sju.countries')))],
        ]);

        Auth::guard('subscriber')->user()->update($data);
        return redirect()->back()->with('message', __('Your information has been updated successfully'));
    }

    /**
     * Display subscriber's password update form.
     *
     * @return \Illuminate\Http\Response
     */
    public function password()
    {
        return inertia('Subscribers/Profile/Password');
    }

    /**
     * Post subscriber's password update.
     *
     * @param \Illuminate\Http\Request $Request
     * @return \Illuminate\Http\Response
     */
    public function postPassword(Request $request)
    {
        $user = Auth::guard('subscriber')->user();
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
