<?php

namespace App\Payment;

use App\Payment\OppwaPayment;
use Illuminate\Support\Manager;

class PaymentManager extends Manager
{

    /**
     * Get the default driver name. (Default payment gateway)
     *
     * @return string
     */
    public function getDefaultDriver()
    {
        return $this->config->get('payment.default', 'oppwa');
    }

    /**
     * Create an instance of the OPPWA provider.
     *
     * @return \App\Payment\OppwaPayment
     */
    public function createOppwaDriver()
    {
        return new OppwaPayment($this->config->get('payment.providers.oppwa', []));
    }
}
