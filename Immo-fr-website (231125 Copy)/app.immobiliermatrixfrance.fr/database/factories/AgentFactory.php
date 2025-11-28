<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Agent>
 */
class AgentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Test Agency',
            'siren' => rand(1000, 9999),
            'address_line_one' => $this->faker->streetAddress,
            'postcode' => $this->faker->postcode,
            'country' => 'France',
            'province' => 'Province',
            'city' => $this->faker->city,
            'telephone' => $this->faker->phoneNumber,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
