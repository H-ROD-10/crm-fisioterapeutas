<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\User;
use App\Models\SessionTherapy;
use Illuminate\Support\Facades\DB;

class TherapistPatientsChartWidget extends ChartWidget
{
     protected static ?int $sort = 4;
    protected ?string $heading = 'Pacientes Atendidos por Fisioterapeutas';
    
    public ?string $filter = 'all';

    protected function getData(): array
    {
        // Determinar el rango de fechas según el filtro
        $query = DB::table('sessions_therapy')
            ->join('treatments', 'sessions_therapy.treatment_id', '=', 'treatments.id')
            ->join('users', 'treatments.fisioterapeuta_id', '=', 'users.id')
            ->select(
                'users.name',
                DB::raw('COUNT(DISTINCT treatments.patient_id) as total_patients')
            )
            ->groupBy('users.id', 'users.name');

        // Aplicar filtro de fecha si no es "todos"
        if ($this->filter !== 'all') {
            $startDate = match($this->filter) {
                'today' => now()->startOfDay(),
                '7days' => now()->subDays(7)->startOfDay(),
                '30days' => now()->subDays(30)->startOfDay(),
                default => null,
            };

            if ($startDate) {
                $query->where('sessions_therapy.session_date', '>=', $startDate);
            }
        }

        $therapists = $query->orderByDesc('total_patients')
            ->limit(10) // Limitar a los top 10 fisioterapeutas
            ->get();

        // Si no hay datos, mostrar mensaje
        if ($therapists->isEmpty()) {
            return [
                'datasets' => [
                    [
                        'label' => 'Pacientes Atendidos',
                        'data' => [0],
                        'backgroundColor' => ['#e5e7eb'],
                    ],
                ],
                'labels' => ['Sin datos'],
            ];
        }

        // Colores para el gráfico
        $colors = [
            '#10b981', // green
            '#3b82f6', // blue
            '#f59e0b', // amber
            '#ef4444', // red
            '#8b5cf6', // purple
            '#ec4899', // pink
            '#14b8a6', // teal
            '#f97316', // orange
            '#06b6d4', // cyan
            '#84cc16', // lime
        ];

        return [
            'datasets' => [
                [
                    'label' => 'Pacientes Atendidos',
                    'data' => $therapists->pluck('total_patients')->toArray(),
                    'backgroundColor' => array_slice($colors, 0, $therapists->count()),
                ],
            ],
            'labels' => $therapists->pluck('name')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }

    protected function getFilters(): ?array
    {
        return [
            'all' => 'Todo el tiempo',
            'today' => 'Hoy',
            '7days' => 'Últimos 7 días',
            '30days' => 'Últimos 30 días',
        ];
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'right',
                ],
                'tooltip' => [
                    'callbacks' => [
                        'label' => 'function(context) { return context.label + ": " + context.parsed + " pacientes"; }',
                    ],
                ],
            ],
        ];
    }
}
