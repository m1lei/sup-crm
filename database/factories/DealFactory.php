<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\Deal;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Deal>
 */
class DealFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'contact_id' => Contact::factory(),
            'user_id' => User::factory(),
            'title' => fake()->sentence(3),
            'status' => fake()->randomElement(['New','in_progress', 'Done']),
            'amount' => fake()->numberBetween(100, 10000),
            'deadline_at' => fake()->dateTimeBetween(now(), '+1 month'),
        ];
    }
}
