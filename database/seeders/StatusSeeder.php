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
            'In progres',
            'Wait answer',
            'Suspended',
            'Close',
        ];
        $color_bg = [
            'skyblue',
            'orangered',
            'green',
            'moccasin',
            'whitesmoke',
        ];
        $color = [
            'white',
            'white',
            'whitesmoke',
            'black',
            'black',
        ];

        foreach ($data as $key => $_) {
            Status::create([
                'title' => $data[$key],
                'status_bc' => $color_bg[$key],
                'status_tc' => $color[$key],
            ]);
        }
    }
}
