<?php

namespace Database\Factories;

use App\Models\ProductInventory;
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
            'name' => fake()->word,
            'desc'=>fake()->realText($maxNbChars = 200, $indexSize = 2),
            'price'=>fake()->numberBetween(1, 50),
            "product_inventory_id"=>fake()->numberBetween(1,4),
        ];
    }
}
