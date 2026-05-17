<div>

    {{-- ===== HERO SECTION ===== --}}
    <section class="relative overflow-hidden" style="background: linear-gradient(145deg, #f59e0b 0%, #d97706 50%, #b45309 100%)">
        {{-- Decorative circles --}}
        <div class="absolute -top-16 -right-16 w-72 h-72 rounded-full bg-white/10"></div>
        <div class="absolute -bottom-10 -left-10 w-56 h-56 rounded-full bg-white/10"></div>
        <div class="absolute top-1/2 left-1/3 w-32 h-32 rounded-full bg-white/5"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
            <div class="flex flex-col lg:flex-row items-center gap-8">

                {{-- Text --}}
                <div class="flex-1 text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 bg-white/20 rounded-full px-4 py-1.5 text-white text-xs font-semibold mb-4">
                        <span class="w-2 h-2 bg-green-300 rounded-full animate-pulse inline-block"></span>
                        Hệ thống đang mở đăng ký
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-black text-white leading-tight mb-3" style="text-shadow: 0 2px 12px rgba(0,0,0,0.2)">
                        Đăng ký Thọ Giới<br>
                        <span class="text-amber-100">Giáo hội Phật giáo Việt Nam</span>
                    </h1>
                    <p class="text-amber-100/90 text-base max-w-lg mx-auto lg:mx-0 leading-relaxed">
                        Chào mừng, <span class="font-bold text-white">{{ Auth::user()->name }}</span>.<br>
                        Chọn Giới Đàn phù hợp để bắt đầu khai báo hồ sơ đăng ký thọ giới.
                    </p>
                </div>

                {{-- Stats cards --}}
                <div class="flex gap-4 shrink-0">
                    <div class="bg-white/90 rounded-2xl px-6 py-4 text-center shadow-lg min-w-[110px]">
                        <div class="text-3xl font-black text-amber-700">{{ $this->totalOpen }}</div>
                        <div class="text-xs font-semibold text-gray-500 mt-1">Đang mở<br>đăng ký</div>
                    </div>
                    <div class="bg-white/90 rounded-2xl px-6 py-4 text-center shadow-lg min-w-[110px]">
                        <div class="text-3xl font-black text-blue-500">{{ $this->totalUpcoming }}</div>
                        <div class="text-xs font-semibold text-gray-500 mt-1">Sắp<br>diễn ra</div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- ===== ACTIVE APPLICATION BANNER ===== --}}
        @if($activeApplication)
        <div class="mb-8 relative overflow-hidden bg-gradient-to-r from-amber-50 to-orange-50 border border-amber-200 rounded-2xl p-5 flex flex-col sm:flex-row items-start sm:items-center gap-4 shadow-sm">
            <div class="absolute right-0 top-0 bottom-0 w-1 bg-amber-400 rounded-r-2xl"></div>
            <div class="w-12 h-12 rounded-xl bg-amber-100 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <div class="flex-1 min-w-0">
                <p class="font-bold text-amber-900 text-sm">Bạn đang có hồ sơ chưa hoàn tất</p>
                <p class="text-xs text-amber-700 mt-0.5 flex flex-wrap items-center gap-x-2">
                    <span>Hồ sơ <span class="font-bold">#{{ $activeApplication->id }}</span></span>
                    @if($activeApplication->gioiDan)
                        <span class="text-amber-400">·</span>
                        <span>{{ $activeApplication->gioiDan->name }}</span>
                    @endif
                    <span class="text-amber-400">·</span>
                    <span class="inline-flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full {{ $activeApplication->status === 'pending_document' ? 'bg-orange-400' : 'bg-blue-400' }} inline-block"></span>
                        {{ $activeApplication->status === 'pending_document' ? 'Chờ nộp bản scan' : 'Đang chờ duyệt' }}
                    </span>
                </p>
            </div>
            <a href="{{ route('dang-ky') }}"
               class="shrink-0 inline-flex items-center gap-2 px-5 py-2.5 text-white text-sm font-bold rounded-xl transition-all shadow-sm active:scale-95 hover:opacity-90" style="background: linear-gradient(135deg, #d97706, #b45309)">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
                Tiếp tục hồ sơ
            </a>
        </div>
        @endif

        {{-- Flash info --}}
        @if(session('info'))
        <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-xl flex items-center gap-3 text-sm text-blue-800">
            <svg class="w-5 h-5 text-blue-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('info') }}
        </div>
        @endif

        {{-- ===== SECTION HEADER + FILTER ===== --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
            <div>
                <h2 class="text-xl font-black text-gray-900">Giới Đàn đang mở đăng ký</h2>
                <p class="text-sm text-gray-500 mt-0.5">Chọn một Giới Đàn phù hợp để đăng ký hồ sơ thọ giới</p>
            </div>

            {{-- Tỉnh filter --}}
            @if($this->tinhs->isNotEmpty())
            <div class="flex items-center gap-2 flex-wrap">
                <button wire:click="$set('tinhFilter', null)"
                    class="px-3 py-1.5 rounded-full text-xs font-semibold transition-all
                        {{ $tinhFilter === null ? 'bg-amber-600 text-white shadow-sm' : 'bg-white text-gray-600 border border-gray-200 hover:border-amber-400' }}">
                    Tất cả
                </button>
                @foreach($this->tinhs as $tinh)
                <button wire:click="$set('tinhFilter', {{ $tinh->id }})"
                    class="px-3 py-1.5 rounded-full text-xs font-semibold transition-all
                        {{ $tinhFilter === $tinh->id ? 'bg-amber-600 text-white shadow-sm' : 'bg-white text-gray-600 border border-gray-200 hover:border-amber-400' }}">
                    {{ $tinh->name }}
                </button>
                @endforeach
            </div>
            @endif
        </div>

        {{-- ===== GIỚI ĐÀN CARDS ===== --}}
        @if($this->openGioiDans->isEmpty())
            <div class="flex flex-col items-center justify-center py-20 rounded-3xl bg-amber-50/50 border-2 border-dashed border-amber-200 text-center">
                <div class="w-16 h-16 rounded-full bg-amber-100 flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <p class="text-lg font-bold text-gray-700">Chưa có Giới Đàn nào đang mở đăng ký</p>
                <p class="text-sm text-gray-400 mt-1 max-w-sm">Vui lòng liên hệ Ban Tăng Sự để biết lịch tổ chức Giới Đàn sắp tới.</p>
                @if($tinhFilter)
                <button wire:click="$set('tinhFilter', null)"
                    class="mt-5 px-5 py-2 bg-amber-500 text-white text-sm font-semibold rounded-xl hover:bg-amber-600 transition-colors">
                    Xem tất cả tỉnh
                </button>
                @endif
            </div>
        @else
            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($this->openGioiDans as $gioiDan)
                <div class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200 flex flex-col overflow-hidden">

                    {{-- Card top accent --}}
                    <div class="h-1.5 w-full" style="background: linear-gradient(90deg, #f59e0b, #b45309)"></div>

                    {{-- Card body --}}
                    <div class="p-5 flex-1 flex flex-col">

                        {{-- Province badge + status --}}
                        <div class="flex items-center gap-2 mb-3">
                            @if($gioiDan->tinh)
                                <span class="inline-flex items-center gap-1 text-xs px-2.5 py-1 bg-amber-50 text-amber-700 rounded-full font-semibold border border-amber-100">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    </svg>
                                    {{ $gioiDan->tinh->name }}
                                </span>
                            @endif
                            <span class="ml-auto inline-flex items-center gap-1 text-xs px-2.5 py-1 bg-green-50 text-green-700 rounded-full font-semibold border border-green-100">
                                <span class="w-1.5 h-1.5 bg-green-500 rounded-full inline-block"></span>
                                Đang mở
                            </span>
                        </div>

                        {{-- Name --}}
                        <h3 class="text-base font-black text-gray-900 leading-snug mb-4 group-hover:text-amber-700 transition-colors">
                            {{ $gioiDan->name }}
                        </h3>

                        {{-- Info --}}
                        <div class="space-y-2 text-sm text-gray-500 mb-4">
                            <div class="flex items-start gap-2.5">
                                <svg class="w-4 h-4 text-amber-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span class="leading-snug">{{ $gioiDan->location }}</span>
                            </div>
                            <div class="flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-amber-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span>{{ $gioiDan->start_date->format('d/m/Y') }} – {{ $gioiDan->end_date->format('d/m/Y') }}</span>
                            </div>
                            @if($gioiDan->max_participants)
                            <div class="flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-amber-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span>Tối đa {{ number_format($gioiDan->max_participants) }} giới tử</span>
                            </div>
                            @endif
                        </div>


                    </div>

                    {{-- Card footer --}}
                    <div class="px-5 pb-5 pt-3 border-t border-gray-50">
                        <a href="{{ route('dang-ky', ['gioi_dan_id' => $gioiDan->id]) }}"
                           class="w-full flex items-center justify-center gap-2 py-2.5 text-white text-sm font-bold rounded-xl transition-all shadow-sm active:scale-[0.98] group-hover:shadow-md" style="background: linear-gradient(135deg, #d97706, #b45309)">
                            Đăng ký ngay
                            <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </a>
                    </div>

                </div>
                @endforeach
            </div>
        @endif

    </div>

</div>
