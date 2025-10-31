<?php

namespace App\Filament\Resources\Patients\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

class PatientForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre')
                    ->required(),
                TextInput::make('last_name')
                    ->label('Apellido')
                    ->required(),
                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required(),
                TextInput::make('phone')
                    ->label('Teléfono')
                    ->tel(),
                TextInput::make('emergency_contact')
                    ->label('Contacto de emergencia'),
                TextInput::make('address')
                    ->label('Dirección'),
                DatePicker::make('birth_date')
                    ->label('Fecha de nacimiento'),
                TextInput::make('gender')
                    ->label('Género'),
                TextInput::make('dni')
                    ->label('DNI')
                    ->required(),
                FileUpload::make('photo')
                    ->label('Foto de perfil')
                    ->image()
                    ->disk('public')
                    ->directory('patients')
                    ->visibility('public')
                    ->avatar()
                    ->nullable(),
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
