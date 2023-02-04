<?php

namespace App\Sms;

use App\Sms\TwilioSmser;
use App\Sms\VonageSmser;
use App\Sms\TaqnyatSmser;
use Illuminate\Support\Manager;

class SmsManager extends Manager
{

    /**
     * Get the default driver name.
     *
     * @return string
     */
    public function getDefaultDriver()
    {
        return $this->config->get('sms.default', 'taqnyat');
    }


    /**
     * Create an instance of the Twilio sms Driver.
     *
     * @return \App\Sms\TwilioSmser
     */
    public function createTwilioDriver()
    {
        return new TwilioSmser($this->config->get('sms.smsers.twilio') ?? []);
    }


    /**
     * Create an instance of the Vonage sms Driver.
     *
     * @return \App\Sms\VonageSmser
     */
    public function createVonageDriver()
    {
        return new VonageSmser($this->config->get('sms.smsers.vonage') ?? []);
    }

    /**
     * Create an instance of the Taqnyat sms Driver.
     *
     * @return \App\Sms\TaqnyatSmser
     */
    public function createTaqnyatDriver()
    {
        return new TaqnyatSmser($this->config->get('sms.smsers.taqnyat') ?? []);
    }
}
