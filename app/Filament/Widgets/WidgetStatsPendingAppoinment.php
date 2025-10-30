<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Appoinment;
use Illuminate\Support\Facades\DB;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Facades\Filament;

class WidgetStatsPendingAppoinment extends StatsOverviewWidget
{
    use HasWidgetShield;
     protected static ?int $sort = 1;
    protected function getStats(): array
    {
        $user = Filament::auth()->user();
        
        // Aplicar filtro por fisioterapeuta si es necesario
        $query = Appoinment::query();
        if ($user && $user->hasRole('fisioterapeuta')) {
            $query->where('fisioterapeuta_id', $user->id);
        }
        
        // Total de citas pendientes
        $totalPendientes = $query->where(function ($subQuery) {
            $subQuery->where('status', 'pendiente')
                  ->orWhere('status', 'pending');
        })->count();

        // Citas pendientes para hoy
        $pendientesHoyQuery = clone $query;
        $pendientesHoy = $pendientesHoyQuery->where(function ($subQuery) {
            $subQuery->where('status', 'pendiente')
                  ->orWhere('status', 'pending');
        })
        ->whereDate('start_time', today())
        ->count();

        // Citas pendientes esta semana
        $pendientesSemanaQuery = clone $query;
        $pendientesSemana = $pendientesSemanaQuery->where(function ($subQuery) {
            $subQuery->where('status', 'pendiente')
                  ->orWhere('status', 'pending');
        })
        ->whereBetween('start_time', [now()->startOfWeek(), now()->endOfWeek()])
        ->count();

        return [
            Stat::make('Citas Pendientes', $totalPendientes)
                ->description('Total de citas pendientes')
                ->descriptionIcon('heroicon-o-clock')
                ->color('warning')
                ->chart([7, 12, 15, 18, 22, 25, $totalPendientes]),

            Stat::make('Pendientes Hoy', $pendientesHoy)
                ->description('Citas pendientes para hoy')
                ->descriptionIcon('heroicon-o-calendar')
                ->color($pendientesHoy > 0 ? 'danger' : 'success')
                ->chart([3, 5, 4, 6, 7, 5, $pendientesHoy]),

            Stat::make('Pendientes Esta Semana', $pendientesSemana)
                ->description('Citas pendientes esta semana')
                ->descriptionIcon('heroicon-o-calendar-days')
                ->color('info')
                ->chart([10, 15, 12, 18, 20, 22, $pendientesSemana]),
        ];
    }
}
