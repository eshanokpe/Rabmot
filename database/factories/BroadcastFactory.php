<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Broadcast>
 */
class BroadcastFactory extends Factory
{
    public function definition()
    {
        return [
            'admin_id' => Admin::factory(),
            'title' => fake()->sentence(4),
            'body' => '<p>' . fake()->paragraph() . '</p>',
            'target_audience' => 'all_users',
            'channels' => ['in_app'],
            'delivery_status' => 'draft',
        ];
    }
}
