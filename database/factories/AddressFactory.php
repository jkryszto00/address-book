<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => fake()->numberBetween(1,3),
            'number' => fake('pl_PL')->buildingNumber(),
            'street' => fake('pl_PL')->streetName(),
            'city' => fake('pl_PL')->city(),
            'zip' => fake('pl_PL')->postcode()
        ];
    }
}
