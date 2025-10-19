<?php

namespace App\Filament\Resources\Treatments\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TreatmentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                    ->label('Nombre'),
                TextEntry::make('description')
                    ->label('Descripción'),
                TextEntry::make('status')
                    ->label('Estado')
                    ->badge(),
                TextEntry::make('start_date')
                    ->label('Fecha de inicio')
                    ->date(),
                TextEntry::make('end_date')
                    ->label('Fecha de fin')
                    ->date(),
                TextEntry::make('patient.name')
                    ->label('Paciente'),
                TextEntry::make('fisioterapeuta.name')
                    ->label('Fisioterapeuta'),
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
