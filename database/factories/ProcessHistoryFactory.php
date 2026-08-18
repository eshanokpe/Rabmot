<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProcessHistory>
 */
class ProcessHistoryFactory extends Factory
{
    public function definition()
    {
        return [
            'user_email' => fake()->safeEmail(),
            'userType' => 'user',
            'process_number' => 'PN-' . fake()->unique()->numerify('######'),
            'process_id' => (string) fake()->uuid(),
            'process_type' => 'NDL',
            'totalamount' => fake()->randomFloat(2, 1000, 50000),
            'status' => 0,
        ];
    }
}
