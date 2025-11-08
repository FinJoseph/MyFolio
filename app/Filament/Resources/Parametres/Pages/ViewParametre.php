<?php

namespace App\Filament\Resources\Parametres\Pages;

use App\Filament\Resources\Parametres\ParametreResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewParametre extends ViewRecord
{
    protected static string $resource = ParametreResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
