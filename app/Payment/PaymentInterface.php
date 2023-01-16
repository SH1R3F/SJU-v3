<?php

namespace App\Payment;

use Illuminate\Http\Request;
use App\Services\InvoiceService;

interface PaymentInterface
{
    /**
     * Prepare and display the payment gateway.
     * 
     * @param int  $payment_method
     * @param $price
     * @param $member
     */
    public function gateway(int $payment_method, $price, $member);

    /**
     * Verify the payment status.
     * 
     * @param \Illuminate\Http\Request  $request
     * @return int
     */
    public function verify(Request $request);
}
