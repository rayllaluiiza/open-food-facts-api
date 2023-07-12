<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => fake()->numerify(),
            'status' => 'published',
            'imported_t' => fake()->dateTime()->format('Y-m-d H:i:s'),
            'url' => fake()->url(),
            'creator' => fake()->word(),
            'created_t' => fake()->randomNumber(5, true),
            'last_modified_t' => fake()->randomNumber(5, true),
            'product_name' => fake()->word(),
            'quantity' => fake()->bothify(),
            'brands' => fake()->sentence(2),
            'categories' => fake()->sentence(10),
            'labels' => fake()->sentence(5),
            'cities' => fake()->city(),
            'purchase_places' => fake()->sentence(2),
            'stores' => fake()->sentence(2),
            'ingredients_text' => fake()->text(),
            'traces' => fake()->sentence(6),
            'serving_size' => fake()->word(),
            'serving_quantity' => fake()->randomDigit(),
            'nutriscore_score' => fake()->randomDigit(),
            'nutriscore_grade' => fake()->randomLetter(),
            'main_category' => fake()->word(),
            'image_url' => fake()->imageUrl(),
        ];
    }
}
