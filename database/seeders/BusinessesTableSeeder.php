<?php

namespace Database\Seeders;

use App\Models\Business;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class BusinessesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Vaciar la tabla
            Business :: truncate();
                    $faker = \Faker\Factory::create();
//
                    $password = Hash::make('123456');
                    Business::create([
                        'ruc' => ' 1234567890',
                        'name' => 'Administrador',
                        'email' => 'admin@prueba.com',
                        'address'=> 'Calle S35-12 y Calle B125',
                        'password' => $password,]);
      //
                    for ($i = 0; $i < 30; $i++) {
                             Business::create([
                                 'ruc' => $faker->ean8,
                                 'name' => $faker->name,
                                 'email' => $faker->email,
                                 'address' => $faker->address,
                                 'password' => $password,
                                ]);
                            }
}
}
