<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('titre')
                    ->required(),
                TextInput::make('icone')
                    ->default(null),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('fonctionnalites')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('ordre')
                    ->required()
                    ->numeric()
                    ->default(0),
                Toggle::make('est_visible')
                    ->required(),
            ]);
    }
}
