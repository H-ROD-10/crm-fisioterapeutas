<?php

namespace App\Filament\Resources\SessionTherapies\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class SessionTherapyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('treatment_id')
                    ->relationship('treatment', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('appointment_id')
                    ->relationship(
                        name: 'appointment',
                        titleAttribute: 'start_time',
                        modifyQueryUsing: fn ($query) => $query->with(['patient', 'fisioterapeuta'])
                    )
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->title)
                    ->searchable(['start_time'])
                    ->preload()
                    ->required()
                    ->label('Cita'),
                DatePicker::make('session_date')
                    ->label('Fecha')
                    ->required(),
                Textarea::make('subjective_data')
                    ->label('Sintomas expresados por el paciente')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('objective_data')
                    ->label('Sintomas observados por el fisioterapeuta')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('assessment')
                    ->label('Evaluación')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('treatment_applied')
                    ->label('Tratamiento aplicado')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('homework_recommendations')
                    ->label('Recomendaciones')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('duration_minutes')
                    ->label('Duración')
                    ->required()
                    ->numeric(),
            ]);
    }
}
