<?php

namespace App\Filament\Resources\Projets\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProjetForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('titre')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('contenu')
                    ->default(null)
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->image(),
                Textarea::make('galerie')
                    ->default(null)
                    ->columnSpanFull(),
                Textarea::make('technologies')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('url_projet')
                    ->default(null),
                TextInput::make('url_github')
                    ->default(null),
                TextInput::make('categorie')
                    ->default(null),
                TextInput::make('ordre')
                    ->required()
                    ->numeric()
                    ->default(0),
                Toggle::make('est_mis_en_avant')
                    ->required(),
                DatePicker::make('date_projet'),
                DateTimePicker::make('publie_le'),
            ]);
    }
}
