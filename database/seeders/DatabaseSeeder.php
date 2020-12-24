<?php

namespace Database\Seeders;

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
        $this->call(BusinessesTableSeeder::class);
    }
}
