<div class="max-w-2xl mx-auto px-4">

    {{-- Search card --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

        <div class="p-6 border-b border-gray-50">
            <h2 class="text-lg font-black text-gray-900 mb-1">Kiểm tra trạng thái hồ sơ</h2>
            <p class="text-sm text-gray-500">Nhập số CCCD hoặc mã hồ sơ (số) của bạn</p>
        </div>

        <div class="p-6">
            <form wire:submit.prevent="track">
                <div class="flex gap-3">
                    <div class="relative flex-1">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <input
                            type="text"
                            wire:model="search"
                            placeholder="VD: 031095000123 hoặc mã số 12"
                            class="block w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl text-sm text-gray-900 placeholder-gray-400 bg-gray-50 focus:bg-white focus:border-amber-400 focus:ring-2 focus:ring-amber-100 transition-all outline-none"
                        >
                    </div>
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-5 py-3 text-white text-sm font-bold rounded-xl transition-all shadow-sm hover:opacity-90 active:scale-95"
                        style="background: linear-gradient(135deg, #d97706, #b45309)">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        Tra cứu
                    </button>
                </div>
                @error('search')
                    <p class="mt-2 text-xs text-red-500 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        {{ $message }}
                    </p>
                @enderror
            </form>
        </div>
    </div>

    {{-- Result --}}
    @if($application)
        @php
            $statusMap = [
                'pending_document' => ['label' => 'Chờ bổ sung bản scan', 'color' => 'bg-gray-100 text-gray-700', 'dot' => 'bg-gray-400'],
                'pending_approval' => ['label' => 'Đang chờ duyệt',       'color' => 'bg-yellow-100 text-yellow-700', 'dot' => 'bg-yellow-500'],
                'approved'         => ['label' => 'Đã duyệt – Được thọ giới', 'color' => 'bg-blue-100 text-blue-700', 'dot' => 'bg-blue-500'],
                'passed'           => ['label' => 'Đã thọ giới – Cấp chứng điệp', 'color' => 'bg-green-100 text-green-700', 'dot' => 'bg-green-500'],
                'rejected'         => ['label' => 'Từ chối',              'color' => 'bg-red-100 text-red-700', 'dot' => 'bg-red-500'],
            ];
            $s = $statusMap[$application->status] ?? ['label' => $application->status, 'color' => 'bg-gray-100 text-gray-600', 'dot' => 'bg-gray-400'];
        @endphp

        <div class="mt-5 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

            {{-- Top accent --}}
            <div class="h-1.5" style="background: linear-gradient(90deg, #f59e0b, #b45309)"></div>

            <div class="p-6">

                {{-- Name + status --}}
                <div class="flex items-start justify-between gap-4 mb-5">
                    <div>
                        <h3 class="text-xl font-black text-gray-900">{{ $application->full_name }}</h3>
                        <p class="text-sm text-gray-500 mt-0.5">Pháp danh: <span class="font-semibold text-gray-700">{{ $application->dharma_name ?: '—' }}</span></p>
                    </div>
                    <span class="shrink-0 inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold {{ $s['color'] }}">
                        <span class="w-1.5 h-1.5 rounded-full {{ $s['dot'] }} inline-block"></span>
                        {{ $s['label'] }}
                    </span>
                </div>

                {{-- Info grid --}}
                <div class="grid grid-cols-2 gap-x-6 gap-y-3 text-sm border-t border-gray-50 pt-5">
                    <div class="text-gray-500">Mã hồ sơ</div>
                    <div class="font-bold text-gray-900">#{{ $application->id }}</div>

                    <div class="text-gray-500">Giới phẩm</div>
                    <div class="font-semibold text-gray-900">{{ $application->ordination_level }}</div>

                    @if($application->gioiDan)
                    <div class="text-gray-500">Giới Đàn</div>
                    <div class="font-semibold text-gray-900">{{ $application->gioiDan->name }}</div>
                    @endif

                    <div class="text-gray-500">Ngày đăng ký</div>
                    <div class="font-semibold text-gray-900">{{ $application->created_at->format('d/m/Y') }}</div>

                    @if($application->certificate_id)
                    <div class="text-gray-500">Số chứng điệp</div>
                    <div class="font-black text-amber-700 text-base">{{ $application->certificate_id }}</div>
                    @endif
                </div>

                @if($application->status === 'approved')
                <div class="mt-6">
                    <a href="{{ route('application.print', $application) }}" target="_blank"
                       class="flex items-center justify-center gap-2 w-full py-3 text-white font-bold rounded-xl transition-all hover:opacity-90 active:scale-[0.98] shadow-sm"
                       style="background: linear-gradient(135deg, #d97706, #b45309)">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                        </svg>
                        In Chứng Điệp / Hồ Sơ
                    </a>
                </div>
                @endif

            </div>
        </div>

    @elseif($notFound)
        <div class="mt-5 flex flex-col items-center justify-center py-14 bg-white rounded-2xl border border-gray-100 shadow-sm text-center">
            <div class="w-14 h-14 rounded-full bg-gray-100 flex items-center justify-center mb-4">
                <svg class="w-7 h-7 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 9.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <p class="text-gray-700 font-bold">Không tìm thấy hồ sơ</p>
            <p class="text-gray-400 text-sm mt-1">Vui lòng kiểm tra lại số CCCD hoặc mã hồ sơ.</p>
        </div>
    @endif

</div>
