<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LockDatabase implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
  
    public function __construct(
        public ?string $is_ticket_locked
        )
    {

        $this->is_ticket_locked = $is_ticket_locked;
    }

 
    public function broadcastOn(): array
    {
        return ['ticket-lock'];
    }
    
    public function broadcastAs() {
        return 'database';
    }
}
