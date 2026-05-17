<?php

namespace App\Filament\Resources\TinhResource\Pages;

use App\Filament\Resources\TinhResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTinh extends EditRecord
{
    protected static string $resource = TinhResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
