<?php

namespace App\Livewire;

use App\Models\GioiDan;
use App\Models\Tinh;
use App\Models\ThoGioiApplication;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Trang Chủ')]
class SelectGioiDan extends Component
{
    public ?ThoGioiApplication $activeApplication = null;
    public ?int $tinhFilter = null;

    public function mount(): void
    {
        $this->activeApplication = ThoGioiApplication::where('user_id', Auth::id())
            ->whereIn('status', ['pending_document', 'pending_approval'])
            ->latest()
            ->first();
    }

    public function getOpenGioiDansProperty()
    {
        return GioiDan::with('tinh')
            ->where('status', 'open')
            ->when($this->tinhFilter, fn($q) => $q->where('tinh_id', $this->tinhFilter))
            ->orderBy('start_date')
            ->get();
    }

    public function getTinhsProperty()
    {
        return Tinh::whereHas('gioiDans', fn($q) => $q->where('status', 'open'))
            ->orderBy('name')
            ->get();
    }

    public function getTotalOpenProperty(): int
    {
        return GioiDan::where('status', 'open')->count();
    }

    public function getTotalUpcomingProperty(): int
    {
        return GioiDan::where('status', 'upcoming')->count();
    }

    public function render()
    {
        return view('livewire.select-gioi-dan');
    }
}
