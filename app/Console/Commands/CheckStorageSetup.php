<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class CheckStorageSetup extends Command
{
    protected $signature = 'check:storage';
    protected $description = 'Verificar la configuración de almacenamiento';

    public function handle()
    {
        $this->info('=== VERIFICACIÓN DE ALMACENAMIENTO ===');

        // Verificar discos disponibles
        $this->info("\n--- DISCOS CONFIGURADOS ---");
        $disks = config('filesystems.disks');
        foreach ($disks as $name => $config) {
            $root = $config['root'] ?? 'N/A';
            $this->line("✓ {$name}: {$config['driver']} - {$root}");
        }

        // Verificar disco por defecto
        $defaultDisk = config('filesystems.default');
        $this->info("\n--- DISCO POR DEFECTO ---");
        $this->line("Disco por defecto: {$defaultDisk}");

        // Verificar si los directorios existen
        $this->info("\n--- DIRECTORIOS ---");
        
        $privateDir = storage_path('app/private');
        $publicDir = storage_path('app/public');
        $publicLink = public_path('storage');
        
        $this->line("Private storage: " . ($this->directoryExists($privateDir) ? '✓' : '✗') . " {$privateDir}");
        $this->line("Public storage: " . ($this->directoryExists($publicDir) ? '✓' : '✗') . " {$publicDir}");
        $this->line("Public symlink: " . ($this->symlinkExists($publicLink) ? '✓' : '✗') . " {$publicLink}");

        // Verificar permisos de escritura
        $this->info("\n--- PERMISOS ---");
        $this->line("Private writable: " . (is_writable($privateDir) ? '✓' : '✗'));
        $this->line("Public writable: " . (is_writable($publicDir) ? '✓' : '✗'));

        // Probar escritura
        $this->info("\n--- PRUEBA DE ESCRITURA ---");
        try {
            $testFile = 'test-' . time() . '.txt';
            Storage::disk('public')->put($testFile, 'test content');
            $this->line("✓ Escritura en disco público: OK");
            Storage::disk('public')->delete($testFile);
            $this->line("✓ Eliminación de archivo: OK");
        } catch (\Exception $e) {
            $this->error("✗ Error en disco público: " . $e->getMessage());
        }

        // Verificar directorio de pacientes
        $this->info("\n--- DIRECTORIO ESPECÍFICO ---");
        $patientsDir = storage_path('app/public/patients');
        if (!$this->directoryExists($patientsDir)) {
            $this->warn("Directorio 'patients' no existe. Creándolo...");
            if (mkdir($patientsDir, 0755, true)) {
                $this->line("✓ Directorio 'patients' creado exitosamente");
            } else {
                $this->error("✗ No se pudo crear el directorio 'patients'");
            }
        } else {
            $this->line("✓ Directorio 'patients' existe");
        }

        // Recomendaciones
        if (!$this->symlinkExists($publicLink)) {
            $this->warn("\n⚠️  ACCIÓN REQUERIDA:");
            $this->warn("El enlace simbólico público no existe.");
            $this->warn("Ejecuta: php artisan storage:link");
        }
    }

    private function directoryExists($path)
    {
        return is_dir($path);
    }

    private function symlinkExists($path)
    {
        return is_link($path) || is_dir($path);
    }
}
