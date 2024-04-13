<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TicketQueue implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
  
    public function __construct(
        public ?string $ticket_id,
        public ?string $user_id,
        public ?string $task_type_id,
        public ?string $ticket_status,
        public ?string $reference_date,
        public ?string $task,
        public ?string $category_id,
        public ?string $difficulty,
        public ?string $urgency,
        public ?string $importance,
        public ?string $client_type,
        )
    {

        $this->ticket_id = $ticket_id;
        $this->user_id = $user_id;
        $this->task_type_id = $task_type_id;
        $this->ticket_status = $ticket_status;
        $this->reference_date = $reference_date;
        $this->task = $task;
        $this->category_id = $category_id;
        $this->difficulty = $difficulty;
        $this->urgency = $urgency;
        $this->importance = $importance;
        $this->client_type = $client_type;
    }

 
    public function broadcastOn(): array
    {
        return ['ticket-queue'];
    }
    
    public function broadcastAs() {
        return 'ticket';
    }
}
