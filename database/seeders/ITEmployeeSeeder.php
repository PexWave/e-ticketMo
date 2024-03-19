<?php

namespace Database\Seeders;

use App\Models\ITEmployee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ITEmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $it_employees = [
          [
            "user_id" =>  3,
          ] ,
          [
            "user_id" =>  2,
          ]  
        ];
        
        foreach ($it_employees as $it_employee) {
            ITEmployee::factory()->create($it_employee);
        }
    }
}
