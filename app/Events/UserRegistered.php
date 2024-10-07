<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserRegistered implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $userName;

    public string $message;

    public function __construct(string $userName, string $message)
    {
        $this->userName = $userName;
        $this->message = $message;
    }

    /**
     * @return Channel
     */
    public function broadcastOn()
    {
        return new Channel('notifications');
    }

    public function broadcastAs(): string
    {
        return 'user-registered';
    }
}
