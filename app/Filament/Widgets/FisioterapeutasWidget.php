<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\Widget;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Facades\Filament;

class FisioterapeutasWidget extends Widget
{
    use HasWidgetShield;
    protected static ?int $sort = 5;
    protected string $view = 'filament.widgets.fisioterapeutas-widget';

    protected function getViewData(): array
    {
        $user = Filament::auth()->user();
        
        // Tenant Scoping: Si es fisioterapeuta, solo mostrar su propia información
        if ($user && $user->hasRole('fisioterapeuta')) {
            return [
                'fisioterapeutas' => User::where('id', $user->id)
                    ->withCount(['patients', 'appointments', 'treatments'])
                    ->get(),
                'isOwnData' => true,
            ];
        }
        
        // Para super_admin y recepcionista, mostrar todos los fisioterapeutas
        return [
            'fisioterapeutas' => User::whereHas('roles', function ($q) {
                    $q->whereIn('name', ['fisioterapeuta', 'super_admin'])
                      ->where('guard_name', 'web');
                })
                ->withCount(['patients', 'appointments', 'treatments'])
                ->get(),
            'isOwnData' => false,
        ];
    }
}
