<?php

namespace App\Filament\Resources\MedicalServices\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MedicalServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre')
                    ->required(),
                TextInput::make('description')
                    ->label('Descripción')
                    ->required(),
                TextInput::make('price')
                    ->label('Precio')
                    ->numeric()
                    ->prefix('$'),
                FileUpload::make('image')
                    ->label('Imagen')
                    ->directory('medical-service')
                    ->disk('public')
                    ->visibility('public')
                    ->image()
                    ->required(),
                TextInput::make('duration')
                    ->label('Duración')
                    ->required()
                    ->numeric(),
            ]);
    }
}
