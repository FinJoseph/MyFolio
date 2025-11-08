<?php

namespace App\Filament\Resources\InformationPersonnelles\Pages;

use App\Filament\Resources\InformationPersonnelles\InformationPersonnelleResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewInformationPersonnelle extends ViewRecord
{
    protected static string $resource = InformationPersonnelleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
