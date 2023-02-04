<?php

namespace App\Notifications;

use App\Models\SiteOption;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class MembershipPaid extends Notification implements ShouldQueue
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

        $option = SiteOption::where('key', 'sms_upon_payment')->first();
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
            'message' => "تمت عملية الدفع وتفعيل العضوية بنجاح.",
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
        return SiteOption::where('key', 'sms_upon_payment_template')->first()?->value;
    }
}
