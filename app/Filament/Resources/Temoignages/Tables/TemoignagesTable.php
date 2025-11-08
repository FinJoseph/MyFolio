<?php

namespace App\Filament\Resources\Temoignages\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TemoignagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nom_client')
                    ->searchable(),
                TextColumn::make('poste_client')
                    ->searchable(),
                TextColumn::make('entreprise_client')
                    ->searchable(),
                TextColumn::make('avatar_client')
                    ->searchable(),
                TextColumn::make('note')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('projet.id')
                    ->searchable(),
                TextColumn::make('ordre')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('est_visible')
                    ->boolean(),
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
