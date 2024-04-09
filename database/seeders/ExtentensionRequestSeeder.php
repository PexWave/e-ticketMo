<?php

namespace Database\Seeders;

use App\Models\ExtensionRequest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExtentensionRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $extension_requests = [
            [
                "ticket_id"=> 1,
                "extension_time"=> 3600,
                
                "requested_by"=> 1,
                "reason"=>"need more time",
            ],
            [
                "ticket_id"=> 2,
                "extension_time"=> 3600,
                
                "requested_by"=> 2,
                "reason"=>"encountered more error",
            ]
        ];

        foreach ($extension_requests as $extension_request){
            ExtensionRequest::factory()->create($extension_request);
        }
    }
}
