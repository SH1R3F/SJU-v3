<?php

namespace App\Events;

use App\Models\Volunteer;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class VolunteerRegistered
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The authenticated volunteer.
     *
     * @var \App\Models\Volunteer
     */
    public $volunteer;

    /**
     * Create a new event instance.
     *
     * @param  \App\Models\Volunteer  $volunteer
     * @return void
     */
    public function __construct(Volunteer $volunteer)
    {
        $this->volunteer = $volunteer;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
