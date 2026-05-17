<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TinhResource\Pages;
use App\Models\Tinh;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TinhResource extends Resource
{
    protected static ?string $model = Tinh::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';
    protected static ?string $navigationLabel = 'Tỉnh / Thành phố';
    protected static ?string $modelLabel = 'Tỉnh / Thành phố';
    protected static ?string $pluralModelLabel = 'Danh sách Tỉnh / Thành phố';
    protected static ?int $navigationSort = 0;

    public static function canViewAny(): bool
    {
        return auth()->user()?->isAdmin() ?? false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Thông tin Tỉnh / Thành phố')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Tên tỉnh/thành phố')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('code')
                            ->label('Mã tỉnh')
                            ->maxLength(50)
                            ->nullable(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Tên tỉnh/thành phố')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('code')
                    ->label('Mã tỉnh')
                    ->searchable()
                    ->placeholder('—'),
                Tables\Columns\TextColumn::make('gioi_dans_count')
                    ->label('Số Giới Đàn')
                    ->counts('gioiDans')
                    ->badge()
                    ->color('info'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(),
            ])
            ->defaultSort('name')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTinhs::route('/'),
            'create' => Pages\CreateTinh::route('/create'),
            'edit' => Pages\EditTinh::route('/{record}/edit'),
        ];
    }
}
