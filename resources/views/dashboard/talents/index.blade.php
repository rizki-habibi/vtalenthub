@extends('layouts.dashboard')
@section('title', 'Katalog Talent')
@section('page-title', 'Talent Manager')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-xl font-bold tracking-tight">Katalog Virtual Talent</h1>
            <p class="text-xs text-slate-500 mt-0.5">Pantau status kesiapan model, statistik jangkauan, dan kebutuhan aset kreator.</p>
        </div>
        <a href="{{ route('talents.create') }}" class="bg-sky-500 hover:bg-sky-400 text-slate-950 px-4 py-2 rounded-xl text-xs font-semibold transition-all flex items-center gap-1.5 shadow-md shadow-sky-500/20">
            <i data-lucide="user-plus" class="w-4 h-4"></i>
            <span>Daftarkan Talent</span>
        </a>
    </div>

    <!-- Filter Bar -->
    <div class="glass-auto rounded-xl p-3 border border-slate-200/50 dark:border-slate-800">
        <form method="GET" class="flex flex-wrap gap-2.5 items-center">
            <div class="relative flex-1 min-w-[200px]">
                <i data-lucide="search" class="w-3.5 h-3.5 text-slate-500 absolute left-3 top-1/2 -translate-y-1/2"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama talent..."
                       class="w-full bg-slate-100 dark:bg-slate-900/80 rounded-xl pl-9 pr-3 py-1.5 text-xs outline-none focus:ring-1 focus:ring-sky-400 border border-slate-200 dark:border-slate-800">
            </div>
            <select name="status" class="bg-slate-100 dark:bg-slate-900/80 rounded-xl px-3 py-1.5 text-xs outline-none border border-slate-200 dark:border-slate-800">
                <option value="">Status: Semua</option>
                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Aktif</option>
                <option value="onboarding" {{ request('status') === 'onboarding' ? 'selected' : '' }}>Onboarding</option>
                <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Nonaktif</option>
            </select>
            <select name="platform" class="bg-slate-100 dark:bg-slate-900/80 rounded-xl px-3 py-1.5 text-xs outline-none border border-slate-200 dark:border-slate-800">
                <option value="">Platform: Semua</option>
                <option value="youtube" {{ request('platform') === 'youtube' ? 'selected' : '' }}>YouTube</option>
                <option value="twitch" {{ request('platform') === 'twitch' ? 'selected' : '' }}>Twitch</option>
                <option value="tiktok" {{ request('platform') === 'tiktok' ? 'selected' : '' }}>TikTok</option>
            </select>
            <button type="submit" class="bg-slate-800 hover:bg-slate-700 text-slate-200 px-3 py-1.5 rounded-xl text-xs font-medium">Saring</button>
        </form>
    </div>

    <!-- Grid -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse($talents as $t)
        <div class="glass-auto rounded-2xl p-5 border border-slate-200/50 dark:border-slate-800 hover:border-sky-500/30 transition-all flex flex-col justify-between" data-aos="fade-up">
            <div>
                <div class="flex items-start justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-sky-500/10 text-sky-400 flex items-center justify-center font-bold text-xs border border-sky-400/20">
                            {{ strtoupper(substr($t->name, 0, 2)) }}
                        </div>
                        <div>
                            <h3 class="text-sm font-bold tracking-tight">{{ $t->name }}</h3>
                            <div class="text-[11px] text-slate-500 font-mono">{{ ucfirst($t->platform) }}</div>
                        </div>
                    </div>
                    <span class="text-[10px] px-2 py-0.5 rounded-full font-medium {{ $t->status === 'active' ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' : 'bg-amber-500/10 text-amber-400 border border-amber-500/20' }}">
                        {{ ucfirst($t->status) }}
                    </span>
                </div>

                <div class="grid grid-cols-3 gap-2 my-4 py-2 border-y border-slate-200/40 dark:border-slate-800/80 text-center text-xs">
                    <div>
                        <div class="font-bold font-mono text-sky-400">{{ number_format($t->subscribers) }}</div>
                        <div class="text-[10px] text-slate-500">Pengikut</div>
                    </div>
                    <div>
                        <div class="font-bold font-mono">{{ strtoupper($t->model_type) }}</div>
                        <div class="text-[10px] text-slate-500">Tipe Model</div>
                    </div>
                    <div>
                        <div class="font-bold font-mono">{{ $t->language }}</div>
                        <div class="text-[10px] text-slate-500">Bahasa</div>
                    </div>
                </div>

                @if($t->bio)
                <p class="text-[11px] text-slate-500 dark:text-slate-400 line-clamp-2">{{ $t->bio }}</p>
                @endif
            </div>

            <div class="flex items-center justify-between pt-3 mt-4 border-t border-slate-200/40 dark:border-slate-800/80 text-xs">
                <a href="{{ route('talents.show', $t) }}" class="text-sky-400 hover:underline flex items-center gap-1 font-medium">
                    <span>Lihat Detail</span>
                    <i data-lucide="arrow-up-right" class="w-3 h-3"></i>
                </a>
                <div class="flex items-center gap-2">
                    <a href="{{ route('talents.edit', $t) }}" class="text-slate-400 hover:text-slate-200">
                        <i data-lucide="pencil" class="w-3.5 h-3.5"></i>
                    </a>
                    <form method="POST" action="{{ route('talents.destroy', $t) }}" onsubmit="return confirm('Hapus profil talent ini?')">
                        @csrf @method('DELETE')
                        <button class="text-slate-500 hover:text-rose-400">
                            <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-16 text-slate-500 text-xs glass-auto rounded-2xl border border-slate-800">
            <i data-lucide="inbox" class="w-8 h-8 mx-auto text-slate-600 mb-2"></i>
            Belum ada talent terdaftar dalam sistem.
        </div>
        @endforelse
    </div>

    <div>{{ $talents->links() }}</div>
</div>
@endsection
