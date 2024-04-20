<?php

namespace Database\Seeders;

use App\Models\Ticket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tickets = [
            [
                "user_client_type_id" => 1,
                "task_type_id" => 1,
                "assigned_to" => 2,
                "ticket_number" => "H001"
            ],
            [
                "user_id" => 2,
                "task_type_id" => 2,
                "assigned_to" => 1,
                "ticket_number" => "S001"

            ],
        ];
        foreach ($tickets as $ticket){
            Ticket::factory()->create($ticket);
        }
    }
}
