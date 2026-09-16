@extends('layouts.dashboard')
@section('title', 'Dashboard Overview')
@section('page-title', 'Overview')

@section('content')
<div class="space-y-8">
    <div class="glass-auto rounded-2xl p-6 sm:p-8 border border-sky-500/20 bg-gradient-to-r from-sky-500/10 via-sky-500/5 to-transparent" data-aos="fade-down">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <span class="text-xs font-semibold uppercase tracking-wider text-sky-400">Virtual Talent Operation</span>
                <h1 class="text-2xl font-bold mt-1">Halo, {{ auth()->user()->name }}</h1>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Platform operasional data agency untuk ekosistem VTuber.</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('talents.create') }}" class="bg-sky-500 hover:bg-sky-400 text-slate-950 px-4 py-2 rounded-xl text-xs font-semibold transition-all flex items-center gap-1.5 shadow-lg shadow-sky-500/20">
                    <i data-lucide="plus" class="w-4 h-4"></i>
                    <span>Talent Baru</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Metrics -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
        @php
        $cards = [
            ['label' => 'Total Talent Terdata', 'val' => $talentCount, 'icon' => 'users', 'color' => 'text-sky-400', 'bg' => 'bg-sky-500/10'],
            ['label' => 'Asset Terbuat', 'val' => $assetCount, 'icon' => 'palette', 'color' => 'text-blue-400', 'bg' => 'bg-blue-500/10'],
            ['label' => 'Client Aktif', 'val' => $clientCount, 'icon' => 'briefcase', 'color' => 'text-emerald-400', 'bg' => 'bg-emerald-500/10'],
            ['label' => 'Total Nilai Kontrak', 'val' => 'Rp ' . number_format($totalRevenue, 0, ',', '.'), 'icon' => 'dollar-sign', 'color' => 'text-amber-400', 'bg' => 'bg-amber-500/10'],
        ];
        @endphp
        @foreach($cards as $i => $c)
        <div class="glass-auto rounded-2xl p-5 border border-slate-200/50 dark:border-slate-800" data-aos="fade-up" data-aos-delay="{{ $i * 80 }}">
            <div class="flex items-center justify-between">
                <div>
                    <span class="text-xs text-slate-500">{{ $c['label'] }}</span>
                    <div class="text-2xl font-bold mt-1 tracking-tight">{{ $c['val'] }}</div>
                </div>
                <div class="w-11 h-11 rounded-xl {{ $c['bg'] }} {{ $c['color'] }} flex items-center justify-center">
                    <i data-lucide="{{ $c['icon'] }}" class="w-5 h-5"></i>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Quick Links -->
    <div class="grid sm:grid-cols-4 gap-4">
        <a href="{{ route('talents.create') }}" class="glass-auto rounded-xl p-4 border border-slate-200/50 dark:border-slate-800 hover:border-sky-500/40 transition-colors flex items-center gap-3">
            <div class="w-9 h-9 rounded-lg bg-sky-500/10 text-sky-400 flex items-center justify-center shrink-0">
                <i data-lucide="user-plus" class="w-4 h-4"></i>
            </div>
            <div class="text-xs font-semibold">Daftar Talent</div>
        </a>
        <a href="{{ route('assets.create') }}" class="glass-auto rounded-xl p-4 border border-slate-200/50 dark:border-slate-800 hover:border-sky-500/40 transition-colors flex items-center gap-3">
            <div class="w-9 h-9 rounded-lg bg-sky-500/10 text-sky-400 flex items-center justify-center shrink-0">
                <i data-lucide="wand-2" class="w-4 h-4"></i>
            </div>
            <div class="text-xs font-semibold">Generate Asset</div>
        </a>
        <a href="{{ route('clients.create') }}" class="glass-auto rounded-xl p-4 border border-slate-200/50 dark:border-slate-800 hover:border-sky-500/40 transition-colors flex items-center gap-3">
            <div class="w-9 h-9 rounded-lg bg-sky-500/10 text-sky-400 flex items-center justify-center shrink-0">
                <i data-lucide="folder-plus" class="w-4 h-4"></i>
            </div>
            <div class="text-xs font-semibold">Kolaborasi Client</div>
        </a>
        <a href="{{ route('counseling.index') }}" class="glass-auto rounded-xl p-4 border border-slate-200/50 dark:border-slate-800 hover:border-sky-500/40 transition-colors flex items-center gap-3">
            <div class="w-9 h-9 rounded-lg bg-sky-500/10 text-sky-400 flex items-center justify-center shrink-0">
                <i data-lucide="bot" class="w-4 h-4"></i>
            </div>
            <div class="text-xs font-semibold">Konseling Virtual</div>
        </a>
    </div>

    <div class="grid lg:grid-cols-2 gap-6">
        <!-- Recent Talents -->
        <div class="glass-auto rounded-2xl p-6 border border-slate-200/50 dark:border-slate-800" data-aos="fade-right">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-bold uppercase tracking-wider text-slate-400">Talent Terdaftar Terakhir</h3>
                <a href="{{ route('talents.index') }}" class="text-xs text-sky-400 hover:underline">Semua</a>
            </div>
            <div class="space-y-2">
                @forelse($recentTalents as $t)
                <a href="{{ route('talents.show', $t) }}" class="flex items-center justify-between p-3 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800/50 transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-sky-500/10 text-sky-400 flex items-center justify-center text-xs font-bold">
                            {{ strtoupper(substr($t->name, 0, 2)) }}
                        </div>
                        <div>
                            <div class="text-sm font-semibold">{{ $t->name }}</div>
                            <div class="text-xs text-slate-500">{{ ucfirst($t->platform) }} · {{ strtoupper($t->model_type) }}</div>
                        </div>
                    </div>
                    <span class="text-xs px-2.5 py-0.5 rounded-full font-medium {{ $t->status === 'active' ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' : 'bg-amber-500/10 text-amber-400 border border-amber-500/20' }}">
                        {{ ucfirst($t->status) }}
                    </span>
                </a>
                @empty
                <div class="text-center py-8 text-xs text-slate-500">Belum ada talent terdata.</div>
                @endforelse
            </div>
        </div>

        <!-- Activity Logs -->
        <div class="glass-auto rounded-2xl p-6 border border-slate-200/50 dark:border-slate-800" data-aos="fade-left">
            <h3 class="text-sm font-bold uppercase tracking-wider text-slate-400 mb-4">Aktivitas Sistem</h3>
            <div class="space-y-3">
                @forelse($recentActivity as $act)
                <div class="flex items-start gap-3 text-xs">
                    <div class="w-1.5 h-1.5 rounded-full bg-sky-400 mt-1.5 shrink-0"></div>
                    <div class="flex-1">
                        <div>{{ $act->description }}</div>
                        <div class="text-slate-500 text-[11px] mt-0.5">{{ $act->created_at->diffForHumans() }}</div>
                    </div>
                </div>
                @empty
                <div class="text-center py-8 text-xs text-slate-500">Belum ada aktivitas tercatat.</div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Chart -->
    <div class="glass-auto rounded-2xl p-6 border border-slate-200/50 dark:border-slate-800">
        <h3 class="text-sm font-bold uppercase tracking-wider text-slate-400 mb-4">Tren Kontrak Selesai (Bulan)</h3>
        <canvas id="revenueChart" height="70"></canvas>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const raw = @json($monthlyRevenue);
    const labels = raw.length ? raw.map(r => r.month) : ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'];
    const values = raw.length ? raw.map(r => r.total) : [0, 0, 0, 0, 0, 0];
    new Chart(document.getElementById('revenueChart'), {
        type: 'line',
        data: {
            labels,
            datasets: [{
                label: 'Nilai Deal (Rp)',
                data: values,
                borderColor: '#38bdf8',
                backgroundColor: 'rgba(56, 189, 248, 0.1)',
                fill: true,
                tension: 0.35,
                borderWidth: 2,
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: { grid: { color: 'rgba(148, 163, 184, 0.1)' } },
                x: { grid: { display: false } }
            }
        }
    });
});
</script>
@endpush
@endsection
