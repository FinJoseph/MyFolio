<?php

namespace App\Filament\Resources\InformationPersonnelles\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class InformationPersonnelleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nom_complet')
                    ->default(null),
                TextInput::make('prenom')
                    ->required(),
                TextInput::make('nom')
                    ->required(),
                TextInput::make('titre_poste')
                    ->required(),
                Textarea::make('bio_courte')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('bio_complete')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('telephone')
                    ->tel()
                    ->default(null),
                TextInput::make('adresse')
                    ->default(null),
                TextInput::make('ville')
                    ->default(null),
                TextInput::make('pays')
                    ->default(null),
                TextInput::make('code_postal')
                    ->default(null),
                DatePicker::make('date_naissance'),
                // Remplacer TextInput par FileUpload pour la photo de profil
                FileUpload::make('photo_profil')
                    ->label('Photo de profil')
                    ->image()
                    ->avatar() // Active le mode avatar (affichage circulaire)
                    ->imageEditor() // Active l'éditeur d'image
                    ->directory('profiles')
                    ->disk('public') // Important: utilisez disk() au lieu de visibility()
                    ->maxSize(2048)
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->downloadable() // Permet de télécharger l'image
                    ->openable() // Permet d'ouvrir l'image dans un nouvel onglet
                    ->helperText('Format: JPG, PNG ou WebP. Max: 2MB. Ratio 1:1 recommandé.')
                    ->columnSpanFull(),

                FileUpload::make('cv_pdf')
                    ->label('CV (PDF)')
                    ->acceptedFileTypes(['application/pdf'])
                    ->directory('cvs')
                    ->disk('public')
                    ->maxSize(5120)
                    ->downloadable()
                    ->openable()
                    ->helperText('Format PDF uniquement. Max: 5MB')
                    ->columnSpanFull(),

                TextInput::make('linkedin')
                    ->default(null),
                TextInput::make('github')
                    ->default(null),
                TextInput::make('twitter')
                    ->default(null),
                TextInput::make('instagram')
                    ->default(null),
                TextInput::make('facebook')
                    ->default(null),
                TextInput::make('dribbble')
                    ->default(null),
                TextInput::make('behance')
                    ->default(null),
                TextInput::make('youtube')
                    ->default(null),
                Toggle::make('disponible_freelance')
                    ->required(),
                TextInput::make('statut_disponibilite')
                    ->required()
                    ->default('disponible'),
                Textarea::make('message_disponibilite')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('meta_titre')
                    ->default(null),
                Textarea::make('meta_description')
                    ->default(null)
                    ->columnSpanFull(),
                Textarea::make('meta_mots_cles')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
