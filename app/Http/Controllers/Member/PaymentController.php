<?php

namespace App\Http\Controllers\Member;

use Carbon\Carbon;
use App\Facades\Payment;
use App\Models\Transaction;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Services\MemberService;
use App\Services\InvoiceService;
use App\Http\Controllers\Controller;
use App\Notifications\MembershipPaid;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{

    /**
     * Display the Choose-card form
     * with terms and conditions of payment
     */
    public function card()
    {
        // Update subscription for this year if not existing..
        // TO DO

        return inertia('Members/Payment/Card', ['memberships' => config('sju.memberships')]);
    }

    /**
     * Generate & display the payment gateway for selected card type
     * 
     * @param \Illuminate\Http\Request  $request
     */
    public function gateway(Request $request)
    {
        $data = $request->validate((['payment_method' => ['required', 'in:1,2'], 'agreement' => ['required', 'accepted']]));

        // Prepare gateway
        $member = Auth::guard('member')->user();
        $price = config('sju.memberships')[$member->subscription->type]['price'] + ($member->delivery_option == 2 ? config('sju.memberships.delivery_fees') : 0);
        return Payment::gateway($data['payment_method'], $price, $member);
    }

    /**
     * Handle the payment response
     * 
     * @param \Illuminate\Http\Request  $request
     * @param \App\Services\InvoiceService  $request
     * @param \App\Services\MemberService  $request
     */
    public function response(Request $request, MemberService $service)
    {
        $status = Payment::verify($request);

        if ($status !== Transaction::STATUS_SUCCESS) return redirect()->route('member.subscription')->with('error', Transaction::responses($status));
        /**
         * Payment succeed
         */
        // Update subscription
        $member = Auth::guard('member')->user();
        $member->subscription()->update([
            'start_date' => Carbon::today(),
            'end_date' => Carbon::now()->endOfYear(),
            'status' => Subscription::SUBSCRIPTION_ACTIVE
        ]);
        $member->notify(new MembershipPaid);

        // Give membership number
        $service->membershipNumber($member);

        return redirect()->route('member.subscription')->with('message', Transaction::responses($status));
    }
}
