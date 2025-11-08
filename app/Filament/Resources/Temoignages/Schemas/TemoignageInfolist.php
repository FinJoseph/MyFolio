<?php

namespace App\Filament\Resources\Temoignages\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TemoignageInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nom_client'),
                TextEntry::make('poste_client')
                    ->placeholder('-'),
                TextEntry::make('entreprise_client')
                    ->placeholder('-'),
                TextEntry::make('avatar_client')
                    ->placeholder('-'),
                TextEntry::make('contenu')
                    ->columnSpanFull(),
                TextEntry::make('note')
                    ->numeric(),
                TextEntry::make('projet.id')
                    ->label('Projet')
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
