<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Business;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
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

        // Vaciar la tabla businesses.
        Business::truncate();
        $faker = \Faker\Factory::create();
        // Obtenemos la lista de todos los usuarios creados e
        // iteramos sobre cada uno y simulamos un inicio de
        // sesión con cada uno para crear negocios en su nombre
        $users = User::all();
        foreach ($users as $user) {
            // iniciamos sesión con este usuario
            JWTAuth::attempt(['email' => $user->email, 'password' => '123123']);
            // Y ahora con este usuario creamos algunos negocios
            $num_business = 3;
            for ($j = 0; $j < $num_business; $j++) {
                $business = Business::create([
                    'ruc' => $faker->ean8,
                    'name' => $faker->name,
                    'address' => $faker->address
                ]);
                $business->books()->saveMany(
                    $faker->randomElements(
                        array(
                            Book::find(1),
                            Book::find(2),
                            Book::find(3),
                            Book::find(4),
                            Book::find(5),
                        ), $faker->numberBetween(1, 5), false
                    )
                );
            }
        }


    }
}
