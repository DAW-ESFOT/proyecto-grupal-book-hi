<?php

namespace Database\Seeders;

use App\Models\Chat;
use Illuminate\Database\Seeder;

class ChatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Vaciar la tabla.
        Chat::truncate();
        $faker = \Faker\Factory::create();
        // Crear chat ficticios en la tabla
        for ($i = 0; $i < 50; $i++) {
            Chat::create([
                'message' => $faker->sentence
            ]);
        }
    }
}
