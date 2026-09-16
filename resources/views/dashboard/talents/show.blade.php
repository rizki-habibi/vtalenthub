@extends('layouts.dashboard')
@section('title', 'Detail Talent — ' . $talent->name)
@section('page-title', 'Talent / ' . $talent->name)

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <a href="{{ route('talents.index') }}" class="text-xs text-slate-400 hover:text-sky-400 flex items-center gap-1.5">
            <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
            <span>Kembali ke Katalog</span>
        </a>
        <div class="flex items-center gap-2">
            <a href="{{ route('talents.edit', $talent) }}" class="px-3 py-1.5 rounded-xl border border-slate-700 text-xs font-medium hover:bg-slate-800 flex items-center gap-1.5">
                <i data-lucide="pencil" class="w-3.5 h-3.5"></i>
                <span>Edit</span>
            </a>
        </div>
    </div>

    <!-- Header Card -->
    <div class="glass-auto rounded-3xl p-6 sm:p-8 border border-slate-200/50 dark:border-slate-800">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 rounded-2xl bg-sky-500/10 border border-sky-400/30 text-sky-400 font-bold text-xl flex items-center justify-center">
                    {{ strtoupper(substr($talent->name, 0, 2)) }}
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <h1 class="text-2xl font-bold tracking-tight">{{ $talent->name }}</h1>
                        <span class="text-xs px-2.5 py-0.5 rounded-full font-medium {{ $talent->status === 'active' ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' : 'bg-amber-500/10 text-amber-400 border border-amber-500/20' }}">
                            {{ ucfirst($talent->status) }}
                        </span>
                    </div>
                    <div class="text-xs text-slate-500 mt-1 font-mono">Platform: {{ ucfirst($talent->platform) }} · Model: {{ strtoupper($talent->model_type) }}</div>
                </div>
            </div>
            <div class="text-right">
                <div class="text-xs text-slate-500">Estimasi Pendapatan Bulanan</div>
                <div class="text-xl font-bold text-sky-400 font-mono">Rp {{ number_format($talent->monthly_revenue, 0, ',', '.') }}</div>
            </div>
        </div>

        @if($talent->bio)
        <div class="mt-6 pt-6 border-t border-slate-200/50 dark:border-slate-800">
            <h4 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Lore / Biografi Karakter</h4>
            <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">{{ $talent->bio }}</p>
        </div>
        @endif
    </div>

    <!-- Kebutuhan Aset -->
    <div class="glass-auto rounded-3xl p-6 sm:p-8 border border-slate-200/50 dark:border-slate-800">
        <h3 class="text-sm font-bold uppercase tracking-wider text-slate-400 mb-4">Daftar Kebutuhan Produksi Aset</h3>
        <div class="grid sm:grid-cols-2 gap-3">
            @forelse($talent->needs as $need)
            <div class="p-3 rounded-xl bg-slate-900/60 border border-slate-800 flex items-center justify-between text-xs">
                <div class="flex items-center gap-2">
                    <i data-lucide="check-circle-2" class="w-4 h-4 text-sky-400"></i>
                    <span class="font-medium capitalize">{{ str_replace('_', ' ', $need->need_type) }}</span>
                </div>
                <span class="text-[10px] px-2 py-0.5 rounded-full bg-slate-800 text-slate-400 border border-slate-700 uppercase font-mono">
                    {{ $need->status }}
                </span>
            </div>
            @empty
            <div class="col-span-full text-center py-6 text-xs text-slate-500">Belum ada item kebutuhan yang didaftarkan.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
