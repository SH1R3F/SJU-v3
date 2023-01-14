<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \App\Payment\PaymentManager gateway(int $payment_method)
 *
 * @see \App\Payment\PaymentManager
 */
class Payment extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'payment';
    }
}
