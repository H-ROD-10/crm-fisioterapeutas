<?php

namespace App\Filament\Resources\SessionTherapies\Pages;

use App\Filament\Resources\SessionTherapies\SessionTherapyResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSessionTherapies extends ListRecords
{
    protected static string $resource = SessionTherapyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
