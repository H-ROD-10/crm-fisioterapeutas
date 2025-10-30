<?php

namespace App\Filament\Resources\Treatments;

use App\Filament\Resources\Treatments\Pages\CreateTreatment;
use App\Filament\Resources\Treatments\Pages\EditTreatment;
use App\Filament\Resources\Treatments\Pages\ListTreatments;
use App\Filament\Resources\Treatments\Pages\ViewTreatment;
use App\Filament\Resources\Treatments\Schemas\TreatmentForm;
use App\Filament\Resources\Treatments\Schemas\TreatmentInfolist;
use App\Filament\Resources\Treatments\Tables\TreatmentsTable;
use App\Models\Treatment;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Facades\Filament;

class TreatmentResource extends Resource
{
    protected static ?string $model = Treatment::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Square2Stack;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $pluralModelLabel = 'Tratamientos';

    protected static ?string $modelLabel = 'Tratamiento';

    public static function form(Schema $schema): Schema
    {
        return TreatmentForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return TreatmentInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TreatmentsTable::configure($table);
    }

    /**
     * Filtrar registros según el rol del usuario - Tenant Scoping
     */
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();
        $user = Filament::auth()->user();

        // Solo filtrar si el usuario es fisioterapeuta
        if ($user && $user->hasRole('Fisioterapeuta')) {
            $query->where('fisioterapeuta_id', $user->id);
        }
        // Super admin y recepcionista ven todos los tratamientos (sin filtro)

        return $query;
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
            'index' => ListTreatments::route('/'),
            'create' => CreateTreatment::route('/create'),
            'view' => ViewTreatment::route('/{record}'),
            'edit' => EditTreatment::route('/{record}/edit'),
        ];
    }
}
