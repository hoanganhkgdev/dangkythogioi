<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Hệ thống Đăng ký Thọ giới - GHPGVN</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

        <!-- Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com"></script>
        
        @livewireStyles
        <style>
            body { font-family: 'Inter', sans-serif; }
            h1, h2, h3 { font-family: 'Playfair Display', serif; }
            .bg-pattern {
                background-color: #f8fafc;
                background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23d97706' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            }
        </style>
    </head>
    <body class="bg-pattern min-h-screen">
        <!-- Navigation -->
        <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-amber-100 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20">
                    <div class="flex items-center gap-4">
                        <img src="{{ asset('logo-ghpgvn.png') }}" alt="GHPGVN" class="w-12 h-12 object-contain">
                        <div>
                            <span class="text-xl font-bold text-amber-900 block leading-none tracking-tight">GHPGVN</span>
                            <span class="text-[10px] uppercase tracking-[3px] text-amber-600 font-bold">Ban Tăng Sự</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-6">
                        <a href="{{ route('application.track') }}" class="text-sm font-semibold text-gray-600 hover:text-amber-600 transition-colors">Tra cứu hồ sơ</a>
                        @if (Route::has('login'))
                            @auth
                                <form method="POST" action="{{ route('logout') }}" class="inline">
                                    @csrf
                                    <button type="submit" class="text-sm font-semibold text-red-600 hover:text-red-500 transition-colors">Đăng xuất</button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-600 hover:text-amber-600 transition-colors">Đăng nhập</a>
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="py-12 bg-gradient-to-b from-amber-50 to-transparent">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-4xl md:text-5xl font-bold text-amber-900 mb-4">Cổng Đăng Ký Thọ Giới Trực Tuyến</h1>
                <p class="text-lg text-amber-700 max-w-2xl mx-auto">Tạo điều kiện thuận lợi cho chư Tăng Ni các tỉnh thành thực hiện thủ tục thọ giới đúng thời gian và đúng quy định của Giáo hội.</p>
            </div>
        </div>

        <!-- Main Form -->
        <div class="pb-20">
            @livewire('registration-form')
        </div>

        @livewireScripts
    </body>
</html>
