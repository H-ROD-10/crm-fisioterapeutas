<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SessionTherapy;
use App\Models\Treatment;
use App\Models\User;

class TestSessionTherapyRelation extends Command
{
    protected $signature = 'test:session-therapy-relation {user_id=2}';
    protected $description = 'Probar la relación SessionTherapy -> Treatment -> Fisioterapeuta';

    public function handle()
    {
        $userId = $this->argument('user_id');
        $user = User::find($userId);
        
        if (!$user) {
            $this->error("Usuario con ID {$userId} no encontrado");
            return;
        }

        $this->info("=== PRUEBA DE RELACIÓN SESSIONTHERAPY -> TREATMENT -> FISIOTERAPEUTA ===");
        $this->info("Usuario: {$user->name} (ID: {$user->id})");

        // 1. Método whereHas (como en el código actual)
        $this->info("\n--- MÉTODO 1: whereHas() ---");
        try {
            $sessionsWhereHas = SessionTherapy::whereHas('treatment', function($query) use ($userId) {
                $query->where('fisioterapeuta_id', $userId);
            })->get();
            
            $this->line("Sesiones encontradas con whereHas: " . $sessionsWhereHas->count());
            
            foreach ($sessionsWhereHas->take(3) as $session) {
                $treatmentName = $session->treatment?->name ?? 'Sin tratamiento';
                $fisioName = $session->treatment?->fisioterapeuta?->name ?? 'Sin fisioterapeuta';
                $this->line("  - Sesión ID {$session->id}: {$treatmentName} - {$fisioName}");
            }
        } catch (\Exception $e) {
            $this->error("Error con whereHas: " . $e->getMessage());
        }

        // 2. Método JOIN directo
        $this->info("\n--- MÉTODO 2: JOIN directo ---");
        try {
            $sessionsJoin = SessionTherapy::join('treatments', 'sessions_therapy.treatment_id', '=', 'treatments.id')
                ->where('treatments.fisioterapeuta_id', $userId)
                ->select('sessions_therapy.*')
                ->get();
            
            $this->line("Sesiones encontradas con JOIN: " . $sessionsJoin->count());
            
            foreach ($sessionsJoin->take(3) as $session) {
                $treatmentName = $session->treatment?->name ?? 'Sin tratamiento';
                $fisioName = $session->treatment?->fisioterapeuta?->name ?? 'Sin fisioterapeuta';
                $this->line("  - Sesión ID {$session->id}: {$treatmentName} - {$fisioName}");
            }
        } catch (\Exception $e) {
            $this->error("Error con JOIN: " . $e->getMessage());
        }

        // 3. Verificar relaciones específicas
        $this->info("\n--- VERIFICACIÓN DE RELACIONES ---");
        $firstSession = SessionTherapy::first();
        if ($firstSession) {
            $this->line("Primera sesión ID: {$firstSession->id}");
            $this->line("Treatment ID: {$firstSession->treatment_id}");
            
            if ($firstSession->treatment) {
                $this->line("Tratamiento: {$firstSession->treatment->name}");
                $this->line("Fisioterapeuta ID del tratamiento: {$firstSession->treatment->fisioterapeuta_id}");
                
                if ($firstSession->treatment->fisioterapeuta) {
                    $this->line("Fisioterapeuta: {$firstSession->treatment->fisioterapeuta->name}");
                } else {
                    $this->warn("No se pudo cargar el fisioterapeuta");
                }
            } else {
                $this->warn("No se pudo cargar el tratamiento");
            }
        }

        // 4. Mostrar SQL generado
        $this->info("\n--- SQL GENERADO ---");
        $query = SessionTherapy::whereHas('treatment', function($query) use ($userId) {
            $query->where('fisioterapeuta_id', $userId);
        });
        
        $this->line("SQL: " . $query->toSql());
        $this->line("Bindings: " . json_encode($query->getBindings()));
    }
}
