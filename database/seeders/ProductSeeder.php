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
                'name' => 'Plano Básico',
                'description' => 'Plano de internet com velocidade de até 10 Mbps.',
                'price' => 29.99,
                'image' => 'products/basic_plan.jpg',
                'tags' => 'internet,plano,basico',
            ],
            [
                'name' => 'Plano Intermediário',
                'description' => 'Plano de internet com velocidade de até 50 Mbps.',
                'price' => 49.99,
                'image' => 'products/intermediate_plan.jpg',
                'tags' => 'internet,plano,intermediario',
            ],
            [
                'name' => 'Plano Premium',
                'description' => 'Plano de internet com velocidade de até 100 Mbps.',
                'price' => 79.99,
                'image' => 'products/premium_plan.jpg',
                'tags' => 'internet,plano,premium',
            ],
            [
                'name' => 'Plano Família',
                'description' => 'Plano de internet com velocidade de até 200 Mbps, ideal para famílias.',
                'price' => 99.99,
                'image' => 'products/family_plan.jpg',
                'tags' => 'internet,plano,familia',
            ],
            [
                'name' => 'Plano Gamer',
                'description' => 'Plano de internet com alta velocidade e baixa latência, ideal para gamers.',
                'price' => 129.99,
                'image' => 'products/gamer_plan.jpg',
                'tags' => 'internet,plano,gamer',
            ],
        ];

        foreach ($products as $product) {
            Product::create(array_merge($product, ['team_id' => $publicTeam->id]));
        }
    }
}
