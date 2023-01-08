<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MemberRegistrationSteps
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
        switch ($request->route()->getName()) {
            case 'member.register.step2': // Contact info page
                if ($request->isMethod('GET')) {
                    // Validate he has member session with national id
                    $member = session()->get('member');
                    if (!$member || !$member->national_id) return redirect()->route('member.register');
                }
                break;

            case 'member.register.verify.send': // Send mobile verification code
                $member = session()->get('member');
                if (!$member || !$member->national_id) return redirect()->route('member.register');
                break;

            case 'member.register.step3': // Subscription types and card delivery
                if ($request->isMethod('GET')) {
                    $member = session()->get('member');
                    if (!$member || !$member->mobile_verified_at) return redirect()->route('member.register.step2');
                    break;
                }
                break;

            case 'member.register.step4': // Member info
                if ($request->isMethod('GET')) {
                    $member = session()->get('member');
                    if (!$member || !$member->branch_id) return redirect()->route('member.register.step3');
                    break;
                }
                break;

            case 'member.register.step5': // Login info
                if ($request->isMethod('GET')) {
                    $member = session()->get('member');
                    if (!$member || !$member->national_id_source) return redirect()->route('member.register.step4');
                    break;
                }
                break;

            case 'member.register.step6': // Review info
                if ($request->isMethod('GET')) {
                    $member = session()->get('member');
                    if (!$member || !$member->password) return redirect()->route('member.register.step5');
                    break;
                }
                break;
        }


        return $next($request);
    }
}
