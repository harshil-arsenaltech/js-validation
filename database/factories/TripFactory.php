<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TripFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "start_trip_time" => $this->faker->date(),
            "end_trip_time" => $this->faker->date(),
            "trip_status_id" => $this->faker->numberBetween(1, 1),
        ];
    }
}
