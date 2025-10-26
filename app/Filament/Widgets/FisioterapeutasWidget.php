<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\Widget;

class FisioterapeutasWidget extends Widget
{
    protected static ?int $sort = 5;
    protected string $view = 'filament.widgets.fisioterapeutas-widget';

    protected function getViewData(): array
    {
        return [
            'fisioterapeutas' => User::whereHas('roles', function ($q) {
                    $q->whereIn('name', ['fisioterapeuta', 'super_admin'])
                      ->where('guard_name', 'web');
                })
                ->withCount(['patients', 'appointments', 'treatments'])
                ->get(),
        ];
    }
}
