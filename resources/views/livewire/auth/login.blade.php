<div>
    <div class="mb-8">
        <h2 class="text-2xl font-black text-gray-900">Đăng nhập</h2>
        <p class="mt-1 text-sm text-gray-500">Chào mừng bạn quay trở lại. Vui lòng đăng nhập để tiếp tục.</p>
    </div>

    <form wire:submit.prevent="login" class="space-y-5">

        {{-- Email --}}
        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">Địa chỉ Email</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                    </svg>
                </div>
                <input
                    wire:model="email"
                    id="email"
                    type="email"
                    placeholder="example@email.com"
                    autocomplete="email"
                    class="block w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl text-sm text-gray-900 placeholder-gray-400 bg-gray-50 focus:bg-white focus:border-amber-400 focus:ring-2 focus:ring-amber-100 transition-all"
                >
            </div>
            @error('email') <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                {{ $message }}
            </p> @enderror
        </div>

        {{-- Password --}}
        <div>
            <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5">Mật khẩu</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <input
                    wire:model="password"
                    id="password"
                    type="password"
                    placeholder="••••••••"
                    autocomplete="current-password"
                    class="block w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl text-sm text-gray-900 placeholder-gray-400 bg-gray-50 focus:bg-white focus:border-amber-400 focus:ring-2 focus:ring-amber-100 transition-all"
                >
            </div>
            @error('password') <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                {{ $message }}
            </p> @enderror
        </div>

        {{-- Remember me --}}
        <div class="flex items-center justify-between">
            <label class="flex items-center gap-2 cursor-pointer select-none">
                <input wire:model="remember" id="remember-me" type="checkbox"
                    class="w-4 h-4 rounded text-amber-500 border-gray-300 focus:ring-amber-400 cursor-pointer">
                <span class="text-sm text-gray-600">Ghi nhớ đăng nhập</span>
            </label>
        </div>

        {{-- Submit --}}
        <button
            type="submit"
            class="w-full flex items-center justify-center gap-2 py-3 px-4 rounded-xl text-sm font-bold text-white bg-amber-500 hover:bg-amber-600 active:bg-amber-700 shadow-md hover:shadow-lg transition-all focus:outline-none focus:ring-2 focus:ring-amber-400 focus:ring-offset-2"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
            </svg>
            Đăng nhập
        </button>

    </form>

    {{-- Divider --}}
    <div class="my-6 flex items-center gap-3">
        <div class="flex-1 h-px bg-gray-200"></div>
        <span class="text-xs text-gray-400">hoặc</span>
        <div class="flex-1 h-px bg-gray-200"></div>
    </div>

    {{-- Register link --}}
    <div class="text-center">
        <p class="text-sm text-gray-500">
            Chưa có tài khoản?
            <a href="{{ route('register') }}" class="font-semibold text-amber-600 hover:text-amber-500 transition-colors">
                Đăng ký ngay
            </a>
        </p>
    </div>

    {{-- Back to home --}}
    <div class="mt-4 text-center">
        <a href="/" class="inline-flex items-center gap-1 text-xs text-gray-400 hover:text-gray-600 transition-colors">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Quay về trang chủ
        </a>
    </div>
</div>
