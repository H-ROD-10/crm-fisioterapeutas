<?php

namespace App\Filament\Resources\Appoinments\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class AppoinmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                DateTimePicker::make('start_time')
                    ->label('Fecha y hora de inicio')
                    ->required(),
                DateTimePicker::make('end_time')
                    ->label('Fecha y hora de finalización')
                    ->required(),
                Select::make('status')
                    ->label('Estado')
                    ->options(['pending' => 'Pending', 'completed' => 'Completed', 'cancelled' => 'Cancelled'])
                    ->default('pending')
                    ->required(),
                Select::make('patient_id')
                    ->relationship('patient', 'name')
                    ->label('Paciente')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('fisioterapeuta_id')
                    ->label('Fisioterapeuta')
                    ->relationship(
                        name: 'fisioterapeuta',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn ($query) => $query->whereHas('roles', function ($q) {
                            $q->whereRaw('LOWER(name) = ?', ['fisioterapeuta']);
                        })
                    )
                    ->preload()
                    ->searchable(),
                Textarea::make('notes')
                    ->label('Notas')
                    ->columnSpanFull(),
            ]);
    }
}
