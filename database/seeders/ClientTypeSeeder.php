<?php

namespace Database\Seeders;

use App\Models\ClientType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $client_type = [
            [
                "name" => "CTO-Collector",
                "importance" => 4,
                "office_id" =>  3

            ],
            [
                "name" => "City-Planning",
                "importance" => 2,
                "office_id" =>  3
            ],
        ];

        foreach ($client_type as $client_typeData) {
            ClientType::factory()->create($client_typeData);
        }

    }
}
