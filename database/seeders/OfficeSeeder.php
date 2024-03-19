<?php

namespace Database\Seeders;

use App\Models\Office;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $offices = [
            [
                'name' => 'Office of the Mayor'
            ],
            [
                'name' => 'Collectors Office'
            ],
            [
                'name' => 'Office of Public Affairs'
            ],
        ];
        foreach ($offices as $officeData) {
            Office::factory()->create($officeData);
        }
    }
}
