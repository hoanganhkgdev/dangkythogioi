<div class="bg-white py-8 px-4 shadow-2xl rounded-3xl sm:px-10 border border-amber-100">
    <div class="mb-8 text-center">
        <h2 class="text-3xl font-extrabold text-gray-900">Tạo tài khoản</h2>
        <p class="mt-2 text-sm text-gray-600">
            Để bắt đầu đăng ký thọ giới trực tuyến
        </p>
    </div>

    <form wire:submit.prevent="register" class="space-y-6">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Họ và tên</label>
            <div class="mt-1">
                <input wire:model="name" id="name" type="text" required class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-amber-500 focus:border-amber-500 sm:text-sm">
            </div>
            @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Địa chỉ Email</label>
            <div class="mt-1">
                <input wire:model="email" id="email" type="email" required class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-amber-500 focus:border-amber-500 sm:text-sm">
            </div>
            @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Mật khẩu</label>
            <div class="mt-1">
                <input wire:model="password" id="password" type="password" required class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-amber-500 focus:border-amber-500 sm:text-sm">
            </div>
            @error('password') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Xác nhận mật khẩu</label>
            <div class="mt-1">
                <input wire:model="password_confirmation" id="password_confirmation" type="password" required class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-amber-500 focus:border-amber-500 sm:text-sm">
            </div>
        </div>

        <div>
            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-lg text-sm font-bold text-white bg-amber-600 hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition-all">
                Đăng ký tài khoản
            </button>
        </div>
    </form>

    <div class="mt-6 text-center">
        <p class="text-sm text-gray-600">
            Đã có tài khoản? 
            <a href="{{ route('login') }}" class="font-medium text-amber-600 hover:text-amber-500">Đăng nhập</a>
        </p>
    </div>
</div>
