<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThoGioiApplication extends Model
{
    protected $guarded = [];

    protected $casts = [
        'birth_date'   => 'date',
        'ordain_date'  => 'date',
        'id_card_date' => 'date',
        'approved_at'  => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function gioiDan()
    {
        return $this->belongsTo(GioiDan::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::updating(function ($model) {
            if ($model->isDirty('status') && $model->status === 'passed') {
                if (!$model->certificate_id) {
                    $year = date('Y');
                    $prefix = match($model->ordination_level) {
                        'Sa di' => 'SD',
                        'Tỳ kheo' => 'TK',
                        'Sa di ni' => 'SDN',
                        'Tỳ kheo ni' => 'TKN',
                        'Thức xoa' => 'TX',
                        'Bồ tát giới' => 'BTG',
                        default => 'TG',
                    };
                    $latest = static::where('certificate_id', 'like', "$prefix-$year-%")
                        ->orderBy('certificate_id', 'desc')
                        ->first();
                    
                    if ($latest) {
                        $lastNumber = (int) substr($latest->certificate_id, -4);
                        $number = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
                    } else {
                        $number = '0001';
                    }

                    $model->certificate_id = "$prefix-$year-$number";
                }
                
                if (!$model->approved_at) {
                    $model->approved_at = now();
                }
            }
        });
    }
}
