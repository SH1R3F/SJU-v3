<?php

namespace App\Payment;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Services\InvoiceService;
use App\Payment\PaymentInterface;
use Illuminate\Support\Facades\Http;

class OppwaPayment implements PaymentInterface
{

    private $env;
    private $mada;
    private $visa;
    private $url;
    private $auth;

    private $invoice;


    public function __construct(array $config)
    {
        $env = 'live'; // app()->env == 'production' ? 'live' : 'test';

        $this->env  = $env;
        $this->mada = $config[$env]['mada'];
        $this->visa = $config[$env]['visa'];
        $this->url  = $config[$env]['url'];
        $this->auth = $config[$env]['auth'];

        $this->invoice = new InvoiceService;
    }


    /**
     * Prepare the payment gateway and display it.
     * 
     * @param int  $payment_method
     * @param $price
     * @param $member
     * @return InertiaView
     */
    public function gateway(int $payment_method, $price, $member)
    {
        $response = Http::asForm()->withHeaders([
            'Authorization' => 'Bearer ' . $this->auth,
        ])->post($this->url, array_merge([
            'entityId' => $payment_method == 2 ? $this->mada : $this->visa,
            'amount'   => number_format((float)$price, 2, '.', ''),
            'currency' => 'SAR',
            'paymentType' => 'DB',
            'merchantTransactionId' => $ref = 'SJU-' . time(),
            'billing.street1' => 'Jubail',
            'billing.city' => 'Jubail',
            'billing.state' => 'ES',
            'billing.country' => 'SA',
            'billing.postcode' => '31961',
            'customer.givenName' => $member->fname_ar,
            'customer.surname' => $member->lname_ar,
            'customer.mobile' => $member->mobile,
            'customer.email' => $member->email,
            'customParameters[SHOPPER_productname]' => $member->national_id . '-' . __(config('sju.memberships')[$member->subscription->type]['name']),
        ], $this->env == 'test' ? [
            'testMode' => 'EXTERNAL',
        ] : []));

        $json = $response->json();

        if (!$json['result']['code'] == '000.200.100') {
            throw new RuntimeException($json['result']['description']);
        }

        // Save transaction info for verification later
        $member->transactions()->create(['checkout_id' => $json['id'], 'payment_method' => $payment_method, 'cart_ref' => $ref]);

        return inertia('Members/Payment/OppwaGateway', [
            'memberships' => config('sju.memberships'),
            'payment_method' => $payment_method,
            'script' => 'https://' . ($this->env == 'test' ? 'test.' : '') . 'oppwa.com/v1/paymentWidgets.js?checkoutId=' . $json['id']
        ]);
    }

    /**
     * Verify the payment status.
     * 
     * @param \Illuminate\Http\Request  $request
     * @return int
     */
    public function verify(Request $request)
    {
        $id = $request->id;
        $transaction = Transaction::where('checkout_id', $id)->firstOrFail();

        $response = Http::asForm()->withHeaders([
            'Authorization' => "Bearer {$this->auth}",
        ])->get("{$this->url}/{$id}/payment", [
            'entityId' => $transaction->payment_method == 2 ? $this->mada : $this->visa,
        ]);

        $json = $response->json();

        // Save first response for any debuging later
        if (!$transaction->response) $transaction->update(['response' => $json]);

        if (preg_match('/^(000\.000\.|000\.100\.1|000\.[36])/', $json['result']['code'])) {
            // Create invoice
            $this->invoice->create($transaction->member, $json);
            return Transaction::STATUS_SUCCESS;
        }
        if (preg_match('/^(000\.400\.0[^3]|000\.400\.100)/', $json['result']['code'])) return Transaction::STATUS_PENDING;
        if (str_contains($json['result']['description'], 'have you paid more than 30min ago')) return Transaction::STATUS_EXPIRED;

        // Else
        return Transaction::STATUS_FAILED;
    }
}
