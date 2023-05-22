<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DeliveryDetails>
 */
class DeliveryDetailsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'day_name' => fake()->randomElement(['MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT', 'SUN']),
            'time_start' => time(),
            'time_end'=> time(),
            'address' => fake()->address(),
        ];
    }
}
