<?php

namespace App\Sms;

use App\Sms\TwilioSmser;
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
        return $this->config->get('sms.driver', 'twilio');
    }


    /**
     * Create an instance of the Twilio sms Driver.
     *
     * @return \Illuminate\Hashing\BcryptHasher
     */
    public function createTwilioDriver()
    {
        return new TwilioSmser($this->config->get('sms.smsers.twilio') ?? []);
    }
}
