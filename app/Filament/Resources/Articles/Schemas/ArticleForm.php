<?php

namespace App\Filament\Resources\Articles\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('titre')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                Textarea::make('extrait')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('contenu')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('image_principale')
                    ->image(),
                TextInput::make('categorie')
                    ->default(null),
                Textarea::make('tags')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('temps_lecture')
                    ->numeric()
                    ->default(null),
                TextInput::make('vues')
                    ->required()
                    ->numeric()
                    ->default(0),
                DateTimePicker::make('publie_le'),
            ]);
    }
}
