<?php

namespace Database\Seeders;

use App\Models\TaskType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $task_types = [
            [
                "task" => "Monitor repair",
                "category_id" => 2,
                "difficulty" => 4,
                "urgency" => 2,
                "response_time" => 3600,
                "resolve_time" => 1800
            ],
            [
                "task" => "OS Installation",
                "category_id" => 1,
                "difficulty" => 2,
                "urgency" => 3,
                "response_time" => 3600,
                "resolve_time" => 2400
            ],
            [
                "task" => "Server Maintenance",
                "category_id" => 1,
                "difficulty" => 5,
                "urgency" => 5,
                "response_time" => 3600,
                "resolve_time" => 3600
            ],
        ];

        foreach ($task_types as $task_type) {
            TaskType::factory()->create($task_type);
        }
    }
}
