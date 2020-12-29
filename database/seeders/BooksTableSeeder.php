<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Vaciar la tabla
        Book::truncate();

        $faker = \Faker\Factory::create();
        // Crear chat ficticios en la tabla
        for($i = 0; $i < 50; $i++) {
            Book::create([
                'title'=> $faker->sentence,
                'author'=> $faker->name,
                'editorial'=> $faker->sentence,
                'year_edition' => $faker->dateTime,
                'price' => $faker->randomFloat(2,1,10),
                'pages' => $faker->numberBetween(10,1000),
                'synopsis' => $faker->paragraph,
                'book_status' => $faker->randomLetter,
                'cover_page' => $faker->sentence,
                'back_cover' => $faker->sentence,
                'donation' => $faker->randomLetter,
                'available_status' => $faker->randomLetter,
                ]);
        }
    }
}
