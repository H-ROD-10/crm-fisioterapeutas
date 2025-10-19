<?php

namespace App\Filament\Resources\SessionTherapies\Pages;

use App\Filament\Resources\SessionTherapies\SessionTherapyResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSessionTherapy extends ViewRecord
{
    protected static string $resource = SessionTherapyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
