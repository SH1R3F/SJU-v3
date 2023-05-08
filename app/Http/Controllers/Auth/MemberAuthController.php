<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Facades\Sms;
use App\Models\Branch;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Events\MemberRegistered;
use App\Rules\MemberUniqueMobile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Member\LoginRequest;

class MemberAuthController extends Controller
{

    /**
     * Display the login view.
     */
    public function showLoginForm()
    {
        return inertia('Members/Auth/Login');
    }

    /**
     * Perform the login action.
     * @param \App\Http\Requests\Member\LoginRequest  $request
     */
    public function login(LoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();
        return redirect()->intended(Member::HOME);
    }

    /**
     * Perform the login action.
     * @param \Illuminate\Http\Request  $request
     */
    public function logout(Request $request)
    {
        Auth::guard('member')->logout();
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();
        return redirect()->route('member.login');
    }

    /**
     * Display the registration view.
     * Asks for national id
     */
    public function showRegisterForm()
    {
        $member = session()->get('member');
        return inertia('Members/Auth/Register/Step1', compact('member'));
    }

    /**
     * Validate step 1 and display the registration step 2.
     * Asks for phone number
     * @param \Illuminate\Http\Request  $request
     */
    public function registerStep2(Request $request)
    {
        if ($request->isMethod('POST')) {
            // Validate step 1 data.
            $data = $request->validate(['national_id' => ['required', 'numeric', 'digits_between:9,10', 'unique:members']]);

            // If validated Set session
            $member = new Member($data);
            session()->put('member', $member);
        } else {
            $member = session()->get('member');
        }

        // Return view
        return inertia('Members/Auth/Register/Step2', compact('member'));
    }

    /**
     * Send verification code to mobile.
     * Generate and send verification code to mobile
     * @param \Illuminate\Http\Request  $request
     */
    public function sendVerificationCode(Request $request)
    {
        // Validate mobile
        $request->validate(['mobile' => ['required', 'numeric', 'regex:/^(5)\d{8}$/', new MemberUniqueMobile]]);

        // Throttle here
        $member = session()->get('member');
        $code = rand(111111, 999999);
        $member->mobile_code = $code;
        $member->mobile = $request->mobile;
        $member->mobile_verified_at = null;
        session()->put('member', $member);

        // Send code to his mobile
        Sms::send(__('Verification code for :mobile is :code to register an account on Saudi journalists association', ['mobile' => $request->mobile, 'code' => $code]), "966{$request->mobile}");
    }

    /**
     * Validate step 2 and display the registration step 3.
     * Asks for subscription type and delivery options
     * @param \Illuminate\Http\Request  $request
     */
    public function registerStep3(Request $request)
    {
        $member = session()->get('member');
        // Validate step 2 first.
        if ($request->isMethod('POST')) {
            $request->validate([
                'mobile'     => ['required', 'numeric', 'regex:/^(5)\d{8}$/', Rule::in([$member->mobile]), new MemberUniqueMobile],
                'mobilecode' => [
                    'required', 'numeric',
                    function ($attribute, $value, $fail) use ($member) {
                        if ($value != $member->mobile_code) $fail(__('Mobile code is incorrect'));
                    }
                ]
            ]);
            // Code is correct.. Verify!
            $member->mobile_verified_at = now();
            $member->mobile_code = null;
            session()->put('member', $member);
        }

        // Return view
        $branches = Branch::orderBy('id')->get(['id', 'name']);
        $member_type = session()->get('member_type');
        return inertia('Members/Auth/Register/Step3', compact('member', 'branches', 'member_type'));
    }

    /**
     * Validate step 3 and display the registration step 4.
     * Asks for member information
     * @param \Illuminate\Http\Request  $request
     */
    public function registerStep4(Request $request)
    {
        $member = session()->get('member');

        // Validate step 3 first.
        if ($request->isMethod('POST')) {
            $data = $request->validate([
                'type' => ['required', 'numeric', 'in:1,2,3'],
                'branch_id' => ['required', 'numeric', 'exists:branches,id'],
                'delivery_option' => ['required', 'numeric', 'in:1,2'],
                'delivery_address' => ['required_if:delivery_option,2']
            ]);
            $member->fill($data);
            session()->put('member', $member);
            session()->put('member_type', $data['type']);
        }

        // Return view
        $nationalities = config('sju.nationalities', []);
        return inertia('Members/Auth/Register/Step4', compact('member', 'nationalities'));
    }

