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
    <link href="https://fonts.bunny.net/css?family=space-grotesk:400,600,700|inter:400,500,600,700,800,900" rel="stylesheet">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <style type="text/tailwindcss">
        @theme {
            --font-sans: 'Inter', ui-sans-serif, system-ui, sans-serif;
            --font-display: 'Space Grotesk', ui-sans-serif, system-ui, sans-serif;
            --color-primary: #38bdf8;
            --color-primary-light: #7dd3fc;
            --color-primary-dark: #0284c7;
            --color-accent: #60a5fa;
            --color-surface: #f0f9ff;
            --color-surface-dark: #060b18;
            --color-surface-card: #0c152e;
            --color-comic-border: #1e3a8a;
            --color-comic-accent: #38bdf8;
        }
    </style>
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        /* Comic Halftone Dot Pattern Background */
        .comic-halftone {
            background-color: #060b18;
            background-image: radial-gradient(rgba(56, 189, 248, 0.12) 1px, transparent 1px);
            background-size: 16px 16px;
        }

        /* Comic Speedline Strip */
        .comic-speedlines {
            background: repeating-linear-gradient(
                -45deg,
                rgba(56, 189, 248, 0.03),
                rgba(56, 189, 248, 0.03) 2px,
                transparent 2px,
                transparent 8px
            );
        }

        /* Comic Panel Card */
        .comic-panel {
            background: rgba(12, 21, 46, 0.85);
            border: 2px solid rgba(56, 189, 248, 0.35);
            box-shadow: 4px 4px 0px rgba(56, 189, 248, 0.25);
            position: relative;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .comic-panel:hover {
            border-color: #38bdf8;
            box-shadow: 6px 6px 0px rgba(56, 189, 248, 0.5);
            transform: translate(-2px, -2px);
        }

        /* Comic Sharp Tag */
        .comic-tag {
            font-family: 'Space Grotesk', monospace;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            background: #38bdf8;
            color: #060b18;
            font-weight: 800;
            padding: 2px 8px;
            clip-path: polygon(0 0, 100% 0, calc(100% - 6px) 100%, 0 100%);
            display: inline-block;
        }

        .comic-tag-outline {
            font-family: 'Space Grotesk', monospace;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            border: 1.5px solid #38bdf8;
            color: #38bdf8;
            font-weight: 700;
            padding: 2px 8px;
            background: rgba(56, 189, 248, 0.08);
            display: inline-block;
        }

        /* Comic Speech Balloon Tail */
        .comic-balloon {
            position: relative;
            background: rgba(12, 21, 46, 0.95);
            border: 2px solid #38bdf8;
            box-shadow: 4px 4px 0px rgba(56, 189, 248, 0.3);
        }
        .comic-balloon::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 24px;
            border-width: 10px 10px 0 0;
            border-style: solid;
            border-color: #38bdf8 transparent transparent transparent;
        }

        /* Comic Button */
        .btn-comic {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            background: #38bdf8;
            color: #060b18;
            border: 2px solid #38bdf8;
            box-shadow: 4px 4px 0px rgba(2, 132, 199, 0.8);
            transition: all 0.15s ease-in-out;
        }
        .btn-comic:hover {
            background: #7dd3fc;
            box-shadow: 2px 2px 0px rgba(2, 132, 199, 0.8);
            transform: translate(2px, 2px);
        }

        .btn-comic-ghost {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            background: rgba(12, 21, 46, 0.8);
            color: #38bdf8;
            border: 2px solid rgba(56, 189, 248, 0.4);
            box-shadow: 3px 3px 0px rgba(56, 189, 248, 0.2);
            transition: all 0.15s ease-in-out;
        }
        .btn-comic-ghost:hover {
            border-color: #38bdf8;
            background: rgba(56, 189, 248, 0.1);
            box-shadow: 1px 1px 0px rgba(56, 189, 248, 0.4);
            transform: translate(2px, 2px);
        }

        /* Loading Screen Comic */
        .loading-screen {
            position: fixed;
            inset: 0;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #060b18;
            transition: opacity 0.4s, visibility 0.4s;
        }
        .loading-screen.fade-out {
            opacity: 0;
            visibility: hidden;
        }
        .comic-loader {
            width: 48px;
            height: 48px;
            border: 4px solid rgba(56, 189, 248, 0.2);
            border-top: 4px solid #38bdf8;
            box-shadow: 0 0 15px rgba(56, 189, 248, 0.5);
            animation: comicSpin 0.7s linear infinite;
        }
        @keyframes comicSpin { to { transform: rotate(360deg); } }
    </style>
    @stack('head')
</head>
<body class="comic-halftone text-slate-100 font-sans antialiased selection:bg-sky-400 selection:text-slate-950">
    <div class="loading-screen" id="loadingScreen">
        <div class="flex flex-col items-center gap-4">
            <div class="comic-loader"></div>
            <div class="comic-tag text-xs font-mono tracking-widest">[SYSTEM // SYNCING]</div>
        </div>
    </div>

    @yield('body')

    @if(session('success'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
         x-transition class="fixed bottom-6 right-6 z-50 bg-sky-400 text-slate-950 font-bold px-5 py-3 border-2 border-slate-950 shadow-[4px_4px_0px_#0284c7] text-xs uppercase tracking-wider font-mono">
        [NOTIFICATION] {{ session('success') }}
    </div>
    @endif

    <script>
        window.addEventListener('load', () => {
            setTimeout(() => {
                document.getElementById('loadingScreen')?.classList.add('fade-out');
            }, 250);
            lucide.createIcons();
        });
        document.addEventListener('DOMContentLoaded', () => {
            AOS.init({ duration: 500, once: true, offset: 30 });
            lucide.createIcons();
        });
    </script>
    @stack('scripts')
</body>
</html>
