<!DOCTYPE html>
<html lang="id" class="dark" x-data="{ dark: localStorage.getItem('dark') !== 'false' }" :class="{ 'dark': dark }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Agend Data') — Pusat Data & Kebutuhan Virtual Talent</title>
        <meta name="description" content="Agend Data: Platform riset data dan pengembangan kebutuhan virtual talent menjadi produk siap profit.">
        <link rel="icon" href="{{ asset('images/logo.png') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800,900" rel="stylesheet">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <style type="text/tailwindcss">
        @theme {
            --font-sans: 'Inter', ui-sans-serif, system-ui, sans-serif;
            --color-primary: #38bdf8;
            --color-primary-light: #7dd3fc;
            --color-primary-dark: #0284c7;
            --color-accent: #60a5fa;
            --color-surface: #f0f9ff;
            --color-surface-dark: #0b1329;
            --color-surface-card: #111d3d;
            --color-border-dark: #1e293b;
        }
    </style>
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        .loading-screen {
            position: fixed;
            inset: 0;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #070d1e;
            transition: opacity 0.5s, visibility 0.5s;
        }
        .loading-screen.fade-out {
            opacity: 0;
            visibility: hidden;
        }
        .loader-ring {
            width: 50px;
            height: 50px;
            border: 3px solid #1e293b;
            border-top-color: #38bdf8;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }
        .glass {
            background: rgba(17, 29, 61, 0.65);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(56, 189, 248, 0.12);
        }
        .glass-light {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(2, 132, 199, 0.15);
        }
        html.dark .glass-auto {
            background: rgba(17, 29, 61, 0.65);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(56, 189, 248, 0.12);
        }
        html:not(.dark) .glass-auto {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(2, 132, 199, 0.15);
        }
    </style>
    @stack('head')
</head>
<body class="bg-surface dark:bg-surface-dark text-slate-800 dark:text-slate-100 font-sans antialiased transition-colors duration-200">
    <div class="loading-screen" id="loadingScreen">
        <div class="flex flex-col items-center gap-4">
            <div class="loader-ring"></div>
            <div class="text-sm tracking-wider uppercase font-semibold text-primary">Agend Data</div>
        </div>
    </div>

    @yield('body')

    @if(session('success'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
         x-transition class="fixed bottom-6 right-6 z-50 bg-sky-500 text-slate-950 font-semibold px-5 py-3 rounded-xl shadow-lg shadow-sky-500/20 text-sm">
        {{ session('success') }}
    </div>
    @endif

    <script>
        window.addEventListener('load', () => {
            setTimeout(() => {
                document.getElementById('loadingScreen')?.classList.add('fade-out');
            }, 300);
            lucide.createIcons();
        });
        document.addEventListener('DOMContentLoaded', () => {
            AOS.init({ duration: 600, once: true, offset: 40 });
            lucide.createIcons();
        });
    </script>
    @stack('scripts')
</body>
</html>
