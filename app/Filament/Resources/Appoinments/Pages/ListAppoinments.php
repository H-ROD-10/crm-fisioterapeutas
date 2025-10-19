<?php

namespace App\Filament\Resources\Appoinments\Pages;

use App\Filament\Resources\Appoinments\AppoinmentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAppoinments extends ListRecords
{
    protected static string $resource = AppoinmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
            ->label('Nueva Cita'),
        ];
    }
}
