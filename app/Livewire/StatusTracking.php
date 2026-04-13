<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ThoGioiApplication;

class StatusTracking extends Component
{
    public $search;
    public $application;
    public $notFound = false;

    public function track()
    {
        $this->validate([
            'search' => 'required',
        ]);

        $this->application = ThoGioiApplication::where('id_card_number', $this->search)
            ->orWhere('id', $this->search)
            ->first();

        if (!$this->application) {
            $this->notFound = true;
        } else {
            $this->notFound = false;
        }
    }

    public function render()
    {
        return view('livewire.status-tracking');
    }
}
