<?php

namespace App\Filament\Resources\ThoGioiApplicationResource\Pages;

use App\Filament\Resources\ThoGioiApplicationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditThoGioiApplication extends EditRecord
{
    protected static string $resource = ThoGioiApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
