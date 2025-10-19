<?php

namespace App\Filament\Resources\MedicalServices;

use App\Filament\Resources\MedicalServices\Pages\CreateMedicalService;
use App\Filament\Resources\MedicalServices\Pages\EditMedicalService;
use App\Filament\Resources\MedicalServices\Pages\ListMedicalServices;
use App\Filament\Resources\MedicalServices\Pages\ViewMedicalService;
use App\Filament\Resources\MedicalServices\Schemas\MedicalServiceForm;
use App\Filament\Resources\MedicalServices\Schemas\MedicalServiceInfolist;
use App\Filament\Resources\MedicalServices\Tables\MedicalServicesTable;
use App\Models\MedicalService;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MedicalServiceResource extends Resource
{
    protected static ?string $model = MedicalService::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Newspaper;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $pluralModelLabel = 'Servicios Médicos';

    protected static ?string $modelLabel = 'Servicio Médico';

    public static function form(Schema $schema): Schema
    {
        return MedicalServiceForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return MedicalServiceInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MedicalServicesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMedicalServices::route('/'),
            'create' => CreateMedicalService::route('/create'),
            'view' => ViewMedicalService::route('/{record}'),
            'edit' => EditMedicalService::route('/{record}/edit'),
        ];
    }
}
