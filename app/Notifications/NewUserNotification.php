<?php

namespace App\Notifications;

use App\Models\Member;
use App\Models\SiteOption;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewUserNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        $via = ['mail'];

        if ($notifiable instanceof Member) {
            $option = SiteOption::where('key', 'sms_upon_registration')->first();
            if ($option && $option->value == 'yes') {
                array_push($via, 'sms');
            }
        }

        return $via;
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)->subject('مرحباً بك في هيئة الصحفيين السعوديين')->view('emails.welcome', ['user' => $notifiable]);
    }

    /**
     * Get the sms representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toSms($notifiable)
    {
        return SiteOption::where('key', 'sms_upon_registration_template')->first()?->value;
    }
}
