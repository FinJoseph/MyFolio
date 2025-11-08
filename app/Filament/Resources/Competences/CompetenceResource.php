<?php

namespace App\Filament\Resources\Competences;

use App\Filament\Resources\Competences\Pages\CreateCompetence;
use App\Filament\Resources\Competences\Pages\EditCompetence;
use App\Filament\Resources\Competences\Pages\ListCompetences;
use App\Filament\Resources\Competences\Pages\ViewCompetence;
use App\Filament\Resources\Competences\Schemas\CompetenceForm;
use App\Filament\Resources\Competences\Schemas\CompetenceInfolist;
use App\Filament\Resources\Competences\Tables\CompetencesTable;
use App\Models\Competence;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class CompetenceResource extends Resource
{
    protected static ?string $model = Competence::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChartBar;

    protected static string|UnitEnum|null $navigationGroup = 'Portfolio';

    public static function form(Schema $schema): Schema
    {
        return CompetenceForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CompetenceInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CompetencesTable::configure($table);
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
            'index' => ListCompetences::route('/'),
            'create' => CreateCompetence::route('/create'),
            'view' => ViewCompetence::route('/{record}'),
            'edit' => EditCompetence::route('/{record}/edit'),
        ];
    }
}
