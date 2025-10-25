<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;

class WidgetDoughnutGenerePatients extends ChartWidget
{
    protected static ?int $sort = 2;
    protected ?string $heading = 'Distribución de Pacientes por Género';

    protected function getData(): array
    {
        // Obtener la distribución de pacientes por género
        $genderDistribution = Patient::select('gender', DB::raw('count(*) as total'))
            ->whereNotNull('gender')
            ->groupBy('gender')
            ->orderByDesc('total')
            ->get();

        // Si no hay datos, mostrar mensaje
        if ($genderDistribution->isEmpty()) {
            return [
                'datasets' => [
                    [
                        'label' => 'Pacientes',
                        'data' => [0],
                        'backgroundColor' => ['#e5e7eb'],
                    ],
                ],
                'labels' => ['Sin datos'],
            ];
        }

        // Mapear los valores de género a etiquetas legibles
        $labels = $genderDistribution->map(function ($item) {
            return match(strtolower($item->gender)) {
                'male', 'masculino', 'm' => 'Masculino',
                'female', 'femenino', 'f' => 'Femenino',
                'other', 'otro', 'o' => 'Otro',
                default => ucfirst($item->gender),
            };
        })->toArray();

        // Colores específicos para géneros
        $colors = $genderDistribution->map(function ($item) {
            return match(strtolower($item->gender)) {
                'male', 'masculino', 'm' => '#3b82f6', // blue
                'female', 'femenino', 'f' => '#ec4899', // pink
                'other', 'otro', 'o' => '#8b5cf6', // purple
                default => '#6b7280', // gray
            };
        })->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Pacientes',
                    'data' => $genderDistribution->pluck('total')->toArray(),
                    'backgroundColor' => $colors,
                    'borderWidth' => 2,
                    'borderColor' => '#ffffff',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
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
                        'label' => 'function(context) { 
                            var total = context.dataset.data.reduce((a, b) => a + b, 0);
                            var percentage = ((context.parsed / total) * 100).toFixed(1);
                            return context.label + ": " + context.parsed + " (" + percentage + "%)"; 
                        }',
                    ],
                ],
            ],
            'cutout' => '60%',
        ];
    }
}
