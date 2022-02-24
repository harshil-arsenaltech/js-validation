<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserLocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'lat' => $this->faker->latitude(),
            'lng' => $this->faker->longitude(),
        ];
    }
}
