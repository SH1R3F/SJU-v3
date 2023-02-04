<?php

namespace App\Sms;

use RuntimeException;
use App\Sms\SmsInterface;
use Illuminate\Support\Facades\Http;

class TwilioSmser implements SmsInterface
{


    private $auth_token;
    private $account_sid;
    private $service_sid;


    public function __construct(array $config)
    {
        $this->auth_token = $config['auth_token'];
        $this->account_sid = $config['account_sid'];
        $this->service_sid = $config['service_sid'];
    }


    /**
     * Send a message to specific number
     */
    public function send(string $message, string $number)
    {
        $response = Http::asForm()->withBasicAuth($this->account_sid, $this->auth_token)->post("https://api.twilio.com/2010-04-01/Accounts/{$this->account_sid}/Messages.json", [
            'To' => $number,
            'MessagingServiceSid' => $this->service_sid,
            'Body' => $message,
        ]);

        $json = $response->json();

        if ($json['status'] !== 'accepted') {
            throw new RuntimeException($json['message']);
        }
    }


    /**
     * Get the available balance in my account 
     */
    public function balance()
    {
        $response = Http::asForm()->withBasicAuth($this->account_sid, $this->auth_token)->get("https://api.twilio.com/2010-04-01/Accounts/{$this->account_sid}/Balance.json");

        $json = $response->json();

        if (isset($json['code'], $json['status']) && $json['status'] != 200) {
            throw new RuntimeException($json['message']);
        }

        return $json['balance'] . ' ' .  $json['currency'];
    }
}
