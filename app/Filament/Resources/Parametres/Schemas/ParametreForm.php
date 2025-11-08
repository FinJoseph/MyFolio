<?php

namespace App\Filament\Resources\Parametres\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ParametreForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('cle')
                    ->required(),
                Textarea::make('valeur')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('type')
                    ->required()
                    ->default('text'),
                TextInput::make('groupe')
                    ->required()
                    ->default('general'),
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
