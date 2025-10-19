<?php

namespace App\Filament\Resources\SessionTherapies\Pages;

use App\Filament\Resources\SessionTherapies\SessionTherapyResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditSessionTherapy extends EditRecord
{
    protected static string $resource = SessionTherapyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
