@extends('layouts.app')

@section('body')
<div x-data="{ sidebarOpen: window.innerWidth >= 1024, mobileMenu: false }" class="flex min-h-screen">
    <!-- Sidebar Desktop Comic Style -->
    <aside :class="sidebarOpen ? 'w-64' : 'w-20'"
           class="fixed inset-y-0 left-0 z-40 bg-slate-950 border-r-2 border-sky-400/40 transition-all duration-200 hidden lg:flex flex-col shadow-[4px_0px_0px_rgba(56,189,248,0.1)]">
        <!-- Brand Header -->
        <div class="flex items-center gap-3 px-5 py-5 border-b-2 border-sky-400/20">
            <div class="w-8 h-8 bg-sky-400 text-slate-950 border-2 border-slate-950 flex items-center justify-center font-black text-xs shrink-0 shadow-[2px_2px_0px_#38bdf8]">
                AD
            </div>
            <div x-show="sidebarOpen" x-transition class="flex flex-col">
                <span class="text-sm font-black font-display tracking-tight text-sky-400">AGEND DATA</span>
                <span class="text-[8px] font-mono tracking-widest text-slate-500 uppercase -mt-1">[AGENCY KERNEL]</span>
            </div>
        </div>

        <!-- Navigation List -->
        <nav class="flex-1 px-3 py-4 space-y-1.5 overflow-y-auto font-display text-xs">
            @php
            $nav = [
                ['route' => 'dashboard', 'icon' => 'layout-dashboard', 'label' => 'Dashboard'],
                ['route' => 'talents.index', 'icon' => 'users', 'label' => 'Talent Manager'],
                ['route' => 'assets.index', 'icon' => 'palette', 'label' => 'Asset Generator'],
                ['route' => 'innovations.index', 'icon' => 'sparkles', 'label' => 'Inovasi AI'],
                ['route' => 'counseling.index', 'icon' => 'messages-square', 'label' => 'Konseling'],
                ['route' => 'clients.index', 'icon' => 'briefcase', 'label' => 'Client Portal'],
                ['route' => 'analytics.index', 'icon' => 'line-chart', 'label' => 'Analytics'],
                ['route' => 'settings', 'icon' => 'settings', 'label' => 'Settings'],
            ];
            @endphp
            @foreach($nav as $item)
            <a href="{{ route($item['route']) }}"
               class="flex items-center gap-3 px-3 py-2.5 transition-all text-xs uppercase font-bold tracking-wider
                      {{ request()->routeIs($item['route'].'*') 
                          ? 'bg-sky-400 text-slate-950 border-2 border-slate-950 shadow-[3px_3px_0px_#38bdf8]' 
                          : 'text-slate-400 hover:text-sky-400 hover:bg-slate-900 border-2 border-transparent' }}">
                <span class="w-5 h-5 flex items-center justify-center shrink-0">
                    <i data-lucide="{{ $item['icon'] }}" class="w-4 h-4"></i>
                </span>
                <span x-show="sidebarOpen" x-transition>{{ $item['label'] }}</span>
            </a>
            @endforeach
        </nav>

        <div class="px-3 py-4 border-t-2 border-sky-400/20 space-y-1 text-xs font-mono">
            <button @click="sidebarOpen = !sidebarOpen"
                    class="flex items-center gap-3 px-3 py-2 text-slate-400 hover:text-sky-400 hover:bg-slate-900 w-full text-xs transition-colors">
                <span class="w-5 h-5 flex items-center justify-center shrink-0">
                    <i data-lucide="panel-left" class="w-4 h-4"></i>
                </span>
                <span x-show="sidebarOpen" x-transition>[COLLAPSE]</span>
            </button>
        </div>
    </aside>

    <!-- Mobile Drawer -->
    <aside x-show="mobileMenu" x-transition:enter="transition-transform duration-200" x-transition:enter-start="-translate-x-full"
           x-transition:leave="transition-transform duration-200" x-transition:leave-end="-translate-x-full"
           class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-950 border-r-2 border-sky-400 lg:hidden flex flex-col">
        <div class="flex items-center justify-between px-5 py-5 border-b-2 border-sky-400">
            <div class="flex items-center gap-2">
                <div class="w-7 h-7 bg-sky-400 text-slate-950 font-black text-xs flex items-center justify-center">AD</div>
                <span class="font-black font-display text-sky-400 text-sm">AGEND DATA</span>
            </div>
            <button @click="mobileMenu = false" class="text-slate-400 hover:text-slate-200">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        <nav class="flex-1 px-3 py-4 space-y-1.5 overflow-y-auto font-display text-xs">
            @foreach($nav as $item)
            <a href="{{ route($item['route']) }}" @click="mobileMenu = false"
               class="flex items-center gap-3 px-3 py-2.5 uppercase font-bold tracking-wider
                      {{ request()->routeIs($item['route'].'*') ? 'bg-sky-400 text-slate-950' : 'text-slate-400 hover:text-sky-400' }}">
                <i data-lucide="{{ $item['icon'] }}" class="w-4 h-4"></i>
                <span>{{ $item['label'] }}</span>
            </a>
            @endforeach
        </nav>
    </aside>

    <!-- Main Content Area -->
    <main :class="sidebarOpen ? 'lg:ml-64' : 'lg:ml-20'" class="flex-1 transition-all duration-200 flex flex-col">
        <!-- Topbar Comic Console Style -->
        <header class="sticky top-0 z-20 bg-slate-950/90 border-b-2 border-sky-400/30 backdrop-blur-md px-4 lg:px-8 py-3"
                x-data="{ searchOpen: false, query: '', results: { talents: [], assets: [], clients: [], innovations: [] }, isSearching: false }"
                @keydown.window.prevent.ctrl.k="searchOpen = true; $nextTick(() => $refs.searchInput.focus())"
                @keydown.window.prevent.meta.k="searchOpen = true; $nextTick(() => $refs.searchInput.focus())">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <button @click="mobileMenu = true" class="lg:hidden text-sky-400 p-1 border border-sky-400">
                        <i data-lucide="menu" class="w-4 h-4"></i>
                    </button>
                    <div class="flex items-center gap-2">
                        <span class="comic-tag text-[9px]">PANEL</span>
                        <h2 class="text-xs font-black font-display uppercase tracking-wider text-slate-200">@yield('page-title', 'Dashboard')</h2>
                    </div>
                </div>

                <!-- Global Search Trigger & Profile -->
                <div class="flex items-center gap-3">
                    <button @click="searchOpen = true; $nextTick(() => $refs.searchInput.focus())"
                            class="flex items-center gap-2 px-3 py-1.5 bg-slate-900 border-2 border-sky-400/40 hover:border-sky-400 text-slate-400 text-xs font-mono transition-colors shadow-[2px_2px_0px_rgba(56,189,248,0.2)]">
                        <i data-lucide="search" class="w-3.5 h-3.5 text-sky-400"></i>
                        <span class="hidden sm:inline">PENCARIAN DATA...</span>
                        <kbd class="hidden sm:inline-block px-1.5 py-0.5 bg-slate-950 border border-slate-700 text-[9px] font-mono text-sky-400">Ctrl K</kbd>
                    </button>

                    <a href="{{ route('home') }}" class="text-xs font-mono text-slate-400 hover:text-sky-400 flex items-center gap-1">
                        <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                        <span class="hidden md:inline">[LANDING]</span>
                    </a>

                    @auth
                    <div class="flex items-center gap-2 pl-3 border-l-2 border-sky-400/20 font-mono text-xs">
                        <div class="w-7 h-7 bg-sky-400 text-slate-950 font-black text-xs flex items-center justify-center border border-slate-950">
                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-slate-400 hover:text-rose-400 text-[11px] uppercase">[KELUAR]</button>
                        </form>
                    </div>
                    @endauth
                </div>
            </div>

            <!-- MODAL GLOBAL SEARCH COMIC (Ctrl + K) -->
            <div x-show="searchOpen" @click.self="searchOpen = false" x-transition.opacity
                 class="fixed inset-0 z-50 bg-slate-950/80 backdrop-blur-sm flex items-start justify-center pt-20 p-4">
                <div class="w-full max-w-xl comic-panel p-5 shadow-[8px_8px_0px_#38bdf8] space-y-4">
                    <div class="flex items-center justify-between pb-2 border-b-2 border-sky-400">
                        <div class="flex items-center gap-2">
                            <span class="comic-tag text-[9px]">[SEARCH // MATRIX]</span>
                            <span class="text-xs font-mono text-slate-400">Pencarian Lintas Entitas</span>
                        </div>
                        <button @click="searchOpen = false" class="text-slate-400 hover:text-rose-400 font-mono text-xs">[ESC]</button>
                    </div>

                    <div class="flex items-center gap-2 bg-slate-950 border-2 border-sky-400 p-2">
                        <i data-lucide="search" class="w-4 h-4 text-sky-400"></i>
                        <input type="text" x-ref="searchInput" x-model="query"
                               @input.debounce.300ms="
                                  if(query.length >= 2) {
                                      isSearching = true;
                                      fetch('/api/search?q=' + encodeURIComponent(query))
                                          .then(r => r.json())
                                          .then(d => { results = d; isSearching = false; $nextTick(() => lucide.createIcons()); })
                                  } else {
                                      results = { talents: [], assets: [], clients: [], innovations: [] };
                                  }
                               "
                               placeholder="Ketik pencarian: nama talent, jenis aset, brand klien, atau ide inovasi..."
                               class="w-full bg-transparent text-xs font-mono text-slate-100 outline-none placeholder:text-slate-600">
                    </div>

                    <!-- Hasil Pencarian Comic -->
                    <div class="max-h-96 overflow-y-auto space-y-3 font-mono text-xs">
                        <div x-show="isSearching" class="text-center py-6 text-sky-400 font-mono text-xs flex items-center justify-center gap-2">
                            <i data-lucide="loader-2" class="w-4 h-4 animate-spin"></i>
                            <span>[SCANNING DATA CORRIDOR]...</span>
                        </div>

                        <!-- Talents -->
                        <template x-if="results.talents.length > 0">
                            <div>
                                <div class="comic-tag text-[8px] mb-1">TALENTS</div>
                                <div class="space-y-1">
                                    <template x-for="t in results.talents" :key="'t-' + t.id">
                                        <a :href="'/talents/' + t.id" class="flex items-center justify-between p-2 bg-slate-900 border border-slate-800 hover:border-sky-400 transition-colors">
                                            <span class="font-bold text-slate-200" x-text="t.name"></span>
                                            <span class="text-[10px] text-sky-400" x-text="t.platform.toUpperCase() + ' // ' + t.model_type.toUpperCase()"></span>
                                        </a>
                                    </template>
                                </div>
                            </div>
                        </template>

                        <!-- Assets -->
                        <template x-if="results.assets.length > 0">
                            <div>
                                <div class="comic-tag text-[8px] mb-1">ASSETS</div>
                                <div class="space-y-1">
                                    <template x-for="a in results.assets" :key="'a-' + a.id">
                                        <a href="/assets" class="flex items-center justify-between p-2 bg-slate-900 border border-slate-800 hover:border-sky-400 transition-colors">
                                            <span class="font-bold text-slate-200" x-text="a.name"></span>
                                            <span class="text-[10px] text-sky-400" x-text="a.type.toUpperCase()"></span>
                                        </a>
                                    </template>
                                </div>
                            </div>
                        </template>

                        <!-- Clients -->
                        <template x-if="results.clients.length > 0">
                            <div>
                                <div class="comic-tag text-[8px] mb-1">COMMERCIAL CLIENTS</div>
                                <div class="space-y-1">
                                    <template x-for="c in results.clients" :key="'c-' + c.id">
                                        <a href="/clients" class="flex items-center justify-between p-2 bg-slate-900 border border-slate-800 hover:border-sky-400 transition-colors">
                                            <span class="font-bold text-slate-200" x-text="c.name"></span>
                                            <span class="text-[10px] text-emerald-400 font-bold" x-text="'Rp ' + Number(c.deal_value).toLocaleString('id-ID')"></span>
                                        </a>
                                    </template>
                                </div>
                            </div>
                        </template>

                        <!-- Innovations -->
                        <template x-if="results.innovations.length > 0">
                            <div>
                                <div class="comic-tag text-[8px] mb-1">INNOVATIONS</div>
                                <div class="space-y-1">
                                    <template x-for="inv in results.innovations" :key="'i-' + inv.id">
                                        <a href="/innovations" class="flex items-center justify-between p-2 bg-slate-900 border border-slate-800 hover:border-sky-400 transition-colors">
                                            <span class="font-bold text-slate-200" x-text="inv.title"></span>
                                            <span class="text-[10px] text-amber-400 font-bold" x-text="inv.category.toUpperCase()"></span>
                                        </a>
                                    </template>
                                </div>
                            </div>
                        </template>

                        <div x-show="!isSearching && query.length >= 2 && results.talents.length === 0 && results.assets.length === 0 && results.clients.length === 0 && results.innovations.length === 0"
                             class="text-center py-6 text-slate-500 text-xs font-mono">
                            [NO DATA FOUND FOR "<span x-text="query" class="text-sky-400"></span>"]
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Body Content -->
        <div class="p-4 lg:p-8 flex-1">
            @yield('content')
        </div>
    </main>
</div>
@endsection
