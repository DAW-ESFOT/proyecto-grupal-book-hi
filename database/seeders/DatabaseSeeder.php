<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;
use Illuminate\Database\Business;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call(BooksTableSeeder::class);
        $this->call(ChatTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(BusinessesTableSeeder::class);
    }
}
