<?php

namespace App\Livewire;

use App\Models\GioiDan;
use App\Models\ThoGioiApplication;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class RegistrationForm extends Component
{
    use WithFileUploads;

    public int $step = 1;
    public ?int $applicationId = null;
    public $scanned_form;

    public string $full_name = '';
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
    public string $ordination_level = '';
    public ?int $gioi_dan_id = null;

    public function mount(): void
    {
        if (!Auth::check()) return;

        $existing = ThoGioiApplication::where('user_id', Auth::id())
            ->whereIn('status', ['pending_document', 'pending_approval'])
            ->latest()
            ->first();

        if ($existing) {
            $this->applicationId = $existing->id;
            $this->gioi_dan_id   = $existing->gioi_dan_id;
            $this->step = $existing->status === 'pending_approval' ? 5 : 4;
            return;
        }

        if ($gioiDanId = request()->query('gioi_dan_id')) {
            $this->gioi_dan_id = (int) $gioiDanId;
        } else {
            $this->redirectRoute('home');
            return;
        }

        $this->prefillFromProfile(Auth::user());
    }

    private function prefillFromProfile($user): void
    {
        $map = [
            'full_name'         => $user->name,
            'dharma_name'       => $user->dharma_name ?? '',
            'gender'            => $user->gender ?? 'Nam',
            'birth_date'        => $user->birth_date?->format('Y-m-d') ?? '',
            'id_card_number'    => $user->id_card_number ?? '',
            'native_place'      => $user->native_place ?? '',
            'permanent_address' => $user->permanent_address ?? '',
            'current_residence' => $user->current_residence ?? '',
            'education_level'   => $user->education_level ?? '',
            'buddhist_education'=> $user->buddhist_education ?? '',
            'ordain_date'       => $user->ordain_date?->format('Y-m-d') ?? '',
            'ordain_temple'     => $user->ordain_temple ?? '',
            'master_name'       => $user->master_name ?? '',
            'temple_name'       => $user->temple_name ?? '',
        ];

        foreach ($map as $field => $value) {
            if (empty($this->$field) && !empty($value)) {
                $this->$field = $value;
            }
        }
    }

    public function updatedGioiDanId(): void
    {
        $this->ordination_level = '';
    }

    public function nextStep(): void
    {
        match ($this->step) {
            1 => $this->validate([
                'full_name'  => 'required|string|max:255',
                'birth_date' => 'required|date',
            ]),
            2 => $this->validate([
                'master_name' => 'required|string|max:255',
                'temple_name' => 'required|string|max:255',
            ]),
            3 => $this->validate([
                'gioi_dan_id'      => 'required|exists:gioi_dans,id',
                'ordination_level' => 'required|string',
            ]),
            default => null,
        };

        $this->step++;
    }

    public function prevStep(): void
    {
        $this->step--;
    }

    public function submit(): void
    {
        $this->validate([
            'full_name'        => 'required|string|max:255',
            'birth_date'       => 'required|date',
            'master_name'      => 'required|string|max:255',
            'temple_name'      => 'required|string|max:255',
            'gioi_dan_id'      => 'required|exists:gioi_dans,id',
            'ordination_level' => 'required|string',
        ]);

        $application = ThoGioiApplication::updateOrCreate(
            ['id' => $this->applicationId],
            [
                'user_id'          => Auth::id(),
                'gioi_dan_id'      => $this->gioi_dan_id,
                'full_name'        => $this->full_name,
                'dharma_name'      => $this->dharma_name,
                'gender'           => $this->gender,
                'birth_date'       => $this->birth_date,
                'id_card_number'   => $this->id_card_number,
                'native_place'     => $this->native_place,
                'permanent_address'=> $this->permanent_address,
                'current_residence'=> $this->current_residence,
                'education_level'  => $this->education_level,
                'buddhist_education'=> $this->buddhist_education,
                'ordain_date'      => $this->ordain_date ?: null,
                'ordain_temple'    => $this->ordain_temple,
                'master_name'      => $this->master_name,
                'temple_name'      => $this->temple_name,
                'ordination_level' => $this->ordination_level,
                'status'           => 'pending_document',
            ]
        );

        $this->applicationId = $application->id;
        $this->step = 4;
    }

    public function uploadDocument(): void
    {
        $this->validate([
            'scanned_form' => 'required|mimes:jpg,jpeg,png,pdf|max:10240',
        ]);

        $path = $this->scanned_form->store('application-scans', 'public');

        ThoGioiApplication::findOrFail($this->applicationId)->update([
            'scanned_form_path' => $path,
            'status'            => 'pending_approval',
        ]);

        $this->scanned_form = null;
        $this->step = 5;
    }

    public function editApplication(): void
    {
        $app = ThoGioiApplication::findOrFail($this->applicationId);

        $this->fill([
            'full_name'         => $app->full_name,
            'dharma_name'       => $app->dharma_name ?? '',
            'gender'            => $app->gender,
            'birth_date'        => $app->birth_date?->format('Y-m-d') ?? '',
            'id_card_number'    => $app->id_card_number ?? '',
            'native_place'      => $app->native_place ?? '',
            'permanent_address' => $app->permanent_address ?? '',
            'current_residence' => $app->current_residence ?? '',
            'education_level'   => $app->education_level ?? '',
            'buddhist_education'=> $app->buddhist_education ?? '',
            'ordain_date'       => $app->ordain_date?->format('Y-m-d') ?? '',
            'ordain_temple'     => $app->ordain_temple ?? '',
            'master_name'       => $app->master_name,
            'temple_name'       => $app->temple_name,
            'ordination_level'  => $app->ordination_level,
            'gioi_dan_id'       => $app->gioi_dan_id,
        ]);

        $this->step = 1;
    }

    public function getAvailableGioiDansProperty()
    {
        return GioiDan::where('status', 'open')->orderBy('start_date')->get();
    }

    public function getSelectedGioiDanProperty(): ?GioiDan
    {
        return $this->gioi_dan_id ? GioiDan::find($this->gioi_dan_id) : null;
    }

    public function render()
    {
        return view('livewire.registration-form');
    }
}
