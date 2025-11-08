<?php

namespace App\Filament\Resources\Projets\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ProjetInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('titre'),
                TextEntry::make('slug'),
                TextEntry::make('description')
                    ->columnSpanFull(),
                TextEntry::make('contenu')
                    ->placeholder('-')
                    ->columnSpanFull(),
                ImageEntry::make('image')
                    ->placeholder('-'),
                TextEntry::make('galerie')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('technologies')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('url_projet')
                    ->placeholder('-'),
                TextEntry::make('url_github')
                    ->placeholder('-'),
                TextEntry::make('categorie')
                    ->placeholder('-'),
                TextEntry::make('ordre')
                    ->numeric(),
                IconEntry::make('est_mis_en_avant')
                    ->boolean(),
                TextEntry::make('date_projet')
                    ->date()
                    ->placeholder('-'),
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
