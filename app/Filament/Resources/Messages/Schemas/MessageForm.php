<?php

namespace App\Filament\Resources\Messages\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class MessageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nom')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('sujet')
                    ->default(null),
                Textarea::make('message')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('statut')
                    ->required()
                    ->default('nouveau'),
                TextInput::make('ip_address')
                    ->default(null),
                TextInput::make('user_agent')
                    ->default(null),
                Textarea::make('reponse')
                    ->default(null)
                    ->columnSpanFull(),
                DateTimePicker::make('repondu_le'),
                TextInput::make('repondu_par')
                    ->numeric()
                    ->default(null),
            ]);
    }
}
