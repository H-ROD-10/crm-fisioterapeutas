<?php

namespace App\Filament\Resources\Appoinments\Pages;

use App\Filament\Resources\Appoinments\AppoinmentResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewAppoinment extends ViewRecord
{
    protected static string $resource = AppoinmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
