<?php

namespace App\Filament\Resources\Parametres\Pages;

use App\Filament\Resources\Parametres\ParametreResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListParametres extends ListRecords
{
    protected static string $resource = ParametreResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
