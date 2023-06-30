<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Open',
            'Close',
            'In progres',
            'Wait answer',
        ];

        foreach ($data as $status) {
            Status::create(['title' => $status]);
        }
    }
}
