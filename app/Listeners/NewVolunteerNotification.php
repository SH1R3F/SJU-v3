<?php

namespace App\Listeners;

use App\Events\VolunteerRegistered;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\NewUserNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class NewVolunteerNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\VolunteerRegistered  $event
     * @return void
     */
    public function handle(VolunteerRegistered $event)
    {
        $event->volunteer->notify(new NewUserNotification);
        if ($event->volunteer instanceof MustVerifyEmail && !$event->volunteer->hasVerifiedEmail()) {
            $event->volunteer->sendEmailVerificationNotification();
        }
    }
}
