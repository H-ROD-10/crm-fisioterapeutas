<?php

namespace App\Console\Commands;

use App\Models\Appoinment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DiagnoseAppointmentConflicts extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'appointments:diagnose-conflicts 
                            {--fisioterapeuta= : ID del fisioterapeuta específico}
                            {--date= : Fecha específica (Y-m-d)}
                            {--fix : Intentar resolver conflictos automáticamente}';

    /**
     * The console command description.
     */
    protected $description = 'Diagnostica y opcionalmente resuelve conflictos de citas';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔍 Iniciando diagnóstico de conflictos de citas...');
        
        $fisioterapeutaId = $this->option('fisioterapeuta');
        $date = $this->option('date');
        $shouldFix = $this->option('fix');

        // Obtener citas para analizar
        $query = Appoinment::with(['fisioterapeuta', 'patient', 'medicalService'])
            ->where('status', '!=', 'cancelled')
            ->orderBy('fisioterapeuta_id')
            ->orderBy('start_time');

        if ($fisioterapeutaId) {
            $query->where('fisioterapeuta_id', $fisioterapeutaId);
        }

        if ($date) {
            $query->whereDate('start_time', $date);
        }

        $appointments = $query->get();
        
        if ($appointments->isEmpty()) {
            $this->info('✅ No se encontraron citas para analizar.');
            return;
        }

        $this->info("📊 Analizando {$appointments->count()} citas...");
        
        $conflicts = [];
        $fisioterapeutaGroups = $appointments->groupBy('fisioterapeuta_id');

        foreach ($fisioterapeutaGroups as $fisioterapeutaId => $fisioterapeutaAppointments) {
            $fisioterapeuta = $fisioterapeutaAppointments->first()->fisioterapeuta;
            $this->line("\n👨‍⚕️ Analizando: {$fisioterapeuta->name} (ID: {$fisioterapeutaId})");

            $sortedAppointments = $fisioterapeutaAppointments->sortBy('start_time');
            
            for ($i = 0; $i < $sortedAppointments->count() - 1; $i++) {
                $current = $sortedAppointments->values()[$i];
                $next = $sortedAppointments->values()[$i + 1];

                // Verificar solapamiento
                if ($current->end_time > $next->start_time) {
                    $conflict = [
                        'fisioterapeuta' => $fisioterapeuta->name,
                        'fisioterapeuta_id' => $fisioterapeutaId,
                        'appointment1' => $current,
                        'appointment2' => $next,
                        'overlap_minutes' => $current->end_time->diffInMinutes($next->start_time, false)
                    ];
                    
                    $conflicts[] = $conflict;
                    
                    $this->error("  ❌ CONFLICTO DETECTADO:");
                    $this->line("     Cita 1: #{$current->id} - {$current->start_time->format('d/m/Y H:i')} a {$current->end_time->format('H:i')}");
                    $this->line("            Paciente: {$current->patient->name}");
                    $this->line("            Servicio: {$current->medicalService->name}");
                    $this->line("     Cita 2: #{$next->id} - {$next->start_time->format('d/m/Y H:i')} a {$next->end_time->format('H:i')}");
                    $this->line("            Paciente: {$next->patient->name}");
                    $this->line("            Servicio: {$next->medicalService->name}");
                    $this->line("     Solapamiento: {$conflict['overlap_minutes']} minutos");
                }
            }

            if ($sortedAppointments->count() > 0) {
                $this->info("  ✅ {$sortedAppointments->count()} citas analizadas");
            }
        }

        // Mostrar resumen
        $this->line("\n" . str_repeat('=', 60));
        
        if (empty($conflicts)) {
            $this->info('🎉 ¡Excelente! No se encontraron conflictos de horarios.');
        } else {
            $this->error("⚠️  Se encontraron " . count($conflicts) . " conflictos de horarios.");
            
            if ($shouldFix) {
                $this->line("\n🔧 Intentando resolver conflictos...");
                $this->resolveConflicts($conflicts);
            } else {
                $this->line("\n💡 Usa la opción --fix para intentar resolver automáticamente.");
                $this->line("   Ejemplo: php artisan appointments:diagnose-conflicts --fix");
            }
        }

        // Estadísticas adicionales
        $this->showStatistics($appointments);
    }

    /**
     * Intentar resolver conflictos automáticamente
     */
    protected function resolveConflicts(array $conflicts)
    {
        $resolved = 0;
        $failed = 0;

        foreach ($conflicts as $conflict) {
            $appointment1 = $conflict['appointment1'];
            $appointment2 = $conflict['appointment2'];
            
            $this->line("\n🔧 Resolviendo conflicto entre citas #{$appointment1->id} y #{$appointment2->id}...");
            
            // Estrategia: Mover la segunda cita al siguiente slot disponible
            $fisioterapeuta = User::find($conflict['fisioterapeuta_id']);
            $newStartTime = $appointment1->end_time;
            $serviceDuration = $appointment2->medicalService->duration ?? 60;
            
            // Buscar el próximo slot disponible
            $nextAvailable = $fisioterapeuta->getNextAvailableSlot($newStartTime, $serviceDuration);
            
            if ($nextAvailable) {
                $appointment2->update([
                    'start_time' => $nextAvailable,
                    'end_time' => $nextAvailable->copy()->addMinutes($serviceDuration)
                ]);
                
                $this->info("  ✅ Cita #{$appointment2->id} movida a {$nextAvailable->format('d/m/Y H:i')}");
                $resolved++;
            } else {
                $this->error("  ❌ No se pudo encontrar un slot disponible para la cita #{$appointment2->id}");
                $failed++;
            }
        }

        $this->line("\n" . str_repeat('-', 40));
        $this->info("✅ Conflictos resueltos: {$resolved}");
        if ($failed > 0) {
            $this->error("❌ Conflictos no resueltos: {$failed}");
        }
    }

    /**
     * Mostrar estadísticas adicionales
     */
    protected function showStatistics($appointments)
    {
        $this->line("\n📈 ESTADÍSTICAS:");
        
        $totalAppointments = $appointments->count();
        $fisioterapeutas = $appointments->groupBy('fisioterapeuta_id')->count();
        $today = Carbon::today();
        
        $todayAppointments = $appointments->filter(function($apt) use ($today) {
            return $apt->start_time->isSameDay($today);
        })->count();
        
        $futureAppointments = $appointments->filter(function($apt) use ($today) {
            return $apt->start_time->isAfter($today);
        })->count();

        $this->table([
            'Métrica', 'Valor'
        ], [
            ['Total de citas', $totalAppointments],
            ['Fisioterapeutas involucrados', $fisioterapeutas],
            ['Citas hoy', $todayAppointments],
            ['Citas futuras', $futureAppointments],
        ]);

        // Carga por fisioterapeuta
        $this->line("\n👥 CARGA POR FISIOTERAPEUTA:");
        $fisioterapeutaStats = $appointments->groupBy('fisioterapeuta_id')->map(function($group) {
            $fisioterapeuta = $group->first()->fisioterapeuta;
            return [
                'name' => $fisioterapeuta->name,
                'appointments' => $group->count(),
                'hours' => round($group->sum(function($apt) {
                    return $apt->start_time->diffInMinutes($apt->end_time) / 60;
                }), 1)
            ];
        })->sortByDesc('appointments');

        $this->table([
            'Fisioterapeuta', 'Citas', 'Horas totales'
        ], $fisioterapeutaStats->map(function($stat) {
            return [$stat['name'], $stat['appointments'], $stat['hours'] . 'h'];
        })->toArray());
    }
}
