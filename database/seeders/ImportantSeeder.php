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
        $color_bg = [
            'crimson',
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
            Important::create([
                'title' => $data[$key],
                'important_bc' => $color_bg[$key],
                'important_tc' => $color[$key],
            ]);
        }
    }
}
