<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name', 'email', 'password', 'role',
        'dharma_name', 'phone', 'gender', 'birth_date', 'id_card_number',
        'native_place', 'permanent_address', 'current_residence',
        'education_level', 'buddhist_education', 'ordain_date',
        'ordain_temple', 'master_name', 'temple_name',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'birth_date'        => 'date',
            'ordain_date'       => 'date',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return in_array($this->role, ['admin', 'quan_ly_tinh', 'quan_ly_gioi_dan']);
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isQuanLyTinh(): bool
    {
        return $this->role === 'quan_ly_tinh';
    }

    public function isQuanLyGioiDan(): bool
    {
        return $this->role === 'quan_ly_gioi_dan';
    }

    // Backward compatibility
    public function isQuanLy(): bool
    {
        return $this->isQuanLyTinh() || $this->isQuanLyGioiDan();
    }

    public function applications()
    {
        return $this->hasMany(ThoGioiApplication::class);
    }

    public function gioiDans()
    {
        return $this->belongsToMany(GioiDan::class);
    }

    public function tinhs()
    {
        return $this->belongsToMany(Tinh::class, 'tinh_user');
    }
}
