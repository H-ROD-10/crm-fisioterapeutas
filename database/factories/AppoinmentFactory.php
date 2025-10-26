<?php

namespace Database\Factories;

use App\Models\MedicalService;
use App\Models\Patient;
use App\Models\User;
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
        $startTime = $this->faker->dateTimeBetween('-1 week', '+1 week');
        $endTime = (clone $startTime)->modify('+' . $this->faker->numberBetween(30, 120) . ' minutes');

        return [
            'start_time' => $startTime,
            'end_time' => $endTime,
            'status' => $this->faker->randomElement(['pending', 'completed', 'cancelled']),
            'patient_id' => fn () => Patient::query()->inRandomOrder()->value('id') ?? Patient::factory(),
            'medical_service_id' => fn () => MedicalService::query()->inRandomOrder()->value('id') ?? MedicalService::factory(),
            'fisioterapeuta_id' => fn () => User::query()->inRandomOrder()->value('id') ?? User::factory(),
            'notes' => $this->faker->optional()->text(100),
        ];
    }
}
