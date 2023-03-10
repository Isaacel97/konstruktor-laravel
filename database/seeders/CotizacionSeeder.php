<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cotizacion;

class CotizacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 20; $i++) {
            Cotizacion::create([
                'fecha_cotizacion'=> $faker->date(),
                'm2' => $faker->numberBetween(85, 800),
                'condiciones' => $faker->sentence,
                'acabados' => $faker->sentence,
                'recamaras' => $faker->numberBetween(2, 6),
                'baños' => $faker->numberBetween(1, 6),
                'cocheras' => $faker->numberBetween(1, 4),
                'cuartos_servicio' => $faker->numberBetween(0, 2),
                'cuarto_lavado'     => $faker->numberBetween(0, 2),
                'estudio'           => $faker->numberBetween(0, 2),
                'sala_tv'          => $faker->numberBetween(0, 2),
                'vestidor'        => $faker->numberBetween(0, 2),
                'portico'        => $faker->numberBetween(0, 1),
                'otro'            => $faker->sentence,
                'total'          => $faker->randomFloat(2, 1000, 10000),
            ]);
        }
    }
}
