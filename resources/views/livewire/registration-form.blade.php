<div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    @guest
        <div class="bg-white shadow-2xl rounded-2xl overflow-hidden border border-amber-100 p-12 text-center">
            <div class="w-20 h-20 bg-amber-100 text-amber-600 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 00-2 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Vui lòng đăng nhập</h2>
            <p class="text-gray-600 mb-8">Bạn cần có tài khoản để thực hiện đăng ký thọ giới trực tuyến và theo dõi hồ sơ của mình.</p>
            <div class="flex justify-center gap-4">
                <a href="{{ route('login') }}" class="px-8 py-3 bg-amber-600 text-white rounded-xl font-bold hover:bg-amber-700 shadow-lg transition-all">Đăng nhập ngay</a>
                <a href="{{ url('/register') }}" class="px-8 py-3 bg-gray-100 text-gray-700 rounded-xl font-bold hover:bg-gray-200 transition-all">Đăng ký tài khoản</a>
            </div>
        </div>
    @else
    <div class="bg-white shadow-2xl rounded-2xl overflow-hidden border border-amber-100">
        <!-- Header -->
        <div class="bg-gradient-to-r from-amber-600 to-yellow-500 p-8 text-white text-center">
            <h2 class="text-3xl font-bold uppercase tracking-widest">Đăng Ký Thọ Giới</h2>
            <p class="mt-2 text-amber-50">Hệ thống quản lý hồ sơ Tăng Ni - GHPGVN</p>
        </div>

        <!-- Progress Bar -->
        <div class="px-8 pt-8">
            <div class="relative flex items-center justify-between">
                <div class="absolute left-0 top-1/2 w-full h-0.5 bg-gray-200 -translate-y-1/2"></div>
                <div class="absolute left-0 top-1/2 h-0.5 bg-amber-500 -translate-y-1/2 transition-all duration-500" style="width: {{ ($step - 1) * 25 }}%"></div>
                
                @foreach([1, 2, 3, 4, 5] as $s)
                <div class="relative z-10 flex flex-col items-center">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center border-2 transition-all duration-300 {{ $step >= $s ? 'bg-amber-500 border-amber-500 text-white shadow-lg' : 'bg-white border-gray-300 text-gray-400' }}">
                        @if($step > $s)
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        @else
                            {{ $s }}
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            <div class="flex justify-between mt-2 text-xs font-medium text-gray-500 uppercase tracking-tighter">
                <span>Cá nhân</span>
                <span>Tu học</span>
                <span>Đăng ký</span>
                <span>In & Ký</span>
                <span>Hoàn tất</span>
            </div>
        </div>

        <!-- Form content -->
        <div class="p-8">
            @if (session()->has('message'))
                <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700">
                    {{ session('message') }}
                </div>
            @endif

            @if($step == 1)
                <!-- Step 1: Personal Info -->
                <div class="space-y-6">
                    <h3 class="text-xl font-semibold text-amber-800 border-b border-amber-100 pb-2">Thông tin cá nhân (TN01)</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Họ và tên (Khai sinh)</label>
                            <input type="text" wire:model.live="full_name" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 sm:text-sm p-3">
                            @error('full_name') <span class="text-red-500 text-xs text-bold">Vui lòng nhập họ tên</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Pháp danh</label>
                            <input type="text" wire:model.live="dharma_name" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 sm:text-sm p-3">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Giới tính</label>
                            <select wire:model.live="gender" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 sm:text-sm p-3">
                                <option value="Nam">Nam</option>
                                <option value="Nữ">Nữ</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Ngày sinh</label>
                            <input type="date" wire:model.live="birth_date" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 sm:text-sm p-3">
                            @error('birth_date') <span class="text-red-500 text-xs font-bold">Vui lòng chọn ngày sinh</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Số CCCD/Hộ chiếu</label>
                            <input type="text" wire:model.live="id_card_number" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 sm:text-sm p-3">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Quê quán</label>
                            <input type="text" wire:model.live="native_place" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 sm:text-sm p-3">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Địa chỉ thường trú</label>
                            <input type="text" wire:model.live="permanent_address" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 sm:text-sm p-3">
                        </div>
                    </div>
                </div>
            @elseif($step == 2)
                <!-- Step 2: Education & Temple -->
                <div class="space-y-6">
                    <h3 class="text-xl font-semibold text-amber-800 border-b border-amber-100 pb-2">Trình độ & Quá trình tu học</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Trình độ văn hóa</label>
                            <input type="text" wire:model="education_level" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 sm:text-sm p-3">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Trình độ Phật học</label>
                            <input type="text" wire:model="buddhist_education" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 sm:text-sm p-3">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Ngày phát tâm (Xuất gia)</label>
                            <input type="date" wire:model="ordain_date" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 sm:text-sm p-3">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nơi phát tâm</label>
                            <input type="text" wire:model="ordain_temple" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 sm:text-sm p-3">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Hòa thượng Bổn sư</label>
                            <input type="text" wire:model="master_name" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 sm:text-sm p-3">
                            @error('master_name') <span class="text-red-500 text-xs font-bold">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Chùa/Cơ sở hiện tại</label>
                            <input type="text" wire:model="temple_name" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 sm:text-sm p-3">
                            @error('temple_name') <span class="text-red-500 text-xs font-bold">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            @elseif($step == 3)
                <!-- Step 3: Registration Level -->
                <div class="space-y-6">
                    <h3 class="text-xl font-semibold text-amber-800 border-b border-amber-100 pb-2">Đăng ký thọ giới</h3>
                    <div>
                        <label class="block text-lg font-medium text-gray-700 mb-4 text-center">Bạn muốn đăng ký thọ giới phẩm nào?</label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach(['Sa di', 'Tỳ kheo', 'Sa di ni', 'Tỳ kheo ni', 'Thức xoa', 'Bồ tát giới'] as $level)
                            <label class="flex items-center p-4 border rounded-xl cursor-pointer hover:bg-amber-50 transition-colors {{ $ordination_level == $level ? 'border-amber-500 bg-amber-50 ring-2 ring-amber-200' : 'border-gray-200' }}">
                                <input type="radio" wire:model.live="ordination_level" value="{{ $level }}" class="w-5 h-5 text-amber-600 border-gray-300 focus:ring-amber-500">
                                <span class="ml-3 font-medium text-gray-900">{{ $level }}</span>
                            </label>
                            @endforeach
                        </div>
                        @error('ordination_level') <p class="text-red-500 text-center mt-2">{{ $message }}</p> @enderror
                    </div>
                </div>
            @elseif($step == 4)
                <!-- Step 4: Print & Upload Instruction -->
                <div class="text-center py-6">
                    <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900">Thông tin đã được ghi nhận!</h3>
                    <p class="mt-4 text-gray-600 mb-8">Bây giờ bạn cần thực hiện các bước sau để hoàn thành thủ tục:</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                        <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100">
                            <span class="block text-2xl font-bold text-amber-600 mb-2">1. IN ĐƠN</span>
                            <p class="text-xs text-gray-500">In mẫu đơn TN01 từ hệ thống</p>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100">
                            <span class="block text-2xl font-bold text-amber-600 mb-2">2. XÁC NHẬN</span>
                            <p class="text-xs text-gray-500">Lấy chữ ký Bổn sư và dấu Ban Trị Sự</p>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100">
                            <span class="block text-2xl font-bold text-amber-600 mb-2">3. TẢI LÊN</span>
                            <p class="text-xs text-gray-500">Chụp ảnh/Scan và tải lên hệ thống</p>
                        </div>
                    </div>

                    <div class="flex justify-center gap-4 mb-10">
                        <a href="{{ route('application.print', $applicationId) }}" target="_blank" class="px-8 py-3 bg-amber-600 text-white rounded-xl font-bold hover:bg-amber-700 shadow-lg">In mẫu đơn TN01 (PDF)</a>
                        <button wire:click="editApplication" class="px-8 py-3 bg-gray-100 text-gray-700 rounded-xl font-bold hover:bg-gray-200 transition-all">Sửa lại thông tin</button>
                    </div>

                    <div class="max-w-md mx-auto p-6 bg-amber-50 rounded-2xl border-2 border-dashed border-amber-200">
                        <h4 class="font-bold text-amber-900 mb-4 uppercase">Tải lên bản quét có dấu</h4>
                        <input type="file" wire:model="scanned_form" class="hidden" id="file-upload">
                        <label for="file-upload" class="cursor-pointer block p-4 bg-white rounded-xl border border-amber-200 hover:bg-amber-100 transition-colors">
                            @if($scanned_form)
                                <span class="text-green-600 font-medium">Đã chọn: {{ $scanned_form->getClientOriginalName() }}</span>
                            @else
                                <span class="text-amber-700">Chọn ảnh hoặc PDF bản quét</span>
                            @endif
                        </label>
                        @error('scanned_form') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                        
                        <button wire:click="uploadDocument" wire:loading.attr="disabled" class="mt-4 w-full py-3 bg-green-600 text-white rounded-xl font-bold hover:bg-green-700 transition-all disabled:bg-gray-400">
                            <span wire:loading.remove>Gửi bản quét & Hoàn tất</span>
                            <span wire:loading>Đang tải lên...</span>
                        </button>
                    </div>
                </div>
            @elseif($step == 5)
                <!-- Final Step: Success -->
                <div class="text-center py-10">
                    <div class="w-20 h-20 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900">Nộp hồ sơ thành công!</h3>
                    <p class="mt-4 text-gray-600 max-w-sm mx-auto">Hồ sơ của bạn đã được chuyển đến Ban Trị Sự để chờ xét duyệt. Bạn có thể tra cứu trạng thái bất cứ lúc nào.</p>
                    <div class="mt-8 flex justify-center gap-4">
                        <a href="{{ route('application.track', ['search' => $applicationId]) }}" class="px-6 py-3 bg-amber-600 text-white rounded-lg font-bold hover:bg-amber-700 shadow-lg">Kiểm tra trạng thái</a>
                        <a href="/" class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg font-bold hover:bg-gray-200">Về trang chủ</a>
                    </div>
                </div>
            @endif

            <!-- Navigation Buttons -->
            @if($step < 4)
            <div class="mt-10 flex justify-between">
                @if($step > 1)
                    <button wire:click="prevStep" class="px-8 py-3 bg-gray-200 text-gray-700 rounded-xl font-bold hover:bg-gray-300 transition-all">Quay lại</button>
                @else
                    <div></div>
                @endif

                @if($step < 3)
                    <button wire:click="nextStep" class="px-8 py-3 bg-amber-600 text-white rounded-xl font-bold hover:bg-amber-700 shadow-lg transition-all">Tiếp tục</button>
                @else
                    <button wire:click="submit" class="px-10 py-3 bg-amber-600 text-white rounded-xl font-bold hover:bg-amber-700 shadow-xl transition-all">Gửi hồ sơ</button>
                @endif
            </div>
            @endif
        </div>
    </div>
    
    <div class="mt-8 text-center text-gray-400 text-xs">
        &copy; 2026 Giáo hội Phật giáo Việt Nam - Ban Tăng Sự Trung Ương
    </div>
    @endauth
</div>
