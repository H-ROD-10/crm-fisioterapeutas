<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SessionTherapy;
use App\Models\Treatment;
use App\Models\User;
use Illuminate\Support\Facades\Schema;

class CheckSessionTherapyData extends Command
{
    protected $signature = 'check:session-therapy-data';
    protected $description = 'Verificar datos de sesiones de terapia para tenant scoping';

    public function handle()
    {
        $this->info('=== VERIFICACIÓN DE SESIONES DE TERAPIA ===');

        // 1. Verificar estructura de tabla sessions_therapy
        $this->info("\n--- ESTRUCTURA DE TABLA SESSIONS_THERAPY ---");
        $columns = Schema::getColumnListing('sessions_therapy');
        $this->line('Columnas en tabla sessions_therapy:');
        foreach ($columns as $column) {
            $this->line("  - {$column}");
        }

        $hasTreatmentId = in_array('treatment_id', $columns);
        $this->line("\n¿Tiene columna treatment_id? " . ($hasTreatmentId ? '✓ SÍ' : '✗ NO'));

        // 2. Verificar datos de sesiones
        $this->info("\n--- DATOS DE SESIONES DE TERAPIA ---");
        $totalSessions = SessionTherapy::count();
        $this->line("Total de sesiones: {$totalSessions}");

        if ($hasTreatmentId && $totalSessions > 0) {
            $sessionsWithTreatment = SessionTherapy::whereNotNull('treatment_id')->count();
            $sessionsWithoutTreatment = SessionTherapy::whereNull('treatment_id')->count();
            
            $this->line("Sesiones CON treatment_id: {$sessionsWithTreatment}");
            $this->line("Sesiones SIN treatment_id: {$sessionsWithoutTreatment}");

            // 3. Verificar relación con tratamientos
            $this->info("\n--- VERIFICAR RELACIÓN CON TRATAMIENTOS ---");
            $sessionsWithValidTreatment = SessionTherapy::whereHas('treatment')->count();
            $this->line("Sesiones con tratamiento válido: {$sessionsWithValidTreatment}");

            // 4. Verificar distribución por fisioterapeuta a través de tratamientos
            $this->info("\n--- DISTRIBUCIÓN POR FISIOTERAPEUTA (VÍA TRATAMIENTOS) ---");
            $distribution = SessionTherapy::join('treatments', 'sessions_therapy.treatment_id', '=', 'treatments.id')
                ->selectRaw('treatments.fisioterapeuta_id, COUNT(sessions_therapy.id) as count')
                ->whereNotNull('treatments.fisioterapeuta_id')
                ->groupBy('treatments.fisioterapeuta_id')
                ->get();

            foreach ($distribution as $item) {
                $user = User::find($item->fisioterapeuta_id);
                $userName = $user ? $user->name : 'Usuario no encontrado';
                $this->line("Fisioterapeuta ID {$item->fisioterapeuta_id} ({$userName}): {$item->count} sesiones");
            }

            // 5. Mostrar algunas sesiones de ejemplo
            $this->info("\n--- PRIMERAS 5 SESIONES ---");
            $sampleSessions = SessionTherapy::with(['treatment.fisioterapeuta'])->take(5)->get();
            foreach ($sampleSessions as $session) {
                $treatmentName = $session->treatment ? $session->treatment->name : 'Sin tratamiento';
                $fisioName = $session->treatment?->fisioterapeuta ? $session->treatment->fisioterapeuta->name : 'Sin fisioterapeuta';
                $fisioId = $session->treatment?->fisioterapeuta_id ?? 'N/A';
                $this->line("Sesión ID {$session->id}: {$treatmentName} - Fisioterapeuta: {$fisioName} (ID: {$fisioId})");
            }

            // 6. Probar consulta de filtrado
            $this->info("\n--- PRUEBA DE FILTRADO PARA FISIOTERAPEUTA ID 2 ---");
            $testUserId = 2;
            $filteredSessions = SessionTherapy::whereHas('treatment', function($query) use ($testUserId) {
                $query->where('fisioterapeuta_id', $testUserId);
            })->count();
            $this->line("Sesiones para fisioterapeuta ID {$testUserId}: {$filteredSessions}");
        }
    }
}
