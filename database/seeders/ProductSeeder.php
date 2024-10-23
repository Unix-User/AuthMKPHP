<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Team;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $publicTeam = Team::where('name', 'Public')->first();

        if (!$publicTeam) {
            return;
        }

        $products = [
            [
                'name' => 'Smartphone X',
                'description' => 'Latest model with advanced features',
                'price' => 999.99,
                'image' => 'products/smartphone.jpg',
                'tags' => 'electronics,mobile,smartphone',
            ],
            [
                'name' => 'Laptop Pro',
                'description' => 'High-performance laptop for professionals',
                'price' => 1499.99,
                'image' => 'products/laptop.jpg',
                'tags' => 'electronics,computer,laptop',
            ],
            [
                'name' => 'Wireless Earbuds',
                'description' => 'True wireless earbuds with noise cancellation',
                'price' => 199.99,
                'image' => 'products/earbuds.jpg',
                'tags' => 'electronics,audio,wireless',
            ],
            [
                'name' => 'Smart Watch',
                'description' => 'Fitness tracker and smartwatch in one',
                'price' => 299.99,
                'image' => 'products/smartwatch.jpg',
                'tags' => 'electronics,wearable,fitness',
            ],
            [
                'name' => '4K TV',
                'description' => 'Ultra HD smart TV with HDR',
                'price' => 799.99,
                'image' => 'products/tv.jpg',
                'tags' => 'electronics,television,entertainment',
            ],
        ];

        foreach ($products as $product) {
            Product::create(array_merge($product, ['team_id' => $publicTeam->id]));
        }
    }
}
