<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RelAcabadosCondiciones;

class RelAcabadosCondicionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $relaciones = [
            [
                'condicion_id' => 1,
                'acadado_id' => 1,
            ],
            [
                'condicion_id' => 2,
                'acadado_id' => 2,
            ],
            [
                'condicion_id' => 2,
                'acadado_id' => 3,
            ],
            [
                'condicion_id' => 3,
                'acadado_id' => 4,
            ],
        ];

        foreach ($relaciones as $value) {
            RelAcabadosCondiciones::create($value);
        }
    }
}
