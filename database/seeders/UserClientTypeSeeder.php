<?php

namespace Database\Seeders;

use App\Models\UserClientType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserClientTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user_client_types = [
            [
                "user_id"=> 1,
                "client_type_id"=>1
            ],
            [
                "user_id"=> 1,
                "client_type_id"=>2
            ],

        ];

        foreach($user_client_types as $user_client_type){
            UserClientType::create($user_client_type);
        }
    }
}
