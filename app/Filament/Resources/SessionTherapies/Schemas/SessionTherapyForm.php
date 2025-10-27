<?php

namespace App\Filament\Resources\SessionTherapies\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Actions\Action;
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
                    ->columnSpanFull()
                    ->afterContent([
                        Action::make('record_subjective_data')
                            ->label('')
                            ->icon('heroicon-o-microphone')
                            ->color('green')
                            ->size('sm')
                            ->tooltip('Grabar audio para Sintomas expresados por el paciente')
                            ->extraAttributes([
                                'data-voice-button' => true,
                                'data-voice-field' => 'subjective_data',
                            ])
                            ->action(fn () => null)
                    ]),
                Textarea::make('objective_data')
                    ->label('Sintomas observados por el fisioterapeuta')
                    ->required()
                    ->columnSpanFull()
                    ->afterContent([
                        Action::make('record_objective_data')
                            ->label('')
                            ->icon('heroicon-o-microphone')
                            ->color('green')
                            ->size('sm')
                            ->tooltip('Grabar audio para Sintomas observados por el fisioterapeuta')
                            ->extraAttributes([
                                'data-voice-button' => true,
                                'data-voice-field' => 'objective_data',
                            ])
                            ->action(fn () => null)
                    ]),
                Textarea::make('assessment')
                    ->label('Evaluación')
                    ->required()
                    ->columnSpanFull()
                    ->afterContent([
                        Action::make('record_assessment')
                            ->label('')
                            ->icon('heroicon-o-microphone')
                            ->color('green')
                            ->size('sm')
                            ->tooltip('Grabar audio para Evaluación')
                            ->extraAttributes([
                                'data-voice-button' => true,
                                'data-voice-field' => 'assessment',
                            ])
                            ->action(fn () => null)
                    ]),
                Textarea::make('treatment_applied')
                    ->label('Tratamiento aplicado')
                    ->required()
                    ->columnSpanFull()
                    ->afterContent([
                        Action::make('record_treatment_applied')
                            ->label('')
                            ->icon('heroicon-o-microphone')
                            ->color('green')
                            ->size('sm')
                            ->tooltip('Grabar audio para Tratamiento aplicado')
                            ->extraAttributes([
                                'data-voice-button' => true,
                                'data-voice-field' => 'treatment_applied',
                            ])
                            ->action(fn () => null)
                    ]),
                Textarea::make('homework_recommendations')
                    ->label('Recomendaciones')
                    ->required()
                    ->columnSpanFull()
                    ->afterContent([
                        Action::make('record_homework_recommendations')
                            ->label('')
                            ->icon('heroicon-o-microphone')
                            ->color('green')
                            ->size('sm')
                            ->tooltip('Grabar audio para Recomendaciones')
                            ->extraAttributes([
                                'data-voice-button' => true,
                                'data-voice-field' => 'homework_recommendations',
                            ])
                            ->action(fn () => null)
                    ]),
                TextInput::make('duration_minutes')
                    ->label('Duración')
                    ->required()
                    ->numeric()
                    ->afterContent([
                        Action::make('record_duration_minutes')
                            ->label('')
                            ->icon('heroicon-o-microphone')
                            ->color('green')
                            ->size('sm')
                            ->tooltip('Grabar audio para Duración')
                            ->extraAttributes([
                                'data-voice-button' => true,
                                'data-voice-field' => 'duration_minutes',
                            ])
                            ->action(fn () => null)
                    ]),
            ]);
    }
}
