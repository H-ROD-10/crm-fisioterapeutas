<?php

namespace App\Filament\Resources\Appoinments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AppoinmentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('start_time')
                    ->label('Fecha y hora de inicio')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('end_time')
                    ->label('Fecha y hora de finalización')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Estado')
                    ->badge(),
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
            ->recordActions([
                ViewAction::make()
                ->label('Ver'),
                EditAction::make()
                ->label('Editar'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ])
                ->label('Acciones'),
            ]);
    }
}
