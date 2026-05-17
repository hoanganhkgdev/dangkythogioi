<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Đăng Ký Thọ Giới – GHPGVN</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,700&display=swap" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
        @livewireStyles
        <style>
            body { font-family: 'Roboto Condensed', sans-serif; }
            .bg-pattern {
                background-color: #f8fafc;
                background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23d97706' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            }
        </style>
    </head>
    <body class="bg-pattern min-h-screen flex flex-col">

        {{-- Header --}}
        <header class="sticky top-0 z-50 shadow-lg" style="background: linear-gradient(145deg, #f59e0b 0%, #d97706 50%, #b45309 100%)">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center h-[72px] gap-6">

                    <a href="{{ route('home') }}" class="shrink-0 group">
                        <img src="{{ asset('logo-ghpgvn.png') }}" alt="Giáo Hội Phật Giáo Việt Nam"
                             class="h-12 w-auto object-contain group-hover:opacity-90 transition-opacity drop-shadow-sm">
                    </a>

                    <div class="hidden sm:block w-px h-8 bg-white/20 shrink-0"></div>

                    <nav class="hidden md:flex items-center gap-1 flex-1">
                        <a href="{{ route('home') }}"
                           class="px-3 py-2 rounded-lg text-sm font-semibold text-amber-100 hover:bg-white/10 hover:text-white transition-all">
                            Trang chủ
                        </a>
                        <a href="{{ route('application.track') }}"
                           class="px-3 py-2 rounded-lg text-sm font-semibold text-amber-100 hover:bg-white/10 hover:text-white transition-all">
                            Tra cứu hồ sơ
                        </a>
                    </nav>

                    <div class="ml-auto flex items-center gap-3 shrink-0">
                        @auth
                            <div class="hidden sm:flex items-center gap-2.5 bg-white/15 rounded-xl px-3 py-1.5">
                                <div class="w-7 h-7 rounded-full bg-white/30 flex items-center justify-center text-white font-bold text-xs shrink-0">
                                    {{ mb_strtoupper(mb_substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <span class="text-white text-sm font-semibold max-w-[120px] truncate">{{ Auth::user()->name }}</span>
                            </div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="inline-flex items-center gap-1.5 bg-white/15 hover:bg-white/25 text-white text-xs font-semibold px-3 py-2 rounded-lg transition-all border border-white/20">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    Đăng xuất
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}"
                               class="inline-flex items-center gap-1.5 bg-white text-amber-700 hover:bg-amber-50 text-sm font-bold px-4 py-2 rounded-lg transition-all shadow-sm">
                                Đăng nhập
                            </a>
                        @endauth
                    </div>

                </div>
            </div>
        </header>

        {{-- Hero strip --}}
        <div class="py-8 text-center" style="background: linear-gradient(145deg, #f59e0b 0%, #d97706 50%, #b45309 100%)">
            <h1 class="text-2xl sm:text-3xl font-black text-white" style="text-shadow: 0 2px 8px rgba(0,0,0,0.15)">Đăng ký Thọ Giới</h1>
            <p class="text-amber-100/90 text-sm mt-1">Giáo Hội Phật Giáo Việt Nam – Ban Tăng Sự Trung Ương</p>
        </div>

        {{-- Content --}}
        <main class="flex-1 py-8">
            @livewire('registration-form')
        </main>

        @include('partials.footer')

        @livewireScripts
    </body>
</html>
