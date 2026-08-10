<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaymentModel>
 */
class PaymentModelFactory extends Factory
{
    public function definition()
    {
        return [
            'process_id' => (string) fake()->uuid(),
            'process_type' => 'NDL',
            'orderNo' => 'ORD-' . fake()->unique()->numerify('######'),
            'full_name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'amount' => fake()->randomFloat(2, 1000, 50000),
            'status' => 'Successful',
        ];
    }
}
