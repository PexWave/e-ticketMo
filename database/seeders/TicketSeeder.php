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
                "ticket_number" => "H001"
            ],
            [
                "user_client_type_id" => 2,
                "task_type_id" => 2,
                "ticket_number" => "S001"

            ],
            [
                "user_client_type_id" => 1,
                "task_type_id" => 1,
                "ticket_number" => "H002"
            ],
            [
                "user_client_type_id" => 2,
                "task_type_id" => 2,
                "ticket_number" => "S002"

            ],

            [
                "user_client_type_id" => 1,
                "task_type_id" => 1,
                "ticket_number" => "H003"
            ],
            [
                "user_client_type_id" => 2,
                "task_type_id" => 2,
                "ticket_number" => "S004"

            ],
        ];
        foreach ($tickets as $ticket){
            Ticket::factory()->create($ticket);
        }
    }
}
