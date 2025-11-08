<?php

namespace App\Filament\Resources\InformationPersonnelles\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class InformationPersonnelleInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Image de profil avec mode circulaire
                ImageEntry::make('photo_profil')
                    ->label('Photo de profil')
                    ->state(function ($record) {
                        // Retourne l'URL complète de l'image
                        if ($record->photo_profil) {
                            return asset('storage/'.$record->photo_profil);
                        }

                        return null;
                    })
                    ->circular()
                    ->imageHeight(150)
                    ->defaultImageUrl(url('/images/default-avatar.png')),

                TextEntry::make('nom_complet')
                    ->label('Nom complet'),

                TextEntry::make('prenom'),

                TextEntry::make('nom'),

                TextEntry::make('titre_poste')
                    ->label('Titre du poste'),

                TextEntry::make('email')
                    ->icon('heroicon-m-envelope')
                    ->copyable(),

                TextEntry::make('telephone')
                    ->icon('heroicon-m-phone')
                    ->copyable(),

                TextEntry::make('bio_courte')
                    ->label('Bio courte')
                    ->columnSpanFull(),

                TextEntry::make('bio_complete')
                    ->label('Bio complète')
                    ->columnSpanFull()
                    ->html(),

                TextEntry::make('adresse'),

                TextEntry::make('ville'),

                TextEntry::make('pays'),

                TextEntry::make('code_postal'),

                // Pour le CV PDF, utilisez TextEntry avec un lien
                TextEntry::make('cv_pdf')
                    ->label('CV (PDF)')
                    ->formatStateUsing(fn ($state) => $state ? 'Télécharger le CV' : 'Aucun CV')
                    ->url(fn ($record) => $record->cv_pdf ? asset('storage/'.$record->cv_pdf) : null)
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('primary'),

                TextEntry::make('date_naissance')
                    ->label('Date de naissance')
                    ->date('d/m/Y'),

                TextEntry::make('linkedin')
                    ->url(fn ($state) => $state)
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-link'),

                TextEntry::make('github')
                    ->url(fn ($state) => $state)
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-link'),

                TextEntry::make('twitter')
                    ->url(fn ($state) => $state)
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-link'),

                TextEntry::make('instagram')
                    ->url(fn ($state) => $state)
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-link'),

                IconEntry::make('disponible_freelance')
                    ->label('Disponible en freelance')
                    ->boolean(),

                TextEntry::make('statut_disponibilite')
                    ->label('Statut')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'disponible' => 'success',
                        'occupé' => 'warning',
                        'indisponible' => 'danger',
                        default => 'gray',
                    }),

                TextEntry::make('message_disponibilite')
                    ->columnSpanFull(),
            ]);
    }
}
