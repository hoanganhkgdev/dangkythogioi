<div class="bg-white py-8 px-4 shadow-2xl rounded-3xl sm:px-10 border border-amber-100">
    <div class="mb-8 text-center">
        <h2 class="text-3xl font-extrabold text-gray-900">Đăng nhập</h2>
        <p class="mt-2 text-sm text-gray-600">
            Chào mừng bạn quay trở lại
        </p>
    </div>

    <form wire:submit.prevent="login" class="space-y-6">
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

        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <input wire:model="remember" id="remember-me" type="checkbox" class="h-4 w-4 text-amber-600 focus:ring-amber-500 border-gray-300 rounded">
                <label for="remember-me" class="ml-2 block text-sm text-gray-900">Ghi nhớ đăng nhập</label>
            </div>
        </div>

        <div>
            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-lg text-sm font-bold text-white bg-amber-600 hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition-all">
                Đăng nhập
            </button>
        </div>
    </form>

    <div class="mt-6 text-center">
        <p class="text-sm text-gray-600">
            Chưa có tài khoản? 
            <a href="{{ route('register') }}" class="font-medium text-amber-600 hover:text-amber-500">Đăng ký ngay</a>
        </p>
    </div>
</div>
