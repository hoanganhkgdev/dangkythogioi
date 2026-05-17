<?php

namespace App\Filament\Resources\TinhResource\Pages;

use App\Filament\Resources\TinhResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTinhs extends ListRecords
{
    protected static string $resource = TinhResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
