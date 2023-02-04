<?php

namespace App\Sms;

use RuntimeException;
use App\Sms\SmsInterface;
use Illuminate\Support\Facades\Http;

class VonageSmser implements SmsInterface
{


    private $api_key;
    private $api_secret;
    private $from;


    public function __construct(array $config)
    {
        $this->api_key = $config['api_key'];
        $this->api_secret = $config['api_secret'];
        $this->from = $config['from'];
    }


    /**
     * Send a message to specific number
     */
    public function send(string $message, string $number)
    {
        $response = Http::asForm()->post("https://rest.nexmo.com/sms/json", [
            'to' => $number,
            'from' => $this->from,
            'text' => $message,
            'api_key' => $this->api_key,
            'api_secret' => $this->api_secret
        ]);

        $json = $response->json();

        if (!$json) throw new RuntimeException("Couldn't connect to vonage API");

        if ($json['messages'][0]['status'] != 0) throw new RuntimeException($json['messages'][0]['error-text']);
    }


    /**
     * Get the available balance in my account 
     */
    public function balance()
    {
        $response = Http::asForm()->get("https://rest.nexmo.com/account/get-balance", [
            'api_key' => $this->api_key,
            'api_secret' => $this->api_secret
        ]);

        $json = $response->json();

        if (!$json) throw new RuntimeException("Couldn't connect to vonage API");

        return $json['value'] . ' USD';
    }
}
