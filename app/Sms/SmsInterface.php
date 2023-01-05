<?php

namespace App\Sms;

interface SmsInterface
{
    /**
     * Send a message to specific number
     */
    public function send(string $message, string $number);
}
