<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Patient;
use App\Models\Appoinment;
use App\Models\Treatment;
use App\Models\SessionTherapy;

class CheckFisioterapeutaData extends Command
{
    protected $signature = 'check:fisioterapeuta-data {user_id}';
    protected $description = 'Verificar datos asignados a un fisioterapeuta específico';

    public function handle()
    {
        $userId = $this->argument('user_id');
        $user = User::find($userId);
        
        if (!$user) {
            $this->error("Usuario con ID {$userId} no encontrado");
            return;
        }

        $this->info("=== DATOS DEL FISIOTERAPEUTA ===");
        $this->info("Usuario: {$user->name} (ID: {$user->id})");
        $this->info("Email: {$user->email}");
        $this->info("Roles: " . $user->getRoleNames()->implode(', '));

        $this->info("\n=== CONTEO DE REGISTROS ASIGNADOS ===");

        // Pacientes
        $pacientes = Patient::where('fisioterapeuta_id', $userId)->count();
        $this->line("📋 Pacientes: {$pacientes}");
        
        if ($pacientes > 0) {
            $this->info("   Primeros 5 pacientes:");
            Patient::where('fisioterapeuta_id', $userId)->take(5)->get()->each(function($patient) {
                $this->line("   - {$patient->name} {$patient->last_name} (ID: {$patient->id})");
            });
        }

        // Citas
        $citas = Appoinment::where('fisioterapeuta_id', $userId)->count();
        $this->line("📅 Citas: {$citas}");
        
        if ($citas > 0) {
            $this->info("   Primeras 5 citas:");
            Appoinment::where('fisioterapeuta_id', $userId)->take(5)->get()->each(function($appointment) {
                $this->line("   - {$appointment->start_time} (ID: {$appointment->id})");
            });
        }

        // Tratamientos
        $tratamientos = Treatment::where('fisioterapeuta_id', $userId)->count();
        $this->line("🏥 Tratamientos: {$tratamientos}");
        
        if ($tratamientos > 0) {
            $this->info("   Primeros 5 tratamientos:");
            Treatment::where('fisioterapeuta_id', $userId)->take(5)->get()->each(function($treatment) {
                $this->line("   - {$treatment->name} (ID: {$treatment->id})");
            });
        }

        // Sesiones de terapia (a través de tratamientos)
        $sesiones = SessionTherapy::whereHas('treatment', function($query) use ($userId) {
            $query->where('fisioterapeuta_id', $userId);
        })->count();
        $this->line("💊 Sesiones de Terapia: {$sesiones}");

        $this->info("\n=== TOTALES EN EL SISTEMA ===");
        $this->line("📋 Total Pacientes: " . Patient::count());
        $this->line("📅 Total Citas: " . Appoinment::count());
        $this->line("🏥 Total Tratamientos: " . Treatment::count());
        $this->line("💊 Total Sesiones: " . SessionTherapy::count());

        if ($pacientes == 0 && $citas == 0 && $tratamientos == 0 && $sesiones == 0) {
            $this->warn("\n⚠️  PROBLEMA IDENTIFICADO:");
            $this->warn("Este fisioterapeuta no tiene datos asignados.");
            $this->warn("Necesitas asignar pacientes, citas y tratamientos a este usuario.");
        }
    }
}
