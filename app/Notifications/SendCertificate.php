<?php

namespace App\Notifications;

use Mpdf\Mpdf;
use Illuminate\Bus\Queueable;
use App\Services\CertificateService;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SendCertificate extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(public $code, public $course)
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
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $path = (new CertificateService)->generateCertificate($this->course, $notifiable, $this->code, true);
        return (new MailMessage)
            ->subject('شكراً لمشاركتك بالفعالية | هيئة الصحفيين السعوديين')
            ->view('emails.certificate', ['user' => $notifiable, 'course' => $this->course])
            ->attach($path, [
                'as' => 'شهادة حضور الفعالية.pdf',
                'mime' => 'application/pdf',
            ]);
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
            //
        ];
    }
}
