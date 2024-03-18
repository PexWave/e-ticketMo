<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            OfficeSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            ClientTypeSeeder::class,
            RoleSeeder::class,
            TaskTypeSeeder::class,
            TicketSeeder::class,
            ITEmployeeSeeder::class
        ]);
    }
}
