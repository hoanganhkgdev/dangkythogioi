<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Tra cứu Hồ sơ - GHPGVN</title>

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
                        <a href="/" class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-amber-600 rounded-full flex items-center justify-center text-white shadow-lg">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L4.5 20.29L5.21 21L12 18L18.79 21L19.5 20.29L12 2Z"/></svg>
                            </div>
                            <div>
                                <span class="text-lg font-bold text-amber-900 block leading-none tracking-tight">GHPGVN</span>
                                <span class="text-[8px] uppercase tracking-[2px] text-amber-600 font-bold">Ban Tăng Sự</span>
                            </div>
                        </a>
                    </div>
                    <div class="flex items-center gap-6">
                        <a href="/" class="text-sm font-semibold text-gray-600 hover:text-amber-600 transition-colors">Đăng ký</a>
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/admin') }}" class="text-sm font-semibold text-amber-900 hover:text-amber-600 transition-colors">Quản trị</a>
                            @else
                                <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-600 hover:text-amber-600 transition-colors">Đăng nhập</a>
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <main class="py-12">
            @livewire('status-tracking')
        </main>

        @livewireScripts
    </body>
</html>
