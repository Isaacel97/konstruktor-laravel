<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Areas;

class AreasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $areas = [
            [
                'nombre' => 'Recamara',
                'condicion_id' => 1,
                'm2' => 8.50,
            ],
            [
                'nombre' => 'Baño',
                'condicion_id' => 1,
                'm2' => 2.80,
            ],
            [
                'nombre' => 'Cochera',
                'condicion_id' => 1,
                'm2' => 12.50,
            ],
            [
                'nombre' => 'Sala',
                'condicion_id' => 1,
                'm2' => 10.50,
            ],
            [
                'nombre' => 'Comedor',
                'condicion_id' => 1,
                'm2' => 12.00,
            ],
            [
                'nombre' => 'Cocina',
                'condicion_id' => 1,
                'm2' => 7.50,
            ],
            [
                'nombre' => 'Recamara',
                'condicion_id' => 2,
                'm2' => 20.00,
            ],
            [
                'nombre' => 'Baño',
                'condicion_id' => 2,
                'm2' => 9.00,
            ],
            [
                'nombre' => 'Cochera',
                'condicion_id' => 2,
                'm2' => 12.50,
            ],
            [
                'nombre' => 'Sala',
                'condicion_id' => 2,
                'm2' => 20.00,
            ],
            [
                'nombre' => 'Comedor',
                'condicion_id' => 2,
                'm2' => 30.00,
            ],
            [
                'nombre' => 'Cocina',
                'condicion_id' => 2,
                'm2' => 12.00,
            ],
            [
                'nombre' => 'Desayunador',
                'condicion_id' => 2,
                'm2' => 8.00,
            ],
            [
                'nombre' => 'Vestidor',
                'condicion_id' => 2,
                'm2' => 10.00,
            ],
            [
                'nombre' => 'Recamara',
                'condicion_id' => 3,
                'm2' => 48.00,
            ],
            [
                'nombre' => 'Baño',
                'condicion_id' => 3,
                'm2' => 16.00,
            ],
            [
                'nombre' => 'Cochera',
                'condicion_id' => 3,
                'm2' => 22.80,
            ],
            [
                'nombre' => 'Sala',
                'condicion_id' => 3,
                'm2' => 48.00,
            ],
            [
                'nombre' => 'Comedor',
                'condicion_id' => 3,
                'm2' => 56.00,
            ],
            [
                'nombre' => 'Cocina',
                'condicion_id' => 3,
                'm2' => 64.00,
            ],
        ];

        foreach ($areas as $value) {
            Areas::create($value);
        }
    }
}
