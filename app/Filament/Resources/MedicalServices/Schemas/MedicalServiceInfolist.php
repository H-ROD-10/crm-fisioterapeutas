<?php

namespace App\Filament\Resources\MedicalServices\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class MedicalServiceInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                    ->label('Nombre'),
                TextEntry::make('description')
                    ->label('Descripción'),
                TextEntry::make('price')
                    ->label('Precio')
                    ->money(),
                ImageEntry::make('image')
                    ->label('Imagen'),
                TextEntry::make('duration')
                    ->label('Duración')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->label('Creado')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->label('Actualizado')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
