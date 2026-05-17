@php
    $field = 'w-full rounded-lg border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 transition focus:border-amber-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-amber-500/20';
    $steps = [
        1 => ['label' => 'Cá nhân',  'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'],
        2 => ['label' => 'Tu học',   'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
        3 => ['label' => 'Giới phẩm', 'icon' => 'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z'],
        4 => ['label' => 'Nộp hồ sơ','icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
        5 => ['label' => 'Hoàn tất', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
    ];
@endphp

<div class="min-h-screen bg-gradient-to-br from-amber-50 via-white to-yellow-50/30 py-10 px-4">

    @guest
    {{-- Chưa đăng nhập --}}
    <div class="max-w-md mx-auto">
        <div class="text-center mb-8">
            <img src="{{ asset('logo-ghpgvn.png') }}" alt="GHPGVN" class="w-16 h-16 object-contain mx-auto mb-4">
            <h2 class="text-2xl font-bold text-gray-900">Đăng nhập để tiếp tục</h2>
            <p class="mt-2 text-sm text-gray-500">Bạn cần tài khoản để đăng ký thọ giới và theo dõi hồ sơ</p>
        </div>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 flex flex-col gap-3">
            <a href="{{ route('login') }}" class="w-full text-center py-3 bg-amber-600 text-white rounded-xl font-semibold hover:bg-amber-700 transition-all shadow-sm">Đăng nhập</a>
            <a href="{{ route('register') }}" class="w-full text-center py-3 bg-gray-50 text-gray-700 rounded-xl font-semibold hover:bg-gray-100 transition-all border border-gray-200">Tạo tài khoản mới</a>
        </div>
    </div>
    @else

    <div class="max-w-5xl mx-auto">

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden flex flex-col md:flex-row">

            {{-- Sidebar Steps --}}
            <div class="md:w-56 lg:w-64 bg-gray-50 border-b md:border-b-0 md:border-r border-gray-100 p-6 flex md:flex-col gap-2 overflow-x-auto md:overflow-visible">
                <div class="hidden md:block text-xs font-semibold text-gray-400 uppercase tracking-widest mb-2 px-2">Các bước</div>
                @foreach($steps as $s => $info)
                <button
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all text-left shrink-0 w-full
                        {{ $step === $s ? 'bg-amber-600 text-white shadow-sm' : ($step > $s ? 'text-gray-400' : 'text-gray-500 hover:bg-gray-100') }}"
                    disabled
                >
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0
                        {{ $step === $s ? 'bg-white/20' : ($step > $s ? 'bg-gray-100' : 'bg-white border border-gray-200') }}">
                        @if($step > $s)
                            <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        @else
                            <svg class="w-4 h-4 {{ $step === $s ? 'text-white' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="{{ $info['icon'] }}"/>
                            </svg>
                        @endif
                    </div>
                    <span class="text-sm font-medium hidden md:block whitespace-nowrap">{{ $info['label'] }}</span>
                </button>
                @endforeach

                {{-- User info --}}
                <div class="hidden md:flex items-center gap-2 mt-auto pt-6 border-t border-gray-200">
                    <div class="w-8 h-8 rounded-full bg-amber-100 flex items-center justify-center text-amber-700 font-bold text-sm shrink-0">
                        {{ mb_substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs font-semibold text-gray-700 truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-400 truncate">{{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>

            {{-- Main Content --}}
            <div class="flex-1 p-6 lg:p-10">

                {{-- Step 1 --}}
                @if($step === 1)
                <div wire:key="step-1">
                    <div class="mb-6">
                        <h2 class="text-xl font-bold text-gray-900">Thông tin cá nhân</h2>
                        <p class="text-sm text-gray-500 mt-1">Nhập thông tin theo giấy khai sinh / CCCD</p>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="sm:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Họ và tên <span class="text-red-400">*</span></label>
                                <input type="text" wire:model="full_name" placeholder="Nguyễn Văn A" class="{{ $field }}">
                                @error('full_name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Pháp danh</label>
                                <input type="text" wire:model="dharma_name" placeholder="Thích ..." class="{{ $field }}">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Giới tính</label>
                            <div class="flex gap-3 mt-1">
                                @foreach(['Nam', 'Nữ'] as $g)
                                <label class="flex-1 flex items-center justify-center gap-2 py-2.5 rounded-lg border cursor-pointer transition-all text-sm font-medium
                                    {{ $gender === $g ? 'border-amber-500 bg-amber-50 text-amber-700' : 'border-gray-200 bg-gray-50 text-gray-600 hover:border-gray-300' }}">
                                    <input type="radio" wire:model.live="gender" value="{{ $g }}" class="sr-only">
                                    {{ $g }}
                                </label>
                                @endforeach
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Ngày sinh <span class="text-red-400">*</span></label>
                            <input type="date" wire:model="birth_date" class="{{ $field }}">
                            @error('birth_date') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Số CCCD / Hộ chiếu</label>
                            <input type="text" wire:model="id_card_number" placeholder="VD: 079123456789" class="{{ $field }}">
                            <p class="mt-1 text-xs text-gray-400">Số trên thẻ Căn cước công dân (12 chữ số)</p>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Quê quán</label>
                            <input type="text" wire:model="native_place" placeholder="Tỉnh / Thành phố" class="{{ $field }}">
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Địa chỉ thường trú</label>
                            <input type="text" wire:model="permanent_address" placeholder="Số nhà, đường, phường/xã, quận/huyện, tỉnh/thành" class="{{ $field }}">
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Nơi ở hiện tại</label>
                            <input type="text" wire:model="current_residence" placeholder="Để trống nếu giống thường trú" class="{{ $field }}">
                        </div>
                    </div>
                </div>

                {{-- Step 2 --}}
                @elseif($step === 2)
                <div wire:key="step-2">
                    <div class="mb-6">
                        <h2 class="text-xl font-bold text-gray-900">Trình độ & Quá trình tu học</h2>
                        <p class="text-sm text-gray-500 mt-1">Thông tin về quá trình xuất gia và tu học</p>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Trình độ văn hóa</label>
                            <input type="text" wire:model="education_level" placeholder="VD: Đại học" class="{{ $field }}">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Trình độ Phật học</label>
                            <input type="text" wire:model="buddhist_education" placeholder="VD: Trung cấp Phật học" class="{{ $field }}">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Ngày xuất gia</label>
                            <input type="date" wire:model="ordain_date" class="{{ $field }}">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Nơi xuất gia</label>
                            <input type="text" wire:model="ordain_temple" placeholder="Tên chùa, tỉnh/thành" class="{{ $field }}">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Hòa thượng Bổn sư <span class="text-red-400">*</span></label>
                            <input type="text" wire:model="master_name" placeholder="Pháp danh Bổn sư" class="{{ $field }}">
                            @error('master_name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Chùa / Cơ sở hiện tại <span class="text-red-400">*</span></label>
                            <input type="text" wire:model="temple_name" placeholder="Tên chùa đang tu học" class="{{ $field }}">
                            @error('temple_name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                {{-- Step 3 --}}
                @elseif($step === 3)
                <div wire:key="step-3" class="space-y-6">
                    {{-- Giới đàn đã chọn (read-only) --}}
                    @if($this->selectedGioiDan)
                    <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-amber-50 border border-amber-200">
                        <svg class="w-5 h-5 text-amber-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs text-amber-600 font-semibold uppercase tracking-wide">Giới Đàn đã chọn</p>
                            <p class="text-sm font-bold text-amber-900">{{ $this->selectedGioiDan->name }}</p>
                        </div>
                        <a href="{{ route('home') }}" class="text-xs text-amber-600 hover:text-amber-800 underline shrink-0">Đổi</a>
                    </div>
                    @endif

                    {{-- Chọn giới phẩm --}}
                    <div>
                        <div class="mb-4">
                            <h2 class="text-xl font-bold text-gray-900">Giới phẩm <span class="text-red-400 text-base">*</span></h2>
                            <p class="text-sm text-gray-500 mt-1">
                                @if($this->selectedGioiDan)
                                    Chọn giới phẩm bạn muốn thọ tại <strong>{{ $this->selectedGioiDan->name }}</strong>
                                @endif
                            </p>
                        </div>

                        @if($this->selectedGioiDan)
                            @php $levels = $this->selectedGioiDan->ordination_levels ?? []; @endphp
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-2.5">
                                @foreach($levels as $level)
                                <label class="group flex flex-col items-center gap-2 p-4 rounded-2xl border-2 cursor-pointer transition-all
                                    {{ $ordination_level === $level ? 'border-amber-500 bg-amber-50' : 'border-gray-100 bg-gray-50 hover:border-amber-200 hover:bg-amber-50/40' }}">
                                    <input type="radio" wire:model.live="ordination_level" value="{{ $level }}" class="sr-only">
                                    <div class="w-10 h-10 rounded-xl flex items-center justify-center transition-all
                                        {{ $ordination_level === $level ? 'bg-amber-500 text-white' : 'bg-white text-gray-400 border border-gray-200 group-hover:border-amber-300' }}">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                                    </div>
                                    <span class="text-sm font-semibold {{ $ordination_level === $level ? 'text-amber-700' : 'text-gray-700' }}">{{ $level }}</span>
                                </label>
                                @endforeach
                            </div>
                        @endif
                        @error('ordination_level') <p class="mt-2 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- Step 4 --}}
                @elseif($step === 4)
                <div wire:key="step-4">
                    <div class="mb-6">
                        <h2 class="text-xl font-bold text-gray-900">Nộp hồ sơ</h2>
                        <p class="text-sm text-gray-500 mt-1">Thông tin đã được ghi nhận. Hoàn tất bằng cách nộp bản quét đơn có chữ ký.</p>
                    </div>

                    {{-- 3 steps instruction --}}
                    <div class="grid grid-cols-3 gap-3 mb-8">
                        @foreach([
                            ['bg-blue-50 text-blue-600 border-blue-100', 'M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z', '1. In đơn', 'In mẫu TN01'],
                            ['bg-amber-50 text-amber-600 border-amber-100', 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', '2. Xác nhận', 'Lấy chữ ký & dấu'],
                            ['bg-green-50 text-green-600 border-green-100', 'M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12', '3. Tải lên', 'Nộp bản quét'],
                        ] as [$cls, $path, $title, $desc])
                        <div class="flex flex-col items-center text-center gap-2 p-4 rounded-2xl border {{ $cls }}">
                            <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center shadow-sm border {{ $cls }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="{{ $path }}"/></svg>
                            </div>
                            <span class="text-xs font-bold">{{ $title }}</span>
                            <span class="text-xs opacity-70">{{ $desc }}</span>
                        </div>
                        @endforeach
                    </div>

                    <div class="flex flex-wrap gap-3 mb-8">
                        <a href="{{ route('application.print', $applicationId) }}" target="_blank"
                           class="inline-flex items-center gap-2 px-5 py-2.5 bg-amber-600 text-white rounded-xl text-sm font-semibold hover:bg-amber-700 shadow-sm transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                            In mẫu đơn TN01
                        </a>
                        <button wire:click="editApplication"
                                class="inline-flex items-center gap-2 px-5 py-2.5 bg-gray-100 text-gray-700 rounded-xl text-sm font-semibold hover:bg-gray-200 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            Sửa thông tin
                        </button>
                    </div>

                    {{-- Upload zone --}}
                    <div class="rounded-2xl border-2 border-dashed border-gray-200 bg-gray-50 p-6">
                        <h3 class="text-sm font-semibold text-gray-700 mb-4">Tải lên bản quét đơn đã ký & đóng dấu</h3>
                        <input type="file" wire:model="scanned_form" id="file-upload" class="sr-only" accept=".jpg,.jpeg,.png,.pdf">
                        <label for="file-upload" class="group flex flex-col items-center justify-center gap-3 p-8 rounded-xl border-2 border-dashed cursor-pointer transition-all
                            {{ $scanned_form ? 'border-green-400 bg-green-50' : 'border-gray-200 hover:border-amber-400 hover:bg-amber-50/30' }}">
                            @if($scanned_form)
                                <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span class="text-sm font-semibold text-green-700">{{ $scanned_form->getClientOriginalName() }}</span>
                                <span class="text-xs text-green-500">Nhấn để chọn file khác</span>
                            @else
                                <svg class="w-10 h-10 text-gray-300 group-hover:text-amber-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                                <div class="text-center">
                                    <span class="text-sm font-semibold text-gray-600">Chọn file hoặc kéo thả vào đây</span>
                                    <p class="text-xs text-gray-400 mt-1">JPG, PNG hoặc PDF · Tối đa 10MB</p>
                                </div>
                            @endif
                        </label>
                        <div wire:loading wire:target="scanned_form" class="mt-3 flex items-center gap-2 text-xs text-amber-600">
                            <svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                            Đang xử lý...
                        </div>
                        @error('scanned_form') <p class="mt-2 text-xs text-red-500">{{ $message }}</p> @enderror

                        <button wire:click="uploadDocument" wire:loading.attr="disabled" wire:target="uploadDocument"
                                class="mt-4 w-full py-3 bg-green-600 text-white rounded-xl text-sm font-bold hover:bg-green-700 transition-all disabled:opacity-50 flex items-center justify-center gap-2">
                            <span wire:loading.remove wire:target="uploadDocument">
                                <svg class="w-4 h-4 inline -mt-0.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Xác nhận & Hoàn tất nộp hồ sơ
                            </span>
                            <span wire:loading wire:target="uploadDocument" class="flex items-center gap-2">
                                <svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                                Đang tải lên...
                            </span>
                        </button>
                    </div>
                </div>

                {{-- Step 5 --}}
                @elseif($step === 5)
                <div wire:key="step-5" class="flex flex-col items-center justify-center py-10 text-center">
                    <div class="relative mb-6">
                        <div class="w-20 h-20 rounded-full bg-green-100 flex items-center justify-center">
                            <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div class="absolute -right-1 -top-1 w-6 h-6 rounded-full bg-amber-400 border-2 border-white flex items-center justify-center">
                            <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        </div>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">Nộp hồ sơ thành công!</h2>
                    <p class="mt-3 text-gray-500 max-w-sm">Hồ sơ của bạn đã được gửi đến Ban Trị Sự. Bạn sẽ được thông báo khi có kết quả xét duyệt.</p>

                    <div class="mt-6 px-5 py-3 bg-amber-50 border border-amber-200 rounded-2xl text-sm text-amber-800">
                        <span class="font-semibold">Mã hồ sơ:</span> #{{ $applicationId }}
                    </div>

                    <div class="mt-8 flex flex-wrap justify-center gap-3">
                        <a href="{{ route('application.track') }}"
                           class="inline-flex items-center gap-2 px-6 py-2.5 bg-amber-600 text-white rounded-xl font-semibold text-sm hover:bg-amber-700 shadow-sm transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            Tra cứu hồ sơ
                        </a>
                        <a href="/"
                           class="inline-flex items-center gap-2 px-6 py-2.5 bg-gray-100 text-gray-700 rounded-xl font-semibold text-sm hover:bg-gray-200 transition-all">
                            Về trang chủ
                        </a>
                    </div>
                </div>
                @endif

                {{-- Navigation --}}
                @if($step < 4)
                <div class="mt-8 pt-6 border-t border-gray-100 flex items-center justify-between">
                    @if($step > 1)
                        <button wire:click="prevStep"
                                class="inline-flex items-center gap-2 px-5 py-2.5 bg-gray-100 text-gray-700 rounded-xl text-sm font-semibold hover:bg-gray-200 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                            Quay lại
                        </button>
                    @else
                        <div></div>
                    @endif

                    @if($step < 3)
                        <button wire:click="nextStep"
                                class="inline-flex items-center gap-2 px-6 py-2.5 bg-amber-600 text-white rounded-xl text-sm font-semibold hover:bg-amber-700 shadow-sm transition-all">
                            Tiếp tục
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </button>
                    @else
                        <button wire:click="submit" wire:loading.attr="disabled" wire:target="submit"
                                class="inline-flex items-center gap-2 px-7 py-2.5 bg-amber-600 text-white rounded-xl text-sm font-bold hover:bg-amber-700 shadow-sm transition-all disabled:opacity-60">
                            <span wire:loading.remove wire:target="submit">
                                Gửi hồ sơ
                                <svg class="w-4 h-4 inline ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                            </span>
                            <span wire:loading wire:target="submit" class="flex items-center gap-2">
                                <svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                                Đang lưu...
                            </span>
                        </button>
                    @endif
                </div>
                @endif

            </div>{{-- end main content --}}
        </div>{{-- end card --}}

        <p class="mt-6 text-center text-xs text-gray-400">
            &copy; {{ date('Y') }} Giáo hội Phật giáo Việt Nam · Ban Tăng Sự Trung Ương
        </p>
    </div>
    @endauth
</div>
