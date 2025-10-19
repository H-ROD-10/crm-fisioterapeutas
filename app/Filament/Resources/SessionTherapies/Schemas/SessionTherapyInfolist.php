<?php

namespace App\Filament\Resources\SessionTherapies\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SessionTherapyInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('treatment.name')
                    ->label('Tratamiento'),
                TextEntry::make('appointment.title')
                    ->label('Cita'),
                TextEntry::make('session_date')
                    ->label('Fecha')
                    ->date(),
                TextEntry::make('subjective_data')
                    ->label('Sintomas expresados por el paciente')
                    ->columnSpanFull(),
                TextEntry::make('objective_data')
                    ->label('Sintomas observados por el fisioterapeuta')
                    ->columnSpanFull(),
                TextEntry::make('assessment')
                    ->label('Evaluación')
                    ->columnSpanFull(),
                TextEntry::make('treatment_applied')
                    ->label('Tratamiento aplicado')
                    ->columnSpanFull(),
                TextEntry::make('homework_recommendations')
                    ->label('Recomendaciones')
                    ->columnSpanFull(),
                TextEntry::make('duration_minutes')
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
