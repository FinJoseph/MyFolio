<?php

namespace App\Filament\Resources\InformationPersonnelles\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class InformationPersonnellesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nom_complet')
                    ->searchable(),
                TextColumn::make('prenom')
                    ->searchable(),
                TextColumn::make('nom')
                    ->searchable(),
                TextColumn::make('titre_poste')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('telephone')
                    ->searchable(),
                TextColumn::make('adresse')
                    ->searchable(),
                TextColumn::make('ville')
                    ->searchable(),
                TextColumn::make('pays')
                    ->searchable(),
                TextColumn::make('code_postal')
                    ->searchable(),
                TextColumn::make('date_naissance')
                    ->date()
                    ->sortable(),
                TextColumn::make('photo_profil')
                    ->searchable(),
                TextColumn::make('cv_pdf')
                    ->searchable(),
                TextColumn::make('linkedin')
                    ->searchable(),
                TextColumn::make('github')
                    ->searchable(),
                TextColumn::make('twitter')
                    ->searchable(),
                TextColumn::make('instagram')
                    ->searchable(),
                TextColumn::make('facebook')
                    ->searchable(),
                TextColumn::make('dribbble')
                    ->searchable(),
                TextColumn::make('behance')
                    ->searchable(),
                TextColumn::make('youtube')
                    ->searchable(),
                IconColumn::make('disponible_freelance')
                    ->boolean(),
                TextColumn::make('statut_disponibilite')
                    ->searchable(),
                TextColumn::make('meta_titre')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
