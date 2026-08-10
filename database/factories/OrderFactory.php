<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    public function definition()
    {
        return [
            'user_email' => fake()->safeEmail(),
            'userType' => 'user',
            'order_number' => 'ORD-' . fake()->unique()->numerify('######'),
            'product_name' => fake()->word(),
            'total' => fake()->randomFloat(2, 1000, 50000),
            'status' => 'pending',
        ];
    }
}
