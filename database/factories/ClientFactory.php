<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [        
            'name' => fake()->firstName(),
            'last_name' => fake()->lastName().' '.fake()->lastName(),
            'document_number' => fake()->unique()->numberBetween(70000000, 90000000), 
            //'phone_number' => Str::random(9),
            'email' => fake()->unique()->safeEmail(),
            'phone' => '9' . fake()->numberBetween(10000000, 99999999),
            //db:seed
        ];
    }
}
