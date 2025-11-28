<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */
class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->create()->id,
            'address_line_one' => $this->faker->streetAddress,
            'address_line_two' => '',
            'postcode' => $this->faker->postcode,
            'city' => $this->faker->city,
            'province' => $this->faker->word,
            'country' => 'France',
            'property_type' => 'Manor House',
            'property_size' => 2623,
            'land_size' => 100,
            'bedrooms' => rand(1, 20),
            'bathrooms' => rand(1, 20),
            'asking_price' => 1000000,
            'status' => 'draft',
            'description' => 'Test Listing',
            'specification' => $this->faker->paragraph(10)

        ];
    }
}
