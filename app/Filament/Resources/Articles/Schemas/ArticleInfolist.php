<?php

namespace App\Filament\Resources\Articles\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ArticleInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('titre'),
                TextEntry::make('slug'),
                TextEntry::make('extrait')
                    ->columnSpanFull(),
                TextEntry::make('contenu')
                    ->columnSpanFull(),
                ImageEntry::make('image_principale')
                    ->placeholder('-'),
                TextEntry::make('categorie')
                    ->placeholder('-'),
                TextEntry::make('tags')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('temps_lecture')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('vues')
                    ->numeric(),
                TextEntry::make('publie_le')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
