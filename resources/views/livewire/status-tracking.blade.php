<div class="max-w-2xl mx-auto py-12 px-4">
    <div class="bg-white shadow-xl rounded-3xl overflow-hidden border border-amber-100">
        <div class="bg-amber-600 p-8 text-white text-center">
            <h2 class="text-2xl font-bold uppercase tracking-wide">Tra cứu hồ sơ</h2>
            <p class="text-amber-100 mt-2">Nhập số CCCD hoặc Mã hồ sơ để kiểm tra trạng thái</p>
        </div>

        <div class="p-8">
            <form wire:submit.prevent="track" class="space-y-4">
                <div class="relative">
                    <input type="text" wire:model.defer="search" 
                        placeholder="Ví dụ: 031095000123 hoặc 12" 
                        class="w-full pl-4 pr-12 py-4 bg-gray-50 border-2 border-gray-100 rounded-2xl focus:border-amber-500 focus:ring-0 transition-all text-lg">
                    <button type="submit" class="absolute right-3 top-3 bg-amber-600 text-white p-2 rounded-xl hover:bg-amber-700 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>
                </div>
                @error('search') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </form>

            @if($application)
                <div class="mt-10 p-6 rounded-2xl bg-amber-50 border border-amber-100 animate-in fade-in slide-in-from-bottom-4 duration-500">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h3 class="text-xl font-bold text-amber-900">{{ $application->full_name }}</h3>
                            <p class="text-amber-700 text-sm">Pháp danh: {{ $application->dharma_name ?: 'Chưa có' }}</p>
                        </div>
                        <span class="px-4 py-1 rounded-full text-xs font-bold uppercase tracking-wider 
                            @if($application->status == 'pending_document') bg-gray-100 text-gray-700
                            @elseif($application->status == 'pending_approval') bg-yellow-100 text-yellow-700
                            @elseif($application->status == 'approved') bg-blue-100 text-blue-700
                            @elseif($application->status == 'passed') bg-green-100 text-green-700
                            @else bg-red-100 text-red-700
                            @endif">
                            @if($application->status == 'pending_document') Chờ bổ sung bản scan
                            @elseif($application->status == 'pending_approval') Đang chờ duyệt
                            @elseif($application->status == 'approved') Đã duyệt (Được thọ giới)
                            @elseif($application->status == 'passed') Đã thọ giới (Cấp chứng điệp)
                            @else Từ chối
                            @endif
                        </span>
                    </div>

                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div class="text-gray-500">Mã hồ sơ:</div>
                        <div class="font-semibold text-gray-900">#{{ $application->id }}</div>
                        
                        <div class="text-gray-500">Giới phẩm:</div>
                        <div class="font-semibold text-gray-900">{{ $application->ordination_level }}</div>
                        
                        <div class="text-gray-500">Ngày đăng ký:</div>
                        <div class="font-semibold text-gray-900">{{ $application->created_at->format('d/m/Y') }}</div>

                        @if($application->certificate_id)
                        <div class="text-gray-500">Số Chứng điệp:</div>
                        <div class="font-bold text-amber-600">{{ $application->certificate_id }}</div>
                        @endif
                    </div>

                    @if($application->status == 'approved')
                    <div class="mt-6">
                        <a href="{{ route('application.print', $application) }}" target="_blank" 
                            class="block text-center w-full py-3 bg-amber-600 text-white rounded-xl font-bold hover:bg-amber-700 transition-shadow shadow-lg">
                            In Chứng Điệp / Hồ Sơ
                        </a>
                    </div>
                    @endif
                </div>
            @elseif($notFound)
                <div class="mt-10 text-center p-8 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200">
                    <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-400">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 9.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <p class="text-gray-600 font-medium">Không tìm thấy hồ sơ với thông tin trên.</p>
                    <p class="text-gray-400 text-sm mt-1">Vui lòng kiểm tra lại số CCCD hoặc Mã hồ sơ của bạn.</p>
                </div>
            @endif
        </div>
    </div>
</div>
