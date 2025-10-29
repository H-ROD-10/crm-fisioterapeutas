<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;

class WidgetStatsPatiens extends StatsOverviewWidget
{
    use HasWidgetShield;
    protected static ?int $sort = 0;
    protected function getStats(): array
    {
        // Total de pacientes
        $totalPacientes = Patient::count();

        // Pacientes nuevos este mes
        $pacientesNuevosMes = Patient::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // Pacientes nuevos esta semana
        $pacientesNuevosSemana = Patient::whereBetween('created_at', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ])->count();

        // Pacientes con citas pendientes (activos)
        $pacientesActivos = Patient::whereHas('appointments', function ($query) {
            $query->where('status', 'pendiente')
                  ->orWhere('status', 'pending')
                  ->where('start_time', '>=', now());
        })->count();

        // Calcular tendencia del mes anterior
        $pacientesMesAnterior = Patient::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();

        $tendenciaMes = $pacientesMesAnterior > 0 
            ? (($pacientesNuevosMes - $pacientesMesAnterior) / $pacientesMesAnterior) * 100
            : 0;

        return [
            Stat::make('Total de Pacientes', $totalPacientes)
                ->description('Pacientes en el sistema')
                ->descriptionIcon('heroicon-o-users')
                ->color('success')
                ->chart([15, 22, 28, 35, 42, 50, $totalPacientes]),

            Stat::make('Nuevos Este Mes', $pacientesNuevosMes)
                ->description(
                    $tendenciaMes > 0 
                        ? sprintf('%.1f%% más que el mes anterior', abs($tendenciaMes))
                        : ($tendenciaMes < 0 
                            ? sprintf('%.1f%% menos que el mes anterior', abs($tendenciaMes))
                            : 'Igual que el mes anterior')
                )
                ->descriptionIcon($tendenciaMes >= 0 ? 'heroicon-o-arrow-trending-up' : 'heroicon-o-arrow-trending-down')
                ->color($tendenciaMes >= 0 ? 'success' : 'danger')
                ->chart(array_fill(0, 7, $pacientesNuevosMes)),

            Stat::make('Nuevos Esta Semana', $pacientesNuevosSemana)
                ->description('Pacientes nuevos')
                ->descriptionIcon('heroicon-o-calendar')
                ->color('info')
                ->chart([2, 3, 4, 5, 3, 4, $pacientesNuevosSemana]),

            Stat::make('Pacientes Activos', $pacientesActivos)
                ->description('Con citas pendientes')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('warning')
                ->chart([5, 8, 6, 7, 9, 8, $pacientesActivos]),
        ];
    }
}
