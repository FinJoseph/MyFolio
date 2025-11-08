<?php

namespace App\Filament\Resources\InformationPersonnelles;

use App\Filament\Resources\InformationPersonnelles\Pages\CreateInformationPersonnelle;
use App\Filament\Resources\InformationPersonnelles\Pages\EditInformationPersonnelle;
use App\Filament\Resources\InformationPersonnelles\Pages\ListInformationPersonnelles;
use App\Filament\Resources\InformationPersonnelles\Pages\ViewInformationPersonnelle;
use App\Filament\Resources\InformationPersonnelles\Schemas\InformationPersonnelleForm;
use App\Filament\Resources\InformationPersonnelles\Schemas\InformationPersonnelleInfolist;
use App\Filament\Resources\InformationPersonnelles\Tables\InformationPersonnellesTable;
use App\Models\InformationPersonnelle;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class InformationPersonnelleResource extends Resource
{
    protected static ?string $model = InformationPersonnelle::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserCircle;

    protected static string|UnitEnum|null $navigationGroup = 'Administration';

    public static function form(Schema $schema): Schema
    {
        return InformationPersonnelleForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return InformationPersonnelleInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return InformationPersonnellesTable::configure($table);
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
            'index' => ListInformationPersonnelles::route('/'),
            'create' => CreateInformationPersonnelle::route('/create'),
            'view' => ViewInformationPersonnelle::route('/{record}'),
            'edit' => EditInformationPersonnelle::route('/{record}/edit'),
        ];
    }
}
