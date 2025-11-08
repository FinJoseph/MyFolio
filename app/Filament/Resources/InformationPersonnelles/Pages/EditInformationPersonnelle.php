<?php

namespace App\Filament\Resources\InformationPersonnelles\Pages;

use App\Filament\Resources\InformationPersonnelles\InformationPersonnelleResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditInformationPersonnelle extends EditRecord
{
    protected static string $resource = InformationPersonnelleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
