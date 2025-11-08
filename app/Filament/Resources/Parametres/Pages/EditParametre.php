<?php

namespace App\Filament\Resources\Parametres\Pages;

use App\Filament\Resources\Parametres\ParametreResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditParametre extends EditRecord
{
    protected static string $resource = ParametreResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
