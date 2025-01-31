<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use App\Models\UserSubscription;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserSubscription>
 */
class UserSubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'product_id' => Product::factory(),
            // Defina outros atributos padrão aqui, se necessário
            // 'subscription_expiry_date' => $this->faker->dateTimeBetween('now', '+1 year'),
        ];
    }
}
