<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'          => 'Package',
            'max_boot_time' => $this->faker->numberBetween(1000, 5000),
            'concurrents'   => $this->faker->randomDigit(),
            'price'         => $this->faker->randomFloat(1, 20, 30),
            'duration'      => 5,
            'recurring'     => $this->faker->randomElement(['yearly', 'monthly']),
            'api_access'    => $this->faker->boolean(),
        ];
    }
}
