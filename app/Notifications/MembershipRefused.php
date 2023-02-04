<?php

namespace App\Notifications;

use App\Models\SiteOption;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class MembershipRefused extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        $via = ['database'];

        $option = SiteOption::where('key', 'sms_upon_refusal')->first();
        if ($option && $option->value == 'yes') {
            array_push($via, 'sms');
        }

        return $via;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message' => "تم رفض عضويتك بهيئة الصحفيين السعوديين، السبب: {$notifiable->refusal_reason}",
        ];
    }


    /**
     * Get the sms representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toSms($notifiable)
    {
        return SiteOption::where('key', 'sms_upon_refusal_template')->first()?->value . $notifiable->refusal_reason;
    }
}
