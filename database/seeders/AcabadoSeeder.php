<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Acabados;

class AcabadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $acabados = [
            [
                'acabado' => 'Linea',
                'precio' => 7574.04,
            ],
            [
                'acabado' => 'Residencial',
                'precio' => 11252.52,
            ],
            [
                'acabado' => 'Premium',
                'precio' => 16333.92,
            ],
            [
                'acabado' => 'Campestre',
                'precio' => 22776.12,
            ],
        ];

        foreach ($acabados as $value) {
            Acabados::create($value);
        }

        
    }
}
