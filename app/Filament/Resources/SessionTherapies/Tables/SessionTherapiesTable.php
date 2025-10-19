<?php

namespace App\Filament\Resources\SessionTherapies\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SessionTherapiesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('treatment.name')
                    ->label('Tratamiento')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('appointment.title')
                    ->label('Cita')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('session_date')
                ->label('Fecha')
                    ->date()
                    ->sortable(),
                TextColumn::make('duration_minutes')
                ->label('Duración')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                ->label('Creado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                ->label('Actualizado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
