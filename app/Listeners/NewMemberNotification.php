<?php

namespace App\Listeners;

use App\Events\MemberRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\NewUserNotification as MemberNotification;

class NewMemberNotification
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
     * @param  \App\Events\MemberRegistered  $event
     * @return void
     */
    public function handle(MemberRegistered $event)
    {
        $event->member->notify(new MemberNotification);
    }
}
