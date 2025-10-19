<?php

namespace App\Filament\Resources\Appoinments\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class AppoinmentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('start_time')
                    ->label('Fecha y hora de inicio')
                    ->dateTime(),
                TextEntry::make('end_time')
                    ->label('Fecha y hora de finalización')
                    ->dateTime(),
                TextEntry::make('status')
                    ->label('Estado')
                    ->badge(),
                TextEntry::make('patient_id')
                    ->label('Paciente')
                    ->numeric(),
                TextEntry::make('fisioterapeuta_id')
                    ->label('Fisioterapeuta')
                    ->numeric(),
                TextEntry::make('notes')
                    ->label('Notas')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->label('Fecha de creación')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->label('Fecha de actualización')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
