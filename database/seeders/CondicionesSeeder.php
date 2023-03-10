<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Condiciones;

class CondicionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $condiciones = [
            [
                'condicion' => 'De linea',
                'm2' => 60,
            ],
            [
                'condicion' => 'Residencial',
                'm2' => 100,
            ],
            [
                'condicion' => 'Campestre',
                'm2' => 350,
            ],
        ];

        foreach ($condiciones as $value) {
            Condiciones::create($value);
        }
    }
}
