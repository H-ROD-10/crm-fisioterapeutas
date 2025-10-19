<?php

namespace App\Filament\Resources\Treatments\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TreatmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre')
                    ->required(),
                Textarea::make('description')
                    ->label('Descripción')
                    ->rows(3)
                    ->required(),
                Select::make('status')
                    ->label('Estado')
                    ->options(['pending' => 'Pending', 'completed' => 'Completed', 'cancelled' => 'Cancelled'])
                    ->default('pending')
                    ->required(),
                DatePicker::make('start_date')
                    ->label('Fecha de inicio')
                    ->required(),
                DatePicker::make('end_date')
                    ->label('Fecha de fin')
                    ->required(),
                Select::make('patient_id')
                    ->label('Paciente')
                    ->relationship('patient', 'name')
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
            ]);
    }
}
