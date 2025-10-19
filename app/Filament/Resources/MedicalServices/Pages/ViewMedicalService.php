<?php

namespace App\Filament\Resources\MedicalServices\Pages;

use App\Filament\Resources\MedicalServices\MedicalServiceResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewMedicalService extends ViewRecord
{
    protected static string $resource = MedicalServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
