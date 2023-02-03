<?php

namespace App\Listeners;

use App\Events\SubscriberRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class NewSubscriberNotification
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
     * @param  \App\Events\SubscriberRegistered  $event
     * @return void
     */
    public function handle(SubscriberRegistered $event)
    {
        if ($event->subscriber instanceof MustVerifyEmail && !$event->subscriber->hasVerifiedEmail()) {
            $event->subscriber->sendEmailVerificationNotification();
        }
    }
}
