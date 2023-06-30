<?php

namespace Database\Seeders;

use App\Models\Important;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImportantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Very high',
            'High',
            'Medium',
            'Low',
            'Very low',
        ];

        foreach ($data as $status) {
            Important::create(['title' => $status]);
        }
    }
}
