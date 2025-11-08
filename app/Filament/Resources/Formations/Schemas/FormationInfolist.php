<?php

namespace App\Filament\Resources\Formations\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class FormationInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('diplome'),
                TextEntry::make('ecole'),
                TextEntry::make('domaine')
                    ->placeholder('-'),
                TextEntry::make('description')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('date_debut')
                    ->date(),
                TextEntry::make('date_fin')
                    ->date()
                    ->placeholder('-'),
                IconEntry::make('en_cours')
                    ->boolean(),
                TextEntry::make('ordre')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
