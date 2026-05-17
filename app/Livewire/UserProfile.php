<?php

namespace App\Livewire;

use App\Models\ThoGioiApplication;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Hồ sơ cá nhân')]
class UserProfile extends Component
{
    public string $name = '';
    public string $email = '';
    public string $phone = '';
    public string $dharma_name = '';
    public string $gender = 'Nam';
    public string $birth_date = '';
    public string $id_card_number = '';
    public string $native_place = '';
    public string $permanent_address = '';
    public string $current_residence = '';
    public string $education_level = '';
    public string $buddhist_education = '';
    public string $ordain_date = '';
    public string $ordain_temple = '';
    public string $master_name = '';
    public string $temple_name = '';

    public string $current_password = '';
    public string $new_password = '';
    public string $new_password_confirmation = '';

    public bool $savedProfile = false;
    public bool $savedPassword = false;

    public function mount(): void
    {
        $user = Auth::user();
        $this->name               = $user->name;
        $this->email              = $user->email;
        $this->phone              = $user->phone ?? '';
        $this->dharma_name        = $user->dharma_name ?? '';
        $this->gender             = $user->gender ?? 'Nam';
        $this->birth_date         = $user->birth_date?->format('Y-m-d') ?? '';
        $this->id_card_number     = $user->id_card_number ?? '';
        $this->native_place       = $user->native_place ?? '';
        $this->permanent_address  = $user->permanent_address ?? '';
        $this->current_residence  = $user->current_residence ?? '';
        $this->education_level    = $user->education_level ?? '';
        $this->buddhist_education = $user->buddhist_education ?? '';
        $this->ordain_date        = $user->ordain_date?->format('Y-m-d') ?? '';
        $this->ordain_temple      = $user->ordain_temple ?? '';
        $this->master_name        = $user->master_name ?? '';
        $this->temple_name        = $user->temple_name ?? '';
    }

    public function saveProfile(): void
    {
        $this->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'phone' => 'nullable|string|max:20',
        ]);

        Auth::user()->update([
            'name'               => $this->name,
            'email'              => $this->email,
            'phone'              => $this->phone,
            'dharma_name'        => $this->dharma_name ?: null,
            'gender'             => $this->gender,
            'birth_date'         => $this->birth_date ?: null,
            'id_card_number'     => $this->id_card_number ?: null,
            'native_place'       => $this->native_place ?: null,
            'permanent_address'  => $this->permanent_address ?: null,
            'current_residence'  => $this->current_residence ?: null,
            'education_level'    => $this->education_level ?: null,
            'buddhist_education' => $this->buddhist_education ?: null,
            'ordain_date'        => $this->ordain_date ?: null,
            'ordain_temple'      => $this->ordain_temple ?: null,
            'master_name'        => $this->master_name ?: null,
            'temple_name'        => $this->temple_name ?: null,
        ]);

        $this->savedProfile = true;
        $this->dispatch('profile-saved');
    }

    public function savePassword(): void
    {
        $this->validate([
            'current_password'          => 'required',
            'new_password'              => 'required|min:8|confirmed',
            'new_password_confirmation' => 'required',
        ]);

        if (!Hash::check($this->current_password, Auth::user()->password)) {
            $this->addError('current_password', 'Mật khẩu hiện tại không đúng.');
            return;
        }

        Auth::user()->update(['password' => Hash::make($this->new_password)]);

        $this->current_password = '';
        $this->new_password = '';
        $this->new_password_confirmation = '';
        $this->savedPassword = true;
    }

    public function cancelApplication(int $id): void
    {
        $app = ThoGioiApplication::where('id', $id)
            ->where('user_id', Auth::id())
            ->where('status', 'pending_document')
            ->firstOrFail();

        $app->delete();
    }

    public function getApplicationsProperty()
    {
        return ThoGioiApplication::where('user_id', Auth::id())
            ->with('gioiDan')
            ->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.user-profile');
    }
}
