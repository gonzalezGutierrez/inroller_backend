<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Category::class)->times(5)->create();
        factory(\App\Product::class)->times(30)->create();
        // $this->call(UserSeeder::class);
    }
}
