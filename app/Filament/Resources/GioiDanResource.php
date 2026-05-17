<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GioiDanResource\Pages;
use App\Models\GioiDan;
use App\Models\Tinh;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class GioiDanResource extends Resource
{
    protected static ?string $model = GioiDan::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationLabel = 'Giới Đàn';
    protected static ?string $modelLabel = 'Giới Đàn';
    protected static ?string $pluralModelLabel = 'Danh sách Giới Đàn';
    protected static ?int $navigationSort = 1;

    public static function canViewAny(): bool
    {
        $user = auth()->user();
        return $user?->isAdmin() || $user?->isQuanLyTinh() || $user?->isQuanLyGioiDan() ?? false;
    }

    public static function getEloquentQuery(): Builder
    {
        $user = auth()->user();

        if ($user?->isQuanLyTinh()) {
            return parent::getEloquentQuery()
                ->whereIn('tinh_id', $user->tinhs()->pluck('tinhs.id'));
        }

        if ($user?->isQuanLyGioiDan()) {
            return parent::getEloquentQuery()
                ->whereIn('id', $user->gioiDans()->pluck('gioi_dans.id'));
        }

        return parent::getEloquentQuery();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Thông tin Giới Đàn')
                    ->schema([
                        Forms\Components\Select::make('tinh_id')
                            ->label('Tỉnh / Thành phố')
                            ->options(Tinh::orderBy('name')->pluck('name', 'id'))
                            ->nullable()
                            ->searchable()
                            ->placeholder('— Chọn tỉnh/thành phố —')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('name')
                            ->label('Tên Giới Đàn')
                            ->placeholder('VD: Đại Giới Đàn Thiện Hoa 2026')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('location')
                            ->label('Địa điểm tổ chức')
                            ->placeholder('VD: Chùa Ấn Quang, TP. Hồ Chí Minh')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Forms\Components\DatePicker::make('start_date')
                            ->label('Ngày khai mạc')
                            ->required(),
                        Forms\Components\DatePicker::make('end_date')
                            ->label('Ngày bế mạc')
                            ->required()
                            ->afterOrEqual('start_date'),
                        Forms\Components\Select::make('status')
                            ->label('Trạng thái')
                            ->options([
                                'upcoming' => 'Sắp diễn ra',
                                'open' => 'Đang mở đăng ký',
                                'closed' => 'Đã đóng đăng ký',
                                'completed' => 'Đã hoàn thành',
                            ])
                            ->required()
                            ->default('upcoming'),
                        Forms\Components\TextInput::make('max_participants')
                            ->label('Số lượng tối đa')
                            ->numeric()
                            ->placeholder('Để trống = không giới hạn'),
                    ])->columns(2),

                Forms\Components\Section::make('Giới phẩm được tổ chức')
                    ->schema([
                        Forms\Components\CheckboxList::make('ordination_levels')
                            ->label('Chọn các giới phẩm sẽ được truyền trao trong giới đàn này')
                            ->options([
                                'Sa di' => 'Sa di',
                                'Tỳ kheo' => 'Tỳ kheo',
                                'Sa di ni' => 'Sa di ni',
                                'Tỳ kheo ni' => 'Tỳ kheo ni',
                                'Thức xoa' => 'Thức xoa',
                                'Bồ tát giới' => 'Bồ tát giới',
                            ])
                            ->columns(3)
                            ->required(),
                    ]),

                Forms\Components\Section::make('Thành phần Giới Sư')
                    ->description('Thông tin sẽ in trên mặt trái Chứng Nhận Giới Tử')
                    ->schema([
                        Forms\Components\TextInput::make('hoa_thuong_dan_dau')
                            ->label('Hòa thượng đàn đầu')
                            ->placeholder('VD: Hòa Thượng THÍCH THIỆN NHƠN')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('yet_ma_a_xa_le')
                            ->label('Yết ma A-Xà-Lê')
                            ->placeholder('VD: Hòa Thượng THÍCH HUỆ THÔNG'),
                        Forms\Components\TextInput::make('giao_tho_a_xa_le')
                            ->label('Giáo thọ A-Xà-Lê')
                            ->placeholder('VD: Hòa Thượng THÍCH GIÁC NGHIÊM'),
                        Forms\Components\Repeater::make('ton_chung')
                            ->label('Tôn chứng Tăng-già')
                            ->schema([
                                Forms\Components\Select::make('ordinal')
                                    ->label('Thứ')
                                    ->options([
                                        'Đệ nhất' => 'Đệ nhất',
                                        'Đệ nhị' => 'Đệ nhị',
                                        'Đệ tam' => 'Đệ tam',
                                        'Đệ tứ' => 'Đệ tứ',
                                        'Đệ ngũ' => 'Đệ ngũ',
                                        'Đệ lục' => 'Đệ lục',
                                        'Đệ thất' => 'Đệ thất',
                                    ])
                                    ->required(),
                                Forms\Components\TextInput::make('name')
                                    ->label('Họ tên (Pháp danh)')
                                    ->placeholder('VD: Thượng Tọa THÍCH PHƯỚC NGUYÊN')
                                    ->required(),
                            ])
                            ->columns(2)
                            ->maxItems(7)
                            ->columnSpanFull()
                            ->defaultItems(0),
                    ])->columns(2),

                Forms\Components\Section::make('Thông tin thêm')
                    ->schema([
                        Forms\Components\Textarea::make('description')
                            ->label('Mô tả / Ghi chú')
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Tên Giới Đàn')
                    ->searchable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('tinh.name')
                    ->label('Tỉnh')
                    ->searchable()
                    ->sortable()
                    ->placeholder('—'),
                Tables\Columns\TextColumn::make('location')
                    ->label('Địa điểm')
                    ->searchable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->label('Khai mạc')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->label('Bế mạc')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Trạng thái')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match($state) {
                        'upcoming' => 'Sắp diễn ra',
                        'open' => 'Đang mở đăng ký',
                        'closed' => 'Đã đóng',
                        'completed' => 'Hoàn thành',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match($state) {
                        'upcoming' => 'info',
                        'open' => 'success',
                        'closed' => 'warning',
                        'completed' => 'gray',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('applications_count')
                    ->label('Số hồ sơ')
                    ->counts('applications')
                    ->badge()
                    ->color('amber'),
                Tables\Columns\TextColumn::make('max_participants')
                    ->label('Tối đa')
                    ->placeholder('Không giới hạn'),
            ])
            ->defaultSort('start_date', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Trạng thái')
                    ->options([
                        'upcoming' => 'Sắp diễn ra',
                        'open' => 'Đang mở đăng ký',
                        'closed' => 'Đã đóng',
                        'completed' => 'Hoàn thành',
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
            'index' => Pages\ListGioiDans::route('/'),
            'create' => Pages\CreateGioiDan::route('/create'),
            'edit' => Pages\EditGioiDan::route('/{record}/edit'),
        ];
    }
}
