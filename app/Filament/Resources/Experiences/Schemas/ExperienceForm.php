<?php

namespace App\Filament\Resources\Experiences\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ExperienceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('poste')
                    ->required(),
                TextInput::make('entreprise')
                    ->required(),
                TextInput::make('url_entreprise')
                    ->default(null),
                TextInput::make('lieu')
                    ->default(null),
                TextInput::make('type_emploi')
                    ->default(null),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('realisations')
                    ->default(null)
                    ->columnSpanFull(),
                Textarea::make('technologies')
                    ->default(null)
                    ->columnSpanFull(),
                DatePicker::make('date_debut')
                    ->required(),
                DatePicker::make('date_fin'),
                Toggle::make('en_cours')
                    ->required(),
                TextInput::make('ordre')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
