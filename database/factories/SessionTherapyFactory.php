<?php

namespace Database\Factories;

use App\Models\Appoinment;
use App\Models\Treatment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SessionTherapy>
 */
class SessionTherapyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'treatment_id' => Treatment::factory(),
            'appointment_id' => Appoinment::factory(),
            'session_date' => $this->faker->dateTimeBetween('-1 month', 'now')->format('Y-m-d'),
            'subjective_data' => $this->faker->text(100),
            'objective_data' => $this->faker->text(100),
            'assessment' => $this->faker->text(100),
            'treatment_applied' => $this->faker->text(100),
            'homework_recommendations' => $this->faker->text(100),
            'duration_minutes' => $this->faker->numberBetween(30, 120),
        ];
    }
}
