<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Wallet>
 */
class WalletFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'user_email' => fake()->safeEmail(),
            'userType' => 'agent',
            'amount' => fake()->randomFloat(2, 1000, 50000),
            'bank' => fake()->company(),
            'account_number' => fake()->bankAccountNumber(),
            'account_name' => fake()->name(),
            'status' => 'pending',
        ];
    }
}
