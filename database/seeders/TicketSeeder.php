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
                "user_id" => 1,
                "ticket_status" => "Pending",
             
                "task_type_id" => 2,
                "assigned_to" => 2,
             
            ],
        ];

        foreach ($tickets as $ticket){
            Ticket::factory()->create($ticket);
        }
    }
}
