<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appoinment>
 */
class AppoinmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'start_time' => $this->faker->dateTimeBetween('-1 week', '+1 week'),
            'end_time' => $this->faker->dateTimeBetween('-1 week', '+1 week'),
            'status' => $this->faker->randomElement(['pending', 'completed', 'cancelled']),
            'patient_id' => $this->faker->numberBetween(1, 10),
            'fisioterapeuta_id' => $this->faker->numberBetween(1, 10),
            'notes'=> $this->faker->sentence(),
        ];
    }
}
