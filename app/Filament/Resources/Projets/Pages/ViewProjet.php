<?php

namespace App\Filament\Resources\Projets\Pages;

use App\Filament\Resources\Projets\ProjetResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewProjet extends ViewRecord
{
    protected static string $resource = ProjetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