    /**
     * Validate step 4 and display the registration step 5.
     * Asks for password
     * @param \Illuminate\Http\Request  $request
     */
    public function registerStep5(Request $request)
    {
        $member = session()->get('member');

        // Validate step 4 first.
        if ($request->isMethod('POST')) {
            $data = $request->validate([
                'national_id_source' => ['required', 'string', 'max:255'],
                'national_id_date' => ['required', 'date'],
                'fname_ar' => ['required', 'string', 'max:255'],
                'sname_ar' => ['required', 'string', 'max:255'],
                'tname_ar' => ['required', 'string', 'max:255'],
                'lname_ar' => ['required', 'string', 'max:255'],
                'fname_en' => ['required', 'string', 'max:255'],
                'sname_en' => ['required', 'string', 'max:255'],
                'tname_en' => ['required', 'string', 'max:255'],
                'lname_en' => ['required', 'string', 'max:255'],
                'gender' => ['required', 'boolean'],
                'birthday_h' => ['required', 'date'],
                'birthday_m' => ['required', 'date'],
                'nationality' => ['required', 'string', Rule::in(array_keys(config('sju.nationalities', [])))],
                'qualification' => ['required', 'string', 'max:255'],
                'major' => ['required', 'string', 'max:255'],
                'journalistic_profession' => ['required', 'string', 'max:255'],
                'journalistic_employer' => ['required', 'string', 'max:255'],
                'newspaper_type' => ['required', 'numeric', 'in:1,2'],
                'non_journalistic_profession' => ['required', 'string', 'max:255'],
                'non_journalistic_employer' => ['required', 'string', 'max:255'],
                'workphone' => ['required', 'numeric'],
                'workphone_ext' => ['required', 'numeric'],
                'fax' => ['required', 'numeric'],
                'fax_ext' => ['required', 'numeric'],
                'postbox' => ['required', 'numeric'],
                'postcode' => ['required', 'numeric'],
                'postcity' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'unique:members']
            ]);
            // If validated update session
            $member->fill($data);
            session()->put('member', $member);
        }

        // Return view
        return inertia('Members/Auth/Register/Step5', compact('member'));
    }

    /**
     * Validate step 5 and display the registration step 6.
     * Reviews all info before registration
     * @param \Illuminate\Http\Request  $request
     */
    public function registerStep6(Request $request)
    {
        $member = session()->get('member');
        $member_type = session()->get('member_type');
        if ($request->isMethod('POST')) {
            // Validate step 5 first.
            $request->validate([
                'password' => ['required', 'min:6', 'confirmed']
            ]);

            // Hash password & fill
            $member->fill(['password' => bcrypt($request->password)]);
            session()->put('member', $member);
        }

        // Return view
        $memberships = config('sju.memberships', []);
        $branches = Branch::orderBy('id')->get(['id', 'name']);
        $nationalities = config('sju.nationalities', []);
        return inertia('Members/Auth/Register/Step6', compact('member', 'member_type', 'memberships', 'branches', 'nationalities'));
    }

    /**
     * Register the member stored in session
     * @param \Illuminate\Http\Request  $request
     */
    public function register(Request $request)
    {
        $request->validate(['agreement' => 'required|accepted']);

        $member = session()->get('member');
        $member_type = session()->get('member_type');


        $validator = Validator::make(
            ['national_id' => $member->national_id],
            ['national_id' => ['required', 'numeric', 'digits_between:9,10', 'unique:members']]
        );

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }


        // Register the member
        $member->save();
        // Register his subscription
        $member->subscription()->create(['type' => $member_type, 'end_date' => Carbon::now()->endOfYear()]);
        // Fire event
        event(new MemberRegistered($member));

        // Clear session
        session()->forget(['member', 'member_type']);

        // Log him in
        Auth::guard('member')->login($member);
        $request->session()->regenerate();
        return redirect()->to(Member::HOME);
    }
}
