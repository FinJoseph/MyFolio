<?php

namespace App\Filament\Resources\Temoignages\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TemoignageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nom_client')
                    ->required(),
                TextInput::make('poste_client')
                    ->default(null),
                TextInput::make('entreprise_client')
                    ->default(null),
                TextInput::make('avatar_client')
                    ->default(null),
                Textarea::make('contenu')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('note')
                    ->required()
                    ->numeric()
                    ->default(5),
                Select::make('projet_id')
                    ->relationship('projet', 'id')
                    ->default(null),
                TextInput::make('ordre')
                    ->required()
                    ->numeric()
                    ->default(0),
                Toggle::make('est_visible')
                    ->required(),
            ]);
    }
}
