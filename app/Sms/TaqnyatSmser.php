<?php

namespace App\Sms;

use RuntimeException;
use App\Sms\SmsInterface;
use Illuminate\Support\Facades\Http;

class TaqnyatSmser implements SmsInterface
{

    private $bearer;
    private $sender;

    public function __construct(array $config)
    {
        $this->bearer = $config['bearer'];
        $this->sender = $config['sender'];
    }


    /**
     * Send a message to specific number
     */
    public function send(string $message, string $number)
    {
        $response = Http::withHeaders(['Authorization' => "Bearer {$this->bearer}"])->post('https://api.taqnyat.sa/v1/messages', [
            'sender'     => $this->sender,
            'recipients' => $number,
            'body'       => $message,
        ]);

        $json = $response->json();
        if ($json['statusCode'] != 201) {
            logger('Registration message failed sending _____________');
            logger($json);
        }
    }

    /**
     * Get the available balance in my account 
     */
    public function balance()
    {
        $response = Http::withHeaders(['Authorization' => "Bearer {$this->bearer}"])->get('https://api.taqnyat.sa/account/balance');

        $json = $response->json();

        if ($json['statusCode'] != 200) {
            logger('Failed getting current balance! _____________');
            logger($json);
        }

        return $json['balance'] . ' ' . $json['currency'];
    }
}
