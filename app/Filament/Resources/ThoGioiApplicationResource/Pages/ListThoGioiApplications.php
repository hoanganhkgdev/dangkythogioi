<?php

namespace App\Filament\Resources\ThoGioiApplicationResource\Pages;

use App\Filament\Resources\ThoGioiApplicationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListThoGioiApplications extends ListRecords
{
    protected static string $resource = ThoGioiApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
