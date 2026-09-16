@extends('layouts.app')

@section('body')
<div x-data="{ sidebarOpen: window.innerWidth >= 1024, mobileMenu: false }" class="flex min-h-screen">
    <!-- Sidebar Desktop -->
    <aside :class="sidebarOpen ? 'w-64' : 'w-20'"
           class="fixed inset-y-0 left-0 z-40 glass-auto border-r border-slate-200/50 dark:border-slate-800 transition-all duration-300 hidden lg:flex flex-col">
        <div class="flex items-center gap-3 px-5 py-5 border-b border-slate-200/50 dark:border-slate-800">
            <div class="w-9 h-9 rounded-xl bg-sky-500/10 border border-sky-400/30 flex items-center justify-center text-sky-400 shrink-0">
                <i data-lucide="sparkles" class="w-5 h-5"></i>
            </div>
            <span x-show="sidebarOpen" x-transition class="text-lg font-bold tracking-tight bg-gradient-to-r from-sky-400 to-blue-500 bg-clip-text text-transparent">Agend Data</span>
        </div>

        <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
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
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors text-sm
                      {{ request()->routeIs($item['route'].'*') ? 'bg-sky-500/15 text-sky-400 font-semibold border border-sky-500/20' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800/60' }}">
                <span class="w-6 h-6 flex items-center justify-center shrink-0">
                    <i data-lucide="{{ $item['icon'] }}" class="w-4 h-4"></i>
                </span>
                <span x-show="sidebarOpen" x-transition>{{ $item['label'] }}</span>
            </a>
            @endforeach
        </nav>

        <div class="px-3 py-4 border-t border-slate-200/50 dark:border-slate-800 space-y-1">
            <button @click="sidebarOpen = !sidebarOpen"
                    class="flex items-center gap-3 px-3 py-2 rounded-xl text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-800 w-full text-xs transition-colors">
                <span class="w-6 h-6 flex items-center justify-center shrink-0">
                    <i data-lucide="panel-left" class="w-4 h-4"></i>
                </span>
                <span x-show="sidebarOpen" x-transition>Collapse Menu</span>
            </button>
            <button @click="dark = !dark; localStorage.setItem('dark', dark)"
                    class="flex items-center gap-3 px-3 py-2 rounded-xl text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-800 w-full text-xs transition-colors">
                <span class="w-6 h-6 flex items-center justify-center shrink-0">
                    <i :data-lucide="dark ? 'sun' : 'moon'" class="w-4 h-4"></i>
                </span>
                <span x-show="sidebarOpen" x-transition x-text="dark ? 'Light Mode' : 'Dark Mode'"></span>
            </button>
        </div>
    </aside>

    <!-- Mobile Overlay -->
    <div x-show="mobileMenu" @click="mobileMenu = false" x-transition.opacity
         class="fixed inset-0 bg-slate-950/70 z-30 lg:hidden backdrop-blur-sm"></div>

    <!-- Mobile Drawer -->
    <aside x-show="mobileMenu" x-transition:enter="transition-transform duration-300" x-transition:enter-start="-translate-x-full"
           x-transition:leave="transition-transform duration-300" x-transition:leave-end="-translate-x-full"
           class="fixed inset-y-0 left-0 z-40 w-64 glass-auto border-r border-slate-200/50 dark:border-slate-800 lg:hidden flex flex-col">
        <div class="flex items-center justify-between px-5 py-5 border-b border-slate-200/50 dark:border-slate-800">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-sky-500/10 border border-sky-400/30 flex items-center justify-center text-sky-400">
                    <i data-lucide="sparkles" class="w-4 h-4"></i>
                </div>
                <span class="font-bold text-sky-400">Agend Data</span>
            </div>
            <button @click="mobileMenu = false" class="text-slate-400 hover:text-slate-200">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
            @foreach($nav as $item)
            <a href="{{ route($item['route']) }}" @click="mobileMenu = false"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm
                      {{ request()->routeIs($item['route'].'*') ? 'bg-sky-500/15 text-sky-400 font-semibold' : 'text-slate-600 dark:text-slate-400' }}">
                <i data-lucide="{{ $item['icon'] }}" class="w-4 h-4"></i>
                <span>{{ $item['label'] }}</span>
            </a>
            @endforeach
        </nav>
    </aside>

    <!-- Main -->
    <main :class="sidebarOpen ? 'lg:ml-64' : 'lg:ml-20'" class="flex-1 transition-all duration-300 flex flex-col">
        <header class="sticky top-0 z-20 glass-auto border-b border-slate-200/50 dark:border-slate-800 px-4 lg:px-8 py-3"
                x-data="{ searchOpen: false, query: '', results: { talents: [], assets: [], clients: [], innovations: [] }, isSearching: false }"
                @keydown.window.prevent.ctrl.k="searchOpen = true; $nextTick(() => $refs.searchInput.focus())"
                @keydown.window.prevent.meta.k="searchOpen = true; $nextTick(() => $refs.searchInput.focus())">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <button @click="mobileMenu = true" class="lg:hidden text-slate-600 dark:text-slate-400">
                        <i data-lucide="menu" class="w-5 h-5"></i>
                    </button>
                    <h2 class="text-sm font-semibold tracking-wide uppercase text-slate-500 dark:text-slate-400">@yield('page-title', 'Dashboard')</h2>
                </div>

                <!-- Tombol Trigger Pencarian Cepat -->
                <div class="flex items-center gap-3">
                    <button @click="searchOpen = true; $nextTick(() => $refs.searchInput.focus())"
                            class="flex items-center gap-2 px-3 py-1.5 rounded-xl bg-slate-900/60 hover:bg-slate-900 border border-slate-800 text-slate-400 text-xs transition-colors">
                        <i data-lucide="search" class="w-3.5 h-3.5"></i>
                        <span class="hidden sm:inline">Cari talent, aset, klien, inovasi...</span>
                        <kbd class="hidden sm:inline-block px-1.5 py-0.5 rounded bg-slate-800 border border-slate-700 text-[10px] font-mono text-slate-400">Ctrl K</kbd>
                    </button>

                    <a href="{{ route('home') }}" class="text-xs text-slate-500 hover:text-sky-400 flex items-center gap-1.5 transition-colors">
                        <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                        <span class="hidden md:inline">Landing</span>
                    </a>
                    @auth
                    <div class="flex items-center gap-3 pl-3 border-l border-slate-200 dark:border-slate-800">
                        <div class="w-8 h-8 rounded-full bg-sky-500/15 border border-sky-400/30 flex items-center justify-center text-sky-400 text-xs font-bold">
                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-xs text-slate-500 hover:text-rose-400 transition-colors">Keluar</button>
                        </form>
                    </div>
                    @endauth
                </div>
            </div>

            <!-- MODAL GLOBAL SEARCH (Ctrl + K) -->
            <div x-show="searchOpen" @click.self="searchOpen = false" x-transition.opacity
                 class="fixed inset-0 z-50 bg-slate-950/80 backdrop-blur-sm flex items-start justify-center pt-20 p-4">
                <div class="w-full max-w-xl glass-auto rounded-3xl p-5 border border-slate-700 shadow-2xl space-y-4">
                    <div class="flex items-center gap-2.5 pb-3 border-b border-slate-800">
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
                               placeholder="Ketik pencarian: nama talent, jenis aset, brand sponsor, atau ide inovasi..."
                               class="w-full bg-transparent text-xs text-slate-200 outline-none placeholder:text-slate-500">
                        <button @click="searchOpen = false" class="text-slate-400 hover:text-slate-200 text-xs">
                            <i data-lucide="x" class="w-4 h-4"></i>
                        </button>
                    </div>

                    <!-- Hasil Pencarian -->
                    <div class="max-h-96 overflow-y-auto space-y-4 text-xs">
                        <div x-show="isSearching" class="text-center py-6 text-slate-500 text-xs flex items-center justify-center gap-2">
                            <i data-lucide="loader-2" class="w-4 h-4 animate-spin"></i>
                            <span>Memindai seluruh data agensi...</span>
                        </div>

                        <!-- Hasil Talents -->
                        <template x-if="results.talents.length > 0">
                            <div>
                                <div class="text-[10px] font-mono uppercase tracking-wider text-slate-500 font-bold mb-1.5">Talent Terkait</div>
                                <div class="space-y-1">
                                    <template x-for="t in results.talents" :key="'t-' + t.id">
                                        <a :href="'/talents/' + t.id" class="flex items-center justify-between p-2.5 rounded-xl hover:bg-slate-800/80 transition-colors">
                                            <div class="flex items-center gap-2">
                                                <div class="w-6 h-6 rounded-lg bg-sky-500/10 text-sky-400 flex items-center justify-center text-[10px] font-bold" x-text="t.name.substr(0, 2).toUpperCase()"></div>
                                                <span class="font-semibold text-slate-200" x-text="t.name"></span>
                                            </div>
                                            <span class="text-[11px] font-mono text-slate-400" x-text="t.platform.toUpperCase() + ' · ' + t.model_type.toUpperCase()"></span>
                                        </a>
                                    </template>
                                </div>
                            </div>
                        </template>

                        <!-- Hasil Aset -->
                        <template x-if="results.assets.length > 0">
                            <div>
                                <div class="text-[10px] font-mono uppercase tracking-wider text-slate-500 font-bold mb-1.5">Aset Visual</div>
                                <div class="space-y-1">
                                    <template x-for="a in results.assets" :key="'a-' + a.id">
                                        <a href="/assets" class="flex items-center justify-between p-2.5 rounded-xl hover:bg-slate-800/80 transition-colors">
                                            <div class="flex items-center gap-2">
                                                <i data-lucide="palette" class="w-3.5 h-3.5 text-sky-400"></i>
                                                <span class="font-semibold text-slate-200" x-text="a.name"></span>
                                            </div>
                                            <span class="text-[11px] font-mono text-slate-400" x-text="a.type.toUpperCase()"></span>
                                        </a>
                                    </template>
                                </div>
                            </div>
                        </template>

                        <!-- Hasil Klien -->
                        <template x-if="results.clients.length > 0">
                            <div>
                                <div class="text-[10px] font-mono uppercase tracking-wider text-slate-500 font-bold mb-1.5">Kemitraan Brand / Sponsor</div>
                                <div class="space-y-1">
                                    <template x-for="c in results.clients" :key="'c-' + c.id">
                                        <a href="/clients" class="flex items-center justify-between p-2.5 rounded-xl hover:bg-slate-800/80 transition-colors">
                                            <div class="flex items-center gap-2">
                                                <i data-lucide="briefcase" class="w-3.5 h-3.5 text-sky-400"></i>
                                                <span class="font-semibold text-slate-200" x-text="c.name"></span>
                                            </div>
                                            <span class="text-[10px] px-2 py-0.5 rounded bg-slate-800 font-mono text-emerald-400" x-text="'Rp ' + Number(c.deal_value).toLocaleString('id-ID')"></span>
                                        </a>
                                    </template>
                                </div>
                            </div>
                        </template>

                        <!-- Hasil Inovasi -->
                        <template x-if="results.innovations.length > 0">
                            <div>
                                <div class="text-[10px] font-mono uppercase tracking-wider text-slate-500 font-bold mb-1.5">Bank Inovasi & Celah Pasar</div>
                                <div class="space-y-1">
                                    <template x-for="inv in results.innovations" :key="'i-' + inv.id">
                                        <a href="/innovations" class="flex items-center justify-between p-2.5 rounded-xl hover:bg-slate-800/80 transition-colors">
                                            <div class="flex items-center gap-2">
                                                <i data-lucide="sparkles" class="w-3.5 h-3.5 text-amber-400"></i>
                                                <span class="font-semibold text-slate-200" x-text="inv.title"></span>
                                            </div>
                                            <span class="text-[10px] font-mono text-slate-400" x-text="inv.category"></span>
                                        </a>
                                    </template>
                                </div>
                            </div>
                        </template>

                        <div x-show="!isSearching && query.length >= 2 && results.talents.length === 0 && results.assets.length === 0 && results.clients.length === 0 && results.innovations.length === 0"
                             class="text-center py-6 text-slate-500 text-xs">
                            Tidak ditemukan data yang cocok untuk "<span x-text="query" class="text-slate-300"></span>".
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="p-4 lg:p-8 flex-1">
            @yield('content')
        </div>
    </main>
</div>
@endsection
