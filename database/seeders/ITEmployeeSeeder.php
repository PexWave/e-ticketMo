<?php

namespace Database\Seeders;

use App\Models\ITEmployee;
use App\Models\ITEmployeesCategories;
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
            "user_id" =>  1,
            "skill_level" => 5,
            "category_id" => [1, 2]  // Example specific category IDs
          ] ,
          [
            "user_id" =>  2,
            "skill_level" => 3,
            "category_id" => [1]  // Example specific category IDs
          ],
          [
            "user_id" =>  3,
            "skill_level" => 4,
            "category_id" => [1, 2]  // Example specific category IDs
          ] ,
        ];
        
        foreach ($it_employees as $it_employee) {
          $employee = ITEmployee::factory()->create([
            'user_id' => $it_employee['user_id'],
            'skill_level' => $it_employee['skill_level']
          ]);

            if (isset($it_employee['category_id'])) {
              foreach ($it_employee['category_id'] as $categoryId) {
                  ITEmployeesCategories::factory()->create([
                      'it_employee_id' => $employee->id,
                      'category_id' => $categoryId,
                  ]);
              }
          }
        }
    }
}
