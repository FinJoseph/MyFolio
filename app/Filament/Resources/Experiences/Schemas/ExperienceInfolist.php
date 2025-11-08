<?php

namespace App\Filament\Resources\Experiences\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ExperienceInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('poste'),
                TextEntry::make('entreprise'),
                TextEntry::make('url_entreprise')
                    ->placeholder('-'),
                TextEntry::make('lieu')
                    ->placeholder('-'),
                TextEntry::make('type_emploi')
                    ->placeholder('-'),
                TextEntry::make('description')
                    ->columnSpanFull(),
                TextEntry::make('realisations')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('technologies')
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
