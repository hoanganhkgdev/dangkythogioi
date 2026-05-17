<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\GioiDan;
use App\Models\Tinh;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Tài khoản';
    protected static ?string $modelLabel = 'Tài khoản';
    protected static ?string $pluralModelLabel = 'Danh sách tài khoản';
    protected static ?int $navigationSort = 3;

    public static function canViewAny(): bool
    {
        return auth()->user()?->isAdmin() ?? false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Thông tin tài khoản')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Họ tên')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        Forms\Components\Select::make('role')
                            ->label('Vai trò')
                            ->options([
                                'user' => 'Giới tử (người dùng)',
                                'quan_ly_gioi_dan' => 'Quản lý Giới Đàn',
                                'quan_ly_tinh' => 'Quản lý Tỉnh',
                                'admin' => 'Quản trị viên',
                            ])
                            ->required()
                            ->default('user')
                            ->live(),
                        Forms\Components\DateTimePicker::make('email_verified_at')
                            ->label('Xác thực email lúc')
                            ->nullable(),
                    ])->columns(2),

                Forms\Components\Section::make('Tỉnh phụ trách')
                    ->description('Chọn các tỉnh/thành phố mà tài khoản này được phép quản lý')
                    ->schema([
                        Forms\Components\Select::make('tinhs')
                            ->label('Tỉnh được quản lý')
                            ->relationship('tinhs', 'name')
                            ->multiple()
                            ->searchable()
                            ->preload()
                            ->columnSpanFull(),
                    ])
                    ->visible(fn (Get $get) => $get('role') === 'quan_ly_tinh'),

                Forms\Components\Section::make('Giới Đàn phụ trách')
                    ->description('Chọn các giới đàn mà tài khoản này được phép quản lý hồ sơ')
                    ->schema([
                        Forms\Components\Select::make('gioiDans')
                            ->label('Giới Đàn được quản lý')
                            ->relationship('gioiDans', 'name')
                            ->multiple()
                            ->searchable()
                            ->preload()
                            ->columnSpanFull(),
                    ])
                    ->visible(fn (Get $get) => $get('role') === 'quan_ly_gioi_dan'),

                Forms\Components\Section::make('Mật khẩu')
                    ->description(fn (string $operation) => $operation === 'edit' ? 'Để trống nếu không muốn đổi mật khẩu' : '')
                    ->schema([
                        Forms\Components\TextInput::make('password')
                            ->label('Mật khẩu mới')
                            ->password()
                            ->revealable()
                            ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                            ->dehydrated(fn ($state) => filled($state))
                            ->required(fn (string $operation): bool => $operation === 'create')
                            ->minLength(8)
                            ->maxLength(255),
                        Forms\Components\TextInput::make('password_confirmation')
                            ->label('Nhập lại mật khẩu')
                            ->password()
                            ->revealable()
                            ->same('password')
                            ->required(fn (string $operation): bool => $operation === 'create')
                            ->dehydrated(false),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Họ tên')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('role')
                    ->label('Vai trò')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match($state) {
                        'admin' => 'Quản trị viên',
                        'quan_ly_tinh' => 'Quản lý Tỉnh',
                        'quan_ly_gioi_dan' => 'Quản lý Giới Đàn',
                        default => 'Giới tử',
                    })
                    ->color(fn (string $state): string => match($state) {
                        'admin' => 'danger',
                        'quan_ly_tinh' => 'warning',
                        'quan_ly_gioi_dan' => 'info',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('applications_count')
                    ->label('Số hồ sơ')
                    ->counts('applications')
                    ->badge()
                    ->color('info'),
                Tables\Columns\IconColumn::make('email_verified_at')
                    ->label('Xác thực email')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-badge')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('role')
                    ->label('Vai trò')
                    ->options([
                        'user' => 'Giới tử (người dùng)',
                        'quan_ly_gioi_dan' => 'Quản lý Giới Đàn',
                        'quan_ly_tinh' => 'Quản lý Tỉnh',
                        'admin' => 'Quản trị viên',
                    ]),
            ])
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
