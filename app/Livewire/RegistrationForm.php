<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ThoGioiApplication;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class RegistrationForm extends Component
{
    use WithFileUploads;

    public $step = 1;
    public $applicationId;
    public $scanned_form;
    
    // Form fields
    public $full_name;
    public $dharma_name;
    public $gender = 'Nam';
    public $birth_date;
    public $id_card_number;
    public $native_place;
    public $permanent_address;
    public $current_residence;
    
    public $education_level;
    public $buddhist_education;
    public $ordain_date;
    public $ordain_temple;
    public $master_name;
    public $temple_name;
    
    public $ordination_level;
    
    public function mount()
    {
        if (Auth::check()) {
            $existing = ThoGioiApplication::where('user_id', Auth::id())
                ->where('status', 'pending_document')
                ->latest()
                ->first();
            
            if ($existing) {
                $this->applicationId = $existing->id;
                $this->step = 4;
            }
        }
    }

    protected $rules = [
        'full_name' => 'required|string|max:255',
        'birth_date' => 'required|date',
        'ordination_level' => 'required',
        'master_name' => 'required',
        'temple_name' => 'required',
    ];

    public function nextStep()
    {
        if ($this->step == 1) {
            $this->validate([
                'full_name' => 'required|string|max:255',
                'birth_date' => 'required|date',
            ]);
        } elseif ($this->step == 2) {
            $this->validate([
                'master_name' => 'required|string|max:255',
                'temple_name' => 'required|string|max:255',
            ]);
        }
        $this->step++;
    }

    public function prevStep()
    {
        $this->step--;
    }

    public function submit()
    {
        $this->validate();

        $application = ThoGioiApplication::updateOrCreate(
            ['id' => $this->applicationId],
            [
            'user_id' => Auth::id() ?? 1, // Fallback for demo if no auth
            'full_name' => $this->full_name,
            'dharma_name' => $this->dharma_name,
            'gender' => $this->gender,
            'birth_date' => $this->birth_date,
            'id_card_number' => $this->id_card_number,
            'native_place' => $this->native_place,
            'permanent_address' => $this->permanent_address,
            'current_residence' => $this->current_residence,
            'education_level' => $this->education_level,
            'buddhist_education' => $this->buddhist_education,
            'ordain_date' => $this->ordain_date,
            'ordain_temple' => $this->ordain_temple,
            'master_name' => $this->master_name,
            'temple_name' => $this->temple_name,
            'ordination_level' => $this->ordination_level,
            'status' => 'pending_document',
        ]);

        $this->applicationId = $application->id;

        session()->flash('message', 'Hồ sơ đã được tạo. Bước tiếp theo: Vui lòng IN ĐƠN, lấy dấu xác nhận và TẢI BẢN QUÉT lên hệ thống.');
        $this->resetExcept(['applicationId', 'step']);
        $this->step = 4; // Success step
    }

    public function uploadDocument()
    {
        $this->validate([
            'scanned_form' => 'required|mimes:jpg,jpeg,png,pdf|max:10240', // Max 10MB, support PDF
        ]);

        $application = ThoGioiApplication::findOrFail($this->applicationId);
        $path = $this->scanned_form->store('application-scans', 'public');
        
        $application->update([
            'scanned_form_path' => $path,
            'status' => 'pending_approval'
        ]);

        session()->flash('message', 'Chúc mừng! Bạn đã hoàn tất nộp hồ sơ. Vui lòng đợi Ban Trị Sự xét duyệt.');
        $this->step = 5; // Final success step
    }

    public function editApplication()
    {
        $application = ThoGioiApplication::findOrFail($this->applicationId);
        
        $this->full_name = $application->full_name;
        $this->dharma_name = $application->dharma_name;
        $this->gender = $application->gender;
        $this->birth_date = $application->birth_date ? \Carbon\Carbon::parse($application->birth_date)->format('Y-m-d') : null;
        $this->id_card_number = $application->id_card_number;
        $this->native_place = $application->native_place;
        $this->permanent_address = $application->permanent_address;
        $this->current_residence = $application->current_residence;
        $this->education_level = $application->education_level;
        $this->buddhist_education = $application->buddhist_education;
        $this->ordain_date = $application->ordain_date ? \Carbon\Carbon::parse($application->ordain_date)->format('Y-m-d') : null;
        $this->ordain_temple = $application->ordain_temple;
        $this->master_name = $application->master_name;
        $this->temple_name = $application->temple_name;
        $this->ordination_level = $application->ordination_level;

        $this->step = 1;
    }

    public function render()
    {
        return view('livewire.registration-form');
    }
}
