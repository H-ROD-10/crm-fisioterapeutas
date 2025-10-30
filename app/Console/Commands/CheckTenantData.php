<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Support\Facades\Schema;

class CheckTenantData extends Command
{
    protected $signature = 'check:tenant-data';
    protected $description = 'Verificar datos de tenant scoping';

    public function handle()
    {
        $this->info('=== VERIFICACIÓN DE TENANT SCOPING ===');

        // 1. Verificar estructura de tabla patients
        $this->info("\n--- ESTRUCTURA DE TABLA PATIENTS ---");
        $columns = Schema::getColumnListing('patients');
        $this->line('Columnas en tabla patients:');
        foreach ($columns as $column) {
            $this->line("  - {$column}");
        }

        $hasFisioterapeutaId = in_array('fisioterapeuta_id', $columns);
        $this->line("\n¿Tiene columna fisioterapeuta_id? " . ($hasFisioterapeutaId ? '✓ SÍ' : '✗ NO'));

        // 2. Verificar datos de pacientes
        $this->info("\n--- DATOS DE PACIENTES ---");
        $totalPatients = Patient::count();
        $this->line("Total de pacientes: {$totalPatients}");

        if ($hasFisioterapeutaId) {
            $patientsWithFisioterapeuta = Patient::whereNotNull('fisioterapeuta_id')->count();
            $patientsWithoutFisioterapeuta = Patient::whereNull('fisioterapeuta_id')->count();
            
            $this->line("Pacientes CON fisioterapeuta asignado: {$patientsWithFisioterapeuta}");
            $this->line("Pacientes SIN fisioterapeuta asignado: {$patientsWithoutFisioterapeuta}");

            // Mostrar distribución por fisioterapeuta
            $this->info("\n--- DISTRIBUCIÓN POR FISIOTERAPEUTA ---");
            $distribution = Patient::selectRaw('fisioterapeuta_id, COUNT(*) as count')
                ->whereNotNull('fisioterapeuta_id')
                ->groupBy('fisioterapeuta_id')
                ->get();

            foreach ($distribution as $item) {
                $user = User::find($item->fisioterapeuta_id);
                $userName = $user ? $user->name : 'Usuario no encontrado';
                $this->line("Fisioterapeuta ID {$item->fisioterapeuta_id} ({$userName}): {$item->count} pacientes");
            }
        }

        // 3. Verificar fisioterapeutas
        $this->info("\n--- FISIOTERAPEUTAS EN EL SISTEMA ---");
        $fisioterapeutas = User::whereHas('roles', function($q) {
            $q->where('name', 'fisioterapeuta');
        })->get();

        foreach ($fisioterapeutas as $fisio) {
            $patientCount = $hasFisioterapeutaId ? Patient::where('fisioterapeuta_id', $fisio->id)->count() : 0;
            $this->line("ID {$fisio->id}: {$fisio->name} ({$fisio->email}) - {$patientCount} pacientes");
        }

        // 4. Verificar algunos registros de ejemplo
        if ($hasFisioterapeutaId && $totalPatients > 0) {
            $this->info("\n--- PRIMEROS 5 PACIENTES ---");
            $samplePatients = Patient::take(5)->get();
            foreach ($samplePatients as $patient) {
                $fisioName = $patient->fisioterapeuta ? $patient->fisioterapeuta->name : 'Sin asignar';
                $this->line("ID {$patient->id}: {$patient->name} {$patient->last_name} - Fisioterapeuta: {$fisioName} (ID: {$patient->fisioterapeuta_id})");
            }
        }
    }
}
