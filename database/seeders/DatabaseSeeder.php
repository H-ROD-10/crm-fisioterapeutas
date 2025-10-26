<?php

namespace Database\Seeders;

use App\Models\Appoinment;
use App\Models\MedicalRecord;
use App\Models\MedicalService;
use App\Models\Patient;
use App\Models\SessionTherapy;
use App\Models\Treatment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
   public function run(): void
    {
        // 1) Servicios, usuarios, pacientes
        MedicalService::factory()->count(6)->create();
        User::factory()->count(5)->create();      // fisioterapeutas
        Patient::factory()->count(20)->create();

        // 2) Tratamientos
        Treatment::factory()->count(15)->create();

        // 3) Citas (usa la factory ajustada con medical_service_id)
        Appoinment::factory()->count(30)->create();

        // 4) Sesiones de terapia: asignar treatment y appointment existentes
        $treatments = Treatment::pluck('id');
        $appointments = Appoinment::pluck('id');
        $services = MedicalService::pluck('id');

        SessionTherapy::factory()
            ->count(25)
            ->state(function () use ($treatments, $appointments) {
                return [
                    'treatment_id' => $treatments->random(),
                    'appointment_id' => $appointments->random(),
                ];
            })
            ->create()
            ->each(function (SessionTherapy $session) use ($services) {
                // Adjuntar de 1 a 3 servicios a la sesión en la pivote session_service
                $session->services()->attach(
                    $services->random(rand(1, 3))->all()
                );
            });
    }
}
