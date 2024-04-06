<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'sender' => User::factory()->create(),
            'receiver' => User::factory()->create(),
            'wallet_id' => Wallet::factory()->create(),
            'amount' => fake()->randomFloat(2, 1, 100),
            'type' => fake()->randomElement(['deposit', 'withdrawal', 'transfer']),
            'fees' => fake()->randomFloat(2, 0, 10) // Example fees between 0 and 10 with 2 decimal places
        ];

    }
}
