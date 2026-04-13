<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ThoGioiApplicationResource\Pages;
use App\Filament\Resources\ThoGioiApplicationResource\RelationManagers;
use App\Models\ThoGioiApplication;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ThoGioiApplicationResource extends Resource
{
    protected static ?string $model = ThoGioiApplication::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    
    protected static ?string $navigationLabel = 'Hồ sơ Thọ giới';
    
    protected static ?string $modelLabel = 'Hồ sơ Thọ giới';
    
    protected static ?string $pluralModelLabel = 'Danh sách Hồ sơ';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Thông tin cá nhân (Theo mẫu TN01)')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->relationship('user', 'name')
                            ->label('Người dùng (Tài khoản)')
                            ->required(),
                        Forms\Components\TextInput::make('full_name')
                            ->label('Họ và tên (Khai sinh)')
                            ->required(),
                        Forms\Components\TextInput::make('dharma_name')
                            ->label('Pháp danh'),
                        Forms\Components\Select::make('gender')
                            ->label('Giới tính')
                            ->options(['Nam' => 'Nam', 'Nữ' => 'Nữ'])
                            ->default('Nam')
                            ->required(),
                        Forms\Components\DatePicker::make('birth_date')
                            ->label('Ngày sinh')
                            ->required(),
                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('id_card_number')
                                    ->label('Số CCCD'),
                                Forms\Components\DatePicker::make('id_card_date')
                                    ->label('Ngày cấp'),
                                Forms\Components\TextInput::make('id_card_place')
                                    ->label('Nơi cấp'),
                            ]),
                        Forms\Components\TextInput::make('native_place')
                            ->label('Quê quán'),
                        Forms\Components\TextInput::make('permanent_address')
                            ->label('Hộ khẩu thường trú'),
                        Forms\Components\TextInput::make('current_residence')
                            ->label('Nơi ở hiện tại'),
                    ])->columns(2),
                
                Forms\Components\Section::make('Trình độ & Quá trình tu học')
                    ->schema([
                        Forms\Components\TextInput::make('education_level')
                            ->label('Trình độ văn hóa'),
                        Forms\Components\TextInput::make('buddhist_education')
                            ->label('Trình độ Phật học'),
                        Forms\Components\DatePicker::make('ordain_date')
                            ->label('Ngày phát tâm tu học'),
                        Forms\Components\TextInput::make('ordain_temple')
                            ->label('Nơi phát tâm tu học'),
                        Forms\Components\TextInput::make('master_name')
                            ->label('Hòa thượng Bổn sư'),
                        Forms\Components\TextInput::make('temple_name')
                            ->label('Chùa/Cơ sở hiện tại'),
                    ])->columns(2),

                Forms\Components\Section::make('Trạng thái đăng ký thọ giới')
                    ->schema([
                        Forms\Components\Select::make('ordination_level')
                            ->label('Giới phẩm đăng ký thọ')
                            ->options([
                                'Sa di' => 'Sa di',
                                'Tỳ kheo' => 'Tỳ kheo',
                                'Sa di ni' => 'Sa di ni',
                                'Tỳ kheo ni' => 'Tỳ kheo ni',
                                'Thức xoa' => 'Thức xoa',
                                'Bồ tát giới' => 'Bồ tát giới',
                            ])
                            ->required(),
                        Forms\Components\Select::make('status')
                            ->label('Trạng thái hồ sơ')
                            ->options([
                                'pending_document' => 'Chờ bổ sung bản scan',
                                'pending_approval' => 'Chờ duyệt hồ sơ',
                                'approved' => 'Đã duyệt (Được thọ giới)',
                                'passed' => 'Đã đậu (Cấp chứng điệp)',
                                'rejected' => 'Từ chối',
                            ])
                            ->required(),
                        Forms\Components\FileUpload::make('scanned_form_path')
                            ->label('Bản scan đơn có dấu (Chọn ảnh hoặc PDF)')
                            ->directory('application-scans')
                            ->acceptedFileTypes(['application/pdf', 'image/*'])
                            ->maxSize(10240)
                            ->openable()
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('certificate_id')
                            ->label('Số Chứng điệp cấp')
                            ->disabled()
                            ->placeholder('Sẽ tự động sinh khi duyệt'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('full_name')
                    ->label('Họ tên')
                    ->searchable(),
                Tables\Columns\TextColumn::make('dharma_name')
                    ->label('Pháp danh')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ordination_level')
                    ->label('Giới phẩm')
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Trạng thái')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending_document' => 'gray',
                        'pending_approval' => 'warning',
                        'approved' => 'info',
                        'passed' => 'success',
                        'rejected' => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ngày đăng ký')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('ordination_level')
                    ->label('Cấp bậc')
                    ->options([
                        'Sa di' => 'Sa di',
                        'Tỳ kheo' => 'Tỳ kheo',
                        'Sa di ni' => 'Sa di ni',
                        'Tỳ kheo ni' => 'Tỳ kheo ni',
                        'Thức xoa' => 'Thức xoa',
                    ]),
                Tables\Filters\SelectFilter::make('status')
                    ->label('Trạng thái')
                    ->options([
                        'pending_document' => 'Chờ bản scan',
                        'pending_approval' => 'Chờ duyệt',
                        'approved' => 'Đã duyệt',
                        'passed' => 'Đã đậu',
                        'rejected' => 'Từ chối',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('print')
                    ->label('In hồ sơ')
                    ->icon('heroicon-o-printer')
                    ->color('info')
                    ->url(fn (ThoGioiApplication $record) => route('application.print', $record))
                    ->openUrlInNewTab(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListThoGioiApplications::route('/'),
            'create' => Pages\CreateThoGioiApplication::route('/create'),
            'edit' => Pages\EditThoGioiApplication::route('/{record}/edit'),
        ];
    }
}
