<?php

namespace App\Filament\Resources\Competences\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CompetenceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nom')
                    ->required(),
                TextInput::make('categorie')
                    ->required(),
                TextInput::make('niveau')
                    ->required()
                    ->numeric()
                    ->default(50),
                TextInput::make('icone')
                    ->default(null),
                TextInput::make('couleur')
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
