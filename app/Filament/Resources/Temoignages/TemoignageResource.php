<?php

namespace App\Filament\Resources\Temoignages;

use App\Filament\Resources\Temoignages\Pages\CreateTemoignage;
use App\Filament\Resources\Temoignages\Pages\EditTemoignage;
use App\Filament\Resources\Temoignages\Pages\ListTemoignages;
use App\Filament\Resources\Temoignages\Pages\ViewTemoignage;
use App\Filament\Resources\Temoignages\Schemas\TemoignageForm;
use App\Filament\Resources\Temoignages\Schemas\TemoignageInfolist;
use App\Filament\Resources\Temoignages\Tables\TemoignagesTable;
use App\Models\Temoignage;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class TemoignageResource extends Resource
{
    protected static ?string $model = Temoignage::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChatBubbleLeftRight;

    protected static string|UnitEnum|null $navigationGroup = 'Portfolio';

    public static function form(Schema $schema): Schema
    {
        return TemoignageForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return TemoignageInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TemoignagesTable::configure($table);
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
            'index' => ListTemoignages::route('/'),
            'create' => CreateTemoignage::route('/create'),
            'view' => ViewTemoignage::route('/{record}'),
            'edit' => EditTemoignage::route('/{record}/edit'),
        ];
    }
}
