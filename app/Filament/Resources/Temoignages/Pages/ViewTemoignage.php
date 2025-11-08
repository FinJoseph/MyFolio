<?php

namespace App\Filament\Resources\Temoignages\Pages;

use App\Filament\Resources\Temoignages\TemoignageResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewTemoignage extends ViewRecord
{
    protected static string $resource = TemoignageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
