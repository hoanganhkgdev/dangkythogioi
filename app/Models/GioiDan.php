<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GioiDan extends Model
{
    protected $guarded = [];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'ordination_levels' => 'array',
        'ton_chung' => 'array',
    ];

    public function applications()
    {
        return $this->hasMany(ThoGioiApplication::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'upcoming' => 'Sắp diễn ra',
            'open' => 'Đang mở đăng ký',
            'closed' => 'Đã đóng đăng ký',
            'completed' => 'Đã hoàn thành',
            default => $this->status,
        };
    }
}
