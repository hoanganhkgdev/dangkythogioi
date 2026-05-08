<?php

namespace App\Filament\Resources\GioiDanResource\Pages;

use App\Filament\Resources\GioiDanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGioiDan extends EditRecord
{
    protected static string $resource = GioiDanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
