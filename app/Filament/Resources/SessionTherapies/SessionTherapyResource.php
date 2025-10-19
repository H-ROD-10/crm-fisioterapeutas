<?php

namespace App\Filament\Resources\SessionTherapies;

use App\Filament\Resources\SessionTherapies\Pages\CreateSessionTherapy;
use App\Filament\Resources\SessionTherapies\Pages\EditSessionTherapy;
use App\Filament\Resources\SessionTherapies\Pages\ListSessionTherapies;
use App\Filament\Resources\SessionTherapies\Pages\ViewSessionTherapy;
use App\Filament\Resources\SessionTherapies\Schemas\SessionTherapyForm;
use App\Filament\Resources\SessionTherapies\Schemas\SessionTherapyInfolist;
use App\Filament\Resources\SessionTherapies\Tables\SessionTherapiesTable;
use App\Models\SessionTherapy;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SessionTherapyResource extends Resource
{
    protected static ?string $model = SessionTherapy::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::DocumentCurrencyBangladeshi;

    protected static ?string $recordTitleAttribute = 'title';

    
    protected static ?string $pluralModelLabel = 'Terapias';

    protected static ?string $modelLabel = 'Terapia';

    public static function form(Schema $schema): Schema
    {
        return SessionTherapyForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SessionTherapyInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SessionTherapiesTable::configure($table);
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
            'index' => ListSessionTherapies::route('/'),
            'create' => CreateSessionTherapy::route('/create'),
            'view' => ViewSessionTherapy::route('/{record}'),
            'edit' => EditSessionTherapy::route('/{record}/edit'),
        ];
    }
}
