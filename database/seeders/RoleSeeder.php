<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Super Admin'
            ],
            [
                'name' => 'Admin'
            ],
            [
                'name' => 'Supervisor'
            ],
            [
                'name' => 'IT Staff'
            ],
        ];

        foreach ($roles as $role) {
            Role::factory()->create($role);
        }

    }
}
