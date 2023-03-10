<?php

namespace App\Channels;

use App\Facades\Sms;
use Illuminate\Notifications\Notification;

class SmsChannel
{
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toSms($notifiable);

        // Send notification to the $notifiable instance...
        Sms::send($message, $notifiable->prepareMobileForSms());
    }
}
