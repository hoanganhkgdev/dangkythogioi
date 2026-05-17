@php
    $field = 'w-full rounded-lg border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 transition focus:border-amber-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-amber-500/20';
@endphp

<div>
{{-- Hero strip --}}
<div class="py-8 text-center" style="background: linear-gradient(145deg, #f59e0b 0%, #d97706 50%, #b45309 100%)">
    <div class="w-14 h-14 rounded-full bg-white/20 flex items-center justify-center mx-auto mb-3">
        <span class="text-2xl font-black text-white">{{ mb_strtoupper(mb_substr(Auth::user()->name, 0, 1)) }}</span>
    </div>
    <h1 class="text-2xl font-black text-white" style="text-shadow: 0 2px 8px rgba(0,0,0,0.15)">Hồ sơ cá nhân</h1>
    <p class="text-amber-100/90 text-sm mt-1">{{ Auth::user()->email }}</p>
</div>

<div class="max-w-3xl mx-auto px-4 py-8 space-y-6">

    {{-- Success notices --}}
    @if($savedProfile)
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
         class="flex items-center gap-3 px-4 py-3 rounded-xl bg-green-50 border border-green-200 text-green-700 text-sm font-semibold">
        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        Đã lưu thông tin hồ sơ thành công!
    </div>
    @endif

    @if($savedPassword)
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
         class="flex items-center gap-3 px-4 py-3 rounded-xl bg-green-50 border border-green-200 text-green-700 text-sm font-semibold">
        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        Đã đổi mật khẩu thành công!
    </div>
    @endif

    {{-- Card: Hồ sơ đăng ký --}}
    @php
        $statusMap = [
            'pending_document' => ['label' => 'Chờ bổ sung bản scan', 'color' => 'bg-gray-100 text-gray-600',    'dot' => 'bg-gray-400'],
            'pending_approval' => ['label' => 'Đang chờ duyệt',       'color' => 'bg-yellow-100 text-yellow-700','dot' => 'bg-yellow-500'],
            'approved'         => ['label' => 'Đã duyệt',             'color' => 'bg-blue-100 text-blue-700',    'dot' => 'bg-blue-500'],
            'passed'           => ['label' => 'Đã thọ giới',          'color' => 'bg-green-100 text-green-700',  'dot' => 'bg-green-500'],
            'rejected'         => ['label' => 'Từ chối',              'color' => 'bg-red-100 text-red-700',      'dot' => 'bg-red-500'],
        ];
    @endphp
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background: linear-gradient(135deg, #f59e0b, #b45309)">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <div>
                    <h2 class="text-base font-bold text-gray-900">Hồ sơ đăng ký</h2>
                    <p class="text-xs text-gray-500">Lịch sử các lần đăng ký thọ giới</p>
                </div>
            </div>
            <a href="{{ route('home') }}"
               class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold text-white rounded-lg transition-all hover:opacity-90"
               style="background: linear-gradient(135deg, #d97706, #b45309)">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Đăng ký mới
            </a>
        </div>

        @if($this->applications->isEmpty())
            <div class="flex flex-col items-center justify-center py-12 text-center">
                <div class="w-14 h-14 rounded-full bg-gray-100 flex items-center justify-center mb-3">
                    <svg class="w-7 h-7 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <p class="text-gray-500 font-semibold text-sm">Chưa có hồ sơ nào</p>
                <p class="text-gray-400 text-xs mt-1">Chọn Giới Đàn để bắt đầu đăng ký</p>
            </div>
        @else
            <div class="divide-y divide-gray-50">
                @foreach($this->applications as $app)
                    @php $s = $statusMap[$app->status] ?? ['label' => $app->status, 'color' => 'bg-gray-100 text-gray-600', 'dot' => 'bg-gray-400']; @endphp
                    <div class="px-6 py-4 flex items-center gap-4 hover:bg-gray-50/60 transition-colors">

                        {{-- ID badge --}}
                        <div class="w-10 h-10 rounded-xl bg-amber-50 border border-amber-100 flex items-center justify-center shrink-0">
                            <span class="text-xs font-black text-amber-700">#{{ $app->id }}</span>
                        </div>

                        {{-- Info --}}
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 flex-wrap">
                                <span class="font-bold text-gray-900 text-sm">{{ $app->gioiDan->name ?? '—' }}</span>
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-semibold {{ $s['color'] }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $s['dot'] }} inline-block"></span>
                                    {{ $s['label'] }}
                                </span>
                            </div>
                            <div class="mt-0.5 flex items-center gap-3 text-xs text-gray-400">
                                <span>{{ $app->ordination_level }}</span>
                                <span>·</span>
                                <span>Nộp {{ $app->created_at->format('d/m/Y') }}</span>
                                @if($app->certificate_id)
                                    <span>·</span>
                                    <span class="font-semibold text-amber-600">Chứng điệp: {{ $app->certificate_id }}</span>
                                @endif
                            </div>
                        </div>

                        {{-- Actions --}}
                        <div class="flex items-center gap-2 shrink-0">
                            @if($app->status === 'pending_document')
                                <a href="{{ route('dang-ky', ['gioi_dan_id' => $app->gioi_dan_id]) }}"
                                   class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-semibold text-amber-700 bg-amber-50 hover:bg-amber-100 rounded-lg transition-all border border-amber-200">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                                    Nộp bổ sung
                                </a>
                                <button wire:click="cancelApplication({{ $app->id }})"
                                        wire:confirm="Bạn có chắc muốn huỷ hồ sơ #{{ $app->id }}?"
                                        class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-semibold text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition-all border border-red-200">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                    Huỷ
                                </button>
                            @elseif(in_array($app->status, ['approved', 'passed']))
                                <a href="{{ route('application.print', $app) }}" target="_blank"
                                   class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-semibold text-blue-700 bg-blue-50 hover:bg-blue-100 rounded-lg transition-all border border-blue-200">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                                    In hồ sơ
                                </a>
                            @else
                                <a href="{{ route('application.track') }}?search={{ $app->id }}"
                                   class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-semibold text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-lg transition-all">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                                    Tra cứu
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Card: Thông tin tài khoản + cá nhân --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background: linear-gradient(135deg, #f59e0b, #b45309)">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            </div>
            <div>
                <h2 class="text-base font-bold text-gray-900">Thông tin cá nhân</h2>
                <p class="text-xs text-gray-500">Thông tin sẽ được tự điền vào form đăng ký</p>
            </div>
        </div>

        <form wire:submit.prevent="saveProfile" class="p-6 space-y-5">
            {{-- Tài khoản --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Họ và tên <span class="text-red-400">*</span></label>
                    <input type="text" wire:model="name" placeholder="Nguyễn Văn A" class="{{ $field }}">
                    @error('name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Pháp danh</label>
                    <input type="text" wire:model="dharma_name" placeholder="Thích ..." class="{{ $field }}">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Email <span class="text-red-400">*</span></label>
                    <input type="email" wire:model="email" class="{{ $field }}">
                    @error('email') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Số điện thoại</label>
                    <input type="text" wire:model="phone" placeholder="0901234567" class="{{ $field }}">
                </div>
            </div>

            <hr class="border-gray-100">

            {{-- Giới tính + ngày sinh --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Giới tính</label>
                    <div class="flex gap-3">
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
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Ngày sinh</label>
                    <input type="date" wire:model="birth_date" class="{{ $field }}">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Số CCCD / Hộ chiếu</label>
                    <input type="text" wire:model="id_card_number" placeholder="079123456789" class="{{ $field }}">
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

            <hr class="border-gray-100">

            {{-- Thông tin tu học --}}
            <div>
                <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-4">Quá trình tu học</p>
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
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Hòa thượng Bổn sư</label>
                        <input type="text" wire:model="master_name" placeholder="Pháp danh Bổn sư" class="{{ $field }}">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Chùa / Cơ sở hiện tại</label>
                        <input type="text" wire:model="temple_name" placeholder="Tên chùa đang tu học" class="{{ $field }}">
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-2">
                <button type="submit"
                    wire:loading.attr="disabled"
                    class="inline-flex items-center gap-2 px-6 py-2.5 text-white text-sm font-bold rounded-xl transition-all shadow-sm hover:opacity-90 disabled:opacity-60"
                    style="background: linear-gradient(135deg, #d97706, #b45309)">
                    <span wire:loading.remove>
                        <svg class="w-4 h-4 inline -mt-0.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Lưu thông tin
                    </span>
                    <span wire:loading class="flex items-center gap-2">
                        <svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                        Đang lưu...
                    </span>
                </button>
            </div>
        </form>
    </div>

    {{-- Card: Đổi mật khẩu --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center">
                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
            </div>
            <h2 class="text-base font-bold text-gray-900">Đổi mật khẩu</h2>
        </div>

        <form wire:submit.prevent="savePassword" class="p-6">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Mật khẩu hiện tại</label>
                    <input type="password" wire:model="current_password" class="{{ $field }}">
                    @error('current_password') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Mật khẩu mới</label>
                    <input type="password" wire:model="new_password" class="{{ $field }}">
                    @error('new_password') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Xác nhận mật khẩu</label>
                    <input type="password" wire:model="new_password_confirmation" class="{{ $field }}">
                </div>
            </div>
            <div class="flex justify-end mt-4">
                <button type="submit"
                    wire:loading.attr="disabled"
                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-gray-800 text-white text-sm font-bold rounded-xl hover:bg-gray-700 transition-all disabled:opacity-60">
                    <span wire:loading.remove>Đổi mật khẩu</span>
                    <span wire:loading class="flex items-center gap-2">
                        <svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                        Đang lưu...
                    </span>
                </button>
            </div>
        </form>
    </div>

</div>
</div>
