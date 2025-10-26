<?php

namespace Database\Factories;

use App\Models\Patient;
use App\Models\User;
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
            'allergies' => $this->faker->optional()->text(100),
            'pathologies' => $this->faker->optional()->text(100),
            'medications' => $this->faker->optional()->text(100),
            'past_surgeries' => $this->faker->optional()->text(100),
            'notes_general' => $this->faker->optional()->text(100),
            'patient_id' => fn () => Patient::query()->inRandomOrder()->value('id') ?? Patient::factory(),
            'fisioterapeuta_id' => fn () => User::query()->inRandomOrder()->value('id') ?? User::factory(),
        ];
    }
}
