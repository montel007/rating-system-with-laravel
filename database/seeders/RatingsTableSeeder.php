<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RatingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::all();
        $users = User::pluck('id');

        foreach ($products  as $product) {
            $user = $users->random();

            $ratingScore = rand(1, 5);

            Rating::create([
                'product_id' => $product->id,
                'user_id' => $user,
                'rating' => $ratingScore,
            ]);
        }

    }
}
