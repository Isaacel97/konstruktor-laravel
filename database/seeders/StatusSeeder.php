<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
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
                'status' => 'Por contactar',
            ],
            [
                'status' => 'Con cita',
            ],
            [
                'status' => 'Finalizado con exito',
            ],
            [
                'status' => 'Finalizado sin exito',
            ]
        ];

        foreach ($relaciones as $value) {
            RelAcabadosCondiciones::create($value);
        }
    }
}
