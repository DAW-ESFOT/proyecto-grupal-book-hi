<?php

namespace Database\Seeders;

use App\Models\Chat;
use App\Models\User;
use App\Models\Business;
use Illuminate\Database\Seeder;
use Tymon\JWTAuth\Facades\JWTAuth;

class ChatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Vaciamos la tabla chat
        Chat::truncate();
        $faker = \Faker\Factory::create();
        // Obtenemos todos los negocios de la bdd
        $businesses = Business::all();
        // Obtenemos todos los usuarios
        $users = User::all();
        foreach ($users as $user) {
            // iniciamos sesión con cada uno
            JWTAuth::attempt(['email' => $user->email, 'password' => '123123']);
            // Creamos un chat para cada negocio con este usuario
            foreach ($businesses as $business) {
                Chat::create([
                    'businesses_id' => $business->id,
                ]);
            }
        }
    }
}
