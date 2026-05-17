<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tinh extends Model
{
    protected $guarded = [];

    public function gioiDans()
    {
        return $this->hasMany(GioiDan::class);
    }

    public function managers()
    {
        return $this->belongsToMany(User::class, 'tinh_user');
    }
}
