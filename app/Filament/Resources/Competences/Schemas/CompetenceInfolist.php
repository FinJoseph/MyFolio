<?php

namespace App\Filament\Resources\Competences\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CompetenceInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nom'),
                TextEntry::make('categorie'),
                TextEntry::make('niveau')
                    ->numeric(),
                TextEntry::make('icone')
                    ->placeholder('-'),
                TextEntry::make('couleur')
                    ->placeholder('-'),
                TextEntry::make('ordre')
                    ->numeric(),
                IconEntry::make('est_visible')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
