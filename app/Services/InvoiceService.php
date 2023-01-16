<?php

namespace App\Services;

use App\Models\Member;
use App\Models\Invoice;

class InvoiceService
{
    /**
     * Create invoice
     * 
     * @param \App\Models\Member  $member
     * @param array  $data
     */
    public function create(Member $member, $data)
    {
        // Create invoice
        Invoice::create([
            'invoice_number' => $this->generateInvoiceNumber(),
            'member_id' => $member->id,
            'subscription_id' => $member->subscription->id,
            'amount' => $data['amount'],
            'order_data' => $data
        ]);

        // Send it by mail
        // TO BE ADDED

    }

    /**
     * Generate invoice number
     * 
     * @return string
     */
    private function generateInvoiceNumber()
    {
        $last = Invoice::orderBy('invoice_number', 'DESC')->first();
        if ($last) {
            $num = intval($last->invoice_number) + 1;
        } else {
            $num = 1;
        }

        return str_pad($num, 7, '0', STR_PAD_LEFT);
    }
}
