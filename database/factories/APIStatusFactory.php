<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\APIStatus>
 */
class APIStatusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => 'Dados inseridos/atualizados com sucesso!',
            'memoryConsumed' => fake()->numberBetween(10000, 40000) .'KB',
            'date' => fake()->dateTime()->format('Y-m-d H:i:s')
        ];
    }
}
