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
        public string $importance,
        public string $urgency,
        public string $user_id,
        public string $ticket_status,
        public string $actual_response,
        public string $actual_resolve,
        public string $modified_date,
        public string $reference_date,
        public string $remarks,
        public string $task_type_id,
        )
    {
        $this->importance = $importance;
        $this->urgency = $urgency;
        $this->user_id = $user_id;
        $this->ticket_status = $ticket_status;
        $this->actual_response = $actual_response;
        $this->actual_resolve = $actual_resolve;
        $this->modified_date = $modified_date;
        $this->reference_date = $reference_date;
        $this->remarks = $remarks;
        $this->task_type_id = $task_type_id;
    }

 
    public function broadcastOn(): array
    {
        return ['ticket-queue'];
    }
    
    public function broadcastAs() {
        return 'ticket';
    }
}
