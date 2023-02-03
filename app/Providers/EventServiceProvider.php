<?php

namespace App\Providers;

use App\Events\MemberRegistered;
use App\Events\SubscriberRegistered;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Listeners\NewVolunteerNotification;
use App\Listeners\NewSubscriberNotification;
use App\Listeners\SendMemberEmailVerificationNotification;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        MemberRegistered::class => [],
        SubscriberRegistered::class => [
            NewSubscriberNotification::class
        ],
        VolunteerRegistered::class => [
            NewVolunteerNotification::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
