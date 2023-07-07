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
            'yellowgreen;',
            'skyblue;',
            // 'orangered',
            'moccasin;',
            'orangered;',
            'rgb(138, 136, 136);',
        ];
        $color = [
            'black;',
            'black;',
            'black;',
            'white;',
            'white;',
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
