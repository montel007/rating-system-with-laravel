<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\RatingsTableSeeder;
use Database\Seeders\UsersTableSeeder;
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

            // $this->call(VendorsTableSeeder::class);
            // $this->call(ProductsTableSeeder::class);
            $this->call(UsersTableSeeder::class);
            $this->call(RatingsTableSeeder::class);

    }
}
