<?php

namespace App\Filament\Resources\InformationPersonnelles\Pages;

use App\Filament\Resources\InformationPersonnelles\InformationPersonnelleResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListInformationPersonnelles extends ListRecords
{
    protected static string $resource = InformationPersonnelleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
