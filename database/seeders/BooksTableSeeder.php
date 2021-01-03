<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Seeder;
use Tymon\JWTAuth\Facades\JWTAuth;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Vaciar la tabla books.
        Book::truncate();
        $faker = \Faker\Factory::create();
        // Obtenemos la lista de todos los usuarios creados e
        // iteramos sobre cada uno y simulamos un inicio de
        // sesión con cada uno para crear libros en su nombre
        $users = User::all();
        foreach ($users as $user) {
            // iniciamos sesión con este usuario
            JWTAuth::attempt(['email' => $user->email, 'password' => '123123']);
            // Y ahora con este usuario creamos algunos libros
            $num_books = 5;
            $book_status = 'new';
            $donation = 'yes';
            $available_status = 'available';
            for ($j = 0; $j < $num_books; $j++) {
                Book::create([
                    'title' => $faker->sentence,
                    'author' => $faker->name,
                    'editorial' => $faker->sentence,
                    'year_edition' => $faker->dateTime,
                    'price' => $faker->randomFloat(2, 1, 10),
                    'pages' => $faker->numberBetween(10, 1000),
                    'synopsis' => $faker->paragraph,
                    'book_status' => $book_status,
                    'cover_page' => $faker->sentence,
                    'back_cover' => $faker->sentence,
                    'donation' => $donation,
                    'available_status' => $available_status,
                ]);
            }
        }

    }
}
