<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MedicalRecord>
 */
class MedicalRecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'allergies' => $this->faker->sentence,
            'pathologies' => $this->faker->sentence,
            'medications' => $this->faker->sentence,
            'past_surgeries' => $this->faker->sentence,
            'notes_general' => $this->faker->sentence,
            'patient_id' => $this->faker->numberBetween(1, 10),
            'fisioterapeuta_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
