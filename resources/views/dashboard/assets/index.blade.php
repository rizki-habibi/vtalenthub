@extends('layouts.dashboard')
@section('title', 'Asset Generator & Katalog')
@section('page-title', 'Asset Studio')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-xl font-bold tracking-tight">Generator & Gudang Aset Virtual</h1>
            <p class="text-xs text-slate-500 mt-0.5">Produksi background, overlay, wallpaper, dan kit siaran terstandarisasi.</p>
        </div>
        <a href="{{ route('assets.create') }}" class="bg-sky-500 hover:bg-sky-400 text-slate-950 px-4 py-2 rounded-xl text-xs font-semibold transition-all flex items-center gap-1.5 shadow-md shadow-sky-500/20">
            <i data-lucide="sparkles" class="w-4 h-4"></i>
            <span>Generate Aset Baru</span>
        </a>
    </div>

    <!-- Filter Tipe -->
    <div class="flex flex-wrap gap-2 text-xs">
        <a href="{{ route('assets.index') }}" class="px-3 py-1.5 rounded-xl border {{ !request('type') ? 'bg-sky-500/15 border-sky-400/40 text-sky-400' : 'border-slate-800 text-slate-400 hover:bg-slate-800' }}">Semua</a>
        @foreach(['background' => 'Background', 'overlay' => 'Overlay', 'wallpaper' => 'Wallpaper', 'emotes' => 'Emote Pack', 'logo' => 'Logo & Badge', 'schedule' => 'Jadwal Siaran'] as $k => $v)
        <a href="{{ route('assets.index', ['type' => $k]) }}" class="px-3 py-1.5 rounded-xl border {{ request('type') === $k ? 'bg-sky-500/15 border-sky-400/40 text-sky-400' : 'border-slate-800 text-slate-400 hover:bg-slate-800' }}">
            {{ $v }}
        </a>
        @endforeach
    </div>

    <!-- Grid Aset -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse($assets as $asset)
        <div class="glass-auto rounded-2xl p-5 border border-slate-200/50 dark:border-slate-800 hover:border-sky-500/30 transition-all flex flex-col justify-between" data-aos="fade-up">
            <div>
                <div class="h-32 rounded-xl bg-slate-900 border border-slate-800 flex items-center justify-center relative overflow-hidden mb-3">
                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-sky-500/10 via-slate-900 to-indigo-500/10">
                        <i data-lucide="image" class="w-8 h-8 text-sky-400/40"></i>
                    </div>
                    <span class="absolute top-2 right-2 text-[10px] uppercase font-mono px-2 py-0.5 rounded bg-slate-950/80 border border-slate-700 text-slate-300">
                        {{ $asset->type }}
                    </span>
                </div>
                <h3 class="text-sm font-bold tracking-tight">{{ $asset->name }}</h3>
                <div class="text-[11px] text-slate-500 mt-1 font-mono">
                    {{ $asset->resolution ?? '1920x1080' }} · Tema: {{ ucfirst($asset->theme ?? 'Default') }}
                </div>
                @if($asset->talent)
                <div class="text-[11px] text-sky-400 mt-1">Untuk: {{ $asset->talent->name }}</div>
                @endif
            </div>

            <div class="flex items-center justify-between pt-3 mt-3 border-t border-slate-800/60 text-xs">
                <span class="font-mono text-[11px] text-slate-400">Unduhan: {{ $asset->downloads }}</span>
                <form method="POST" action="{{ route('assets.destroy', $asset) }}" onsubmit="return confirm('Hapus aset ini?')">
                    @csrf @method('DELETE')
                    <button class="text-slate-500 hover:text-rose-400">
                        <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-16 text-slate-500 text-xs glass-auto rounded-2xl border border-slate-800">
            <i data-lucide="palette" class="w-8 h-8 mx-auto text-slate-600 mb-2"></i>
            Belum ada berkas aset tersimpan. Gunakan tombol generate untuk mulai merender.
        </div>
        @endforelse
    </div>

    <div>{{ $assets->links() }}</div>
</div>
@endsection
