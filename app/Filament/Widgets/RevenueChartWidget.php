<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\SessionTherapy;
use App\Models\MedicalService;
use Illuminate\Support\Facades\DB;

class RevenueChartWidget extends ChartWidget
{
    protected static ?int $sort = 3;
    protected ?string $heading = 'Ingresos por Servicios';
    
    public ?string $filter = '30days';

    protected function getData(): array
    {
        // Determinar el rango de fechas según el filtro
        $startDate = match($this->filter) {
            'today' => now()->startOfDay(),
            '7days' => now()->subDays(7)->startOfDay(),
            '30days' => now()->subDays(30)->startOfDay(),
            'all' => now()->subYears(10)->startOfDay(), // Últimos 10 años
            default => now()->subDays(30)->startOfDay(),
        };

        // Obtener ingresos por servicio en el período seleccionado
        try {
            $revenues = DB::table('session_service')
                ->join('sessions_therapy', 'session_service.session_therapy_id', '=', 'sessions_therapy.id')
                ->join('medical_services', 'session_service.medical_service_id', '=', 'medical_services.id')
                ->where('sessions_therapy.session_date', '>=', $startDate)
                ->select(
                    'medical_services.name',
                    'medical_services.price',
                    DB::raw('COUNT(session_service.id) as quantity'),
                    DB::raw('(medical_services.price * COUNT(session_service.id)) as total')
                )
                ->groupBy('medical_services.id', 'medical_services.name', 'medical_services.price')
                ->orderByDesc('total')
                ->get();
            
        } catch (\Exception $e) {
            // Si hay error en la consulta, retornar datos vacíos
            \Log::error('Error en RevenueChartWidget: ' . $e->getMessage());
            $revenues = collect();
        }

        // Si no hay datos, mostrar mensaje
        if ($revenues->isEmpty()) {
            return [
                'datasets' => [
                    [
                        'label' => 'Ingresos',
                        'data' => [1],
                        'backgroundColor' => ['#e5e7eb'],
                    ],
                ],
                'labels' => ['No hay servicios asociados a sesiones'],
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
        ];

        return [
            'datasets' => [
                [
                    'label' => 'Ingresos',
                    'data' => $revenues->pluck('total')->toArray(),
                    'backgroundColor' => array_slice($colors, 0, $revenues->count()),
                ],
            ],
            'labels' => $revenues->pluck('name')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getFilters(): ?array
    {
        return [
            'today' => 'Hoy',
            '7days' => 'Últimos 7 días',
            '30days' => 'Últimos 30 días',
            'all' => 'Todos los registros',
        ];
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'bottom',
                ],
                'tooltip' => [
                    'callbacks' => [
                        'label' => 'function(context) { return context.label + ": $" + context.parsed.toLocaleString(); }',
                    ],
                ],
            ],
        ];
    }
}
