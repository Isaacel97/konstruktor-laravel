<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Contacto;

class ConctactoSeeder extends Seeder
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
            Contacto::create([
                'fecha' => $faker->date,
                'nombre' => $faker->name,
                'direccion' => $faker->address,
                'telefono' => $faker->phoneNumber,
                'origen_id' => $faker->numberBetween(1, 2),
                'status' => $faker->numberBetween(1, 2),
            ]);
        }
    }
}
