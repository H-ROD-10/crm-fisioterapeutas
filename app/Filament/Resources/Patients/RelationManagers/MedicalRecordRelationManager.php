<?php

namespace App\Filament\Resources\Patients\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MedicalRecordRelationManager extends RelationManager
{
    protected static string $relationship = 'medicalRecord';

    protected static ?string $title = 'Historial Médico';

    protected static ?string $modelLabel = 'Historial Médico';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('allergies')
                    ->label('Alergias')
                    ->columnSpanFull(),
                Textarea::make('pathologies')
                    ->label('Enfermedades')
                    ->columnSpanFull(),
                Textarea::make('medications')
                    ->label('Medicamentos')
                    ->columnSpanFull(),
                Textarea::make('past_surgeries')
                    ->label(' Cirugías anteriores')
                    ->columnSpanFull(),
                Textarea::make('notes_general')
                    ->label('Notas Generales')
                    ->columnSpanFull(),
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

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                TextColumn::make('patient.name')
                    ->label('Paciente')
                    ->sortable(),
                TextColumn::make('fisioterapeuta.name')
                    ->label('Fisioterapeuta')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Fecha de creación')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Fecha de actualización')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
