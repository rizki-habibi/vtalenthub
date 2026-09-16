@extends('layouts.dashboard')
@section('title', 'Pipeline Kemitraan Client')
@section('page-title', 'Client & Deal Pipeline')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-xl font-bold tracking-tight">Pipeline Kemitraan Sponsor & Brand</h1>
            <p class="text-xs text-slate-500 mt-0.5">Kelola kesepakatan komersial, kontrak endorsement, dan penagihan agensi.</p>
        </div>
        <a href="{{ route('clients.create') }}" class="bg-sky-500 hover:bg-sky-400 text-slate-950 px-4 py-2 rounded-xl text-xs font-semibold transition-all flex items-center gap-1.5 shadow-md shadow-sky-500/20">
            <i data-lucide="folder-plus" class="w-4 h-4"></i>
            <span>Tambah Brand Kemitraan</span>
        </a>
    </div>

    <!-- Pipeline Summary -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3">
        @php
        $pipe = [
            ['stage' => 'Lead Baru', 'count' => $pipeline['lead'], 'val' => $pipeline['lead_value'], 'color' => 'text-slate-400', 'border' => 'border-slate-800'],
            ['stage' => 'Tahap Negosiasi', 'count' => $pipeline['negotiation'], 'val' => $pipeline['negotiation_value'], 'color' => 'text-amber-400', 'border' => 'border-amber-500/30'],
            ['stage' => 'Kontrak Berjalan', 'count' => $pipeline['active'], 'val' => $pipeline['active_value'], 'color' => 'text-sky-400', 'border' => 'border-sky-500/30'],
            ['stage' => 'Penyelesaian Selesai', 'count' => $pipeline['completed'], 'val' => $pipeline['completed_value'], 'color' => 'text-emerald-400', 'border' => 'border-emerald-500/30'],
        ];
        @endphp
        @foreach($pipe as $p)
        <div class="glass-auto rounded-2xl p-4 border {{ $p['border'] }}">
            <div class="text-[11px] text-slate-500 uppercase tracking-wider">{{ $p['stage'] }}</div>
            <div class="text-xl font-bold mt-1 tracking-tight {{ $p['color'] }}">{{ $p['count'] }} Deal</div>
            <div class="text-xs text-slate-400 font-mono mt-0.5">Rp {{ number_format($p['val'], 0, ',', '.') }}</div>
        </div>
        @endforeach
    </div>

    <!-- Table -->
    <div class="glass-auto rounded-2xl border border-slate-200/50 dark:border-slate-800 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-xs text-left">
                <thead class="bg-slate-900/60 border-b border-slate-800 text-slate-400 font-semibold uppercase tracking-wider">
                    <tr>
                        <th class="p-3.5">Brand / Entitas</th>
                        <th class="p-3.5">Tipe Kerjasama</th>
                        <th class="p-3.5">Talent Terkait</th>
                        <th class="p-3.5">Nilai Deal</th>
                        <th class="p-3.5">Status</th>
                        <th class="p-3.5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800">
                    @forelse($clients as $c)
                    <tr class="hover:bg-slate-900/40 transition-colors">
                        <td class="p-3.5 font-semibold">
                            <div>{{ $c->name }}</div>
                            <div class="text-[11px] text-slate-500 font-normal">{{ $c->company ?? '-' }}</div>
                        </td>
                        <td class="p-3.5 uppercase text-[10px] font-mono text-slate-400">{{ $c->type }}</td>
                        <td class="p-3.5 text-sky-400">{{ $c->talent?->name ?? 'Seluruh Talent' }}</td>
                        <td class="p-3.5 font-mono text-emerald-400 font-medium">Rp {{ number_format($c->deal_value, 0, ',', '.') }}</td>
                        <td class="p-3.5">
                            <span class="text-[10px] uppercase font-mono px-2 py-0.5 rounded-full border 
                                {{ $c->status === 'completed' ? 'bg-emerald-500/10 text-emerald-400 border-emerald-500/30' : '' }}
                                {{ $c->status === 'active' ? 'bg-sky-500/10 text-sky-400 border-sky-500/30' : '' }}
                                {{ $c->status === 'negotiation' ? 'bg-amber-500/10 text-amber-400 border-amber-500/30' : '' }}
                                {{ $c->status === 'lead' ? 'bg-slate-800 text-slate-400 border-slate-700' : '' }}">
                                {{ $c->status }}
                            </span>
                        </td>
                        <td class="p-3.5 text-right">
                            <form method="POST" action="{{ route('clients.destroy', $c) }}" onsubmit="return confirm('Hapus data kemitraan ini?')">
                                @csrf @method('DELETE')
                                <button class="text-slate-500 hover:text-rose-400">
                                    <i data-lucide="trash-2" class="w-3.5 h-3.5 inline"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-12 text-slate-500 text-xs">
                            Belum ada entri kesepakatan kerjasama brand tercatat.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div>{{ $clients->links() }}</div>
</div>
@endsection
