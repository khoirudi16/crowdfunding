<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\User;

class UserRegisteredEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $otp;
    public $name;
    public $email_to;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($otp, $name, $email_to)
    {
        $this->otp = $otp;
        $this->name = $name;
        $this->email_to = $email_to;
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
