<?php

namespace App\Filament\Resources\Appoinments;

use App\Filament\Resources\Appoinments\Pages\CreateAppoinment;
use App\Filament\Resources\Appoinments\Pages\EditAppoinment;
use App\Filament\Resources\Appoinments\Pages\ListAppoinments;
use App\Filament\Resources\Appoinments\Pages\ViewAppoinment;
use App\Filament\Resources\Appoinments\Schemas\AppoinmentForm;
use App\Filament\Resources\Appoinments\Schemas\AppoinmentInfolist;
use App\Filament\Resources\Appoinments\Tables\AppoinmentsTable;
use App\Models\Appoinment;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AppoinmentResource extends Resource
{
    protected static ?string $model = Appoinment::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::CalendarDateRange;

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $pluralModelLabel = 'Citas';

    protected static ?string $modelLabel = 'Cita';

    //protected static ?string $navigationLabel = 'Mis Citas';

    public static function form(Schema $schema): Schema
    {
        return AppoinmentForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return AppoinmentInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AppoinmentsTable::configure($table);
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
            'index' => ListAppoinments::route('/'),
            'create' => CreateAppoinment::route('/create'),
            'view' => ViewAppoinment::route('/{record}'),
            'edit' => EditAppoinment::route('/{record}/edit'),
        ];
    }
}
