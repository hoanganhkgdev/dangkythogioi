<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title ?? 'Xác thực' }} - GHPGVN</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,700&display=swap" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
        @livewireStyles
        <style>
            body { font-family: 'Roboto Condensed', sans-serif; }
            .left-panel {
                background: linear-gradient(145deg, #f59e0b 0%, #d97706 50%, #b45309 100%);
                position: relative;
                overflow: hidden;
            }
            .left-panel::before {
                content: '';
                position: absolute;
                width: 500px; height: 500px;
                border-radius: 50%;
                border: 80px solid rgba(255,255,255,0.07);
                top: -120px; left: -120px;
            }
            .left-panel::after {
                content: '';
                position: absolute;
                width: 350px; height: 350px;
                border-radius: 50%;
                border: 60px solid rgba(255,255,255,0.06);
                bottom: -80px; right: -80px;
            }
            .decor-circle {
                position: absolute;
                border-radius: 50%;
                border: 40px solid rgba(255,255,255,0.05);
            }
            input:focus { outline: none; }
        </style>
    </head>
    <body class="antialiased bg-gray-50">
        <div class="min-h-screen flex">

            {{-- Left branding panel --}}
            <div class="hidden lg:flex lg:w-1/2 left-panel flex-col items-center justify-center p-12 text-white">
                <div class="decor-circle w-64 h-64 top-1/3 left-1/4 opacity-50"></div>

                <a href="/" class="mb-8 block">
                    <img src="{{ asset('logo-ghpgvn.png') }}" alt="Giáo Hội Phật Giáo Việt Nam"
                         class="h-20 w-auto object-contain drop-shadow-lg">
                </a>

                <p class="text-amber-100 text-center text-base font-medium max-w-xs leading-relaxed mb-10">
                    Hệ thống Đăng ký Thọ Giới trực tuyến – Ban Tăng sự Trung ương
                </p>

                <div class="flex flex-col gap-3 w-full max-w-xs">
                    <div class="flex items-center gap-3 bg-white/10 rounded-xl px-4 py-3">
                        <svg class="w-5 h-5 text-amber-200 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-sm text-amber-50">Đăng ký hồ sơ dễ dàng, tiện lợi</span>
                    </div>
                    <div class="flex items-center gap-3 bg-white/10 rounded-xl px-4 py-3">
                        <svg class="w-5 h-5 text-amber-200 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-sm text-amber-50">Theo dõi tình trạng hồ sơ trực tuyến</span>
                    </div>
                    <div class="flex items-center gap-3 bg-white/10 rounded-xl px-4 py-3">
                        <svg class="w-5 h-5 text-amber-200 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-sm text-amber-50">Thông tin bảo mật &amp; an toàn</span>
                    </div>
                </div>
            </div>

            {{-- Right form panel --}}
            <div class="w-full lg:w-1/2 flex flex-col items-center justify-center px-6 py-12">

                {{-- Mobile logo --}}
                <div class="lg:hidden flex flex-col items-center mb-8">
                    <a href="/">
                        <img src="{{ asset('logo-ghpgvn.png') }}" alt="Giáo Hội Phật Giáo Việt Nam" class="h-14 w-auto object-contain">
                    </a>
                </div>

                <div class="w-full max-w-md">
                    {{ $slot }}
                </div>

                <p class="mt-8 text-xs text-gray-400 text-center">
                    © {{ date('Y') }} Giáo hội Phật giáo Việt Nam – Ban Tăng sự T.Ư
                </p>
            </div>

        </div>
        @livewireScripts
    </body>
</html>
