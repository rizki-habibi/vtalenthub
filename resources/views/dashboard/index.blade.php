@extends('layouts.dashboard')
@section('title', 'Dashboard Overview')
@section('page-title', 'Overview // Matrix')

@section('content')
<div class="space-y-6 font-display">
    <!-- Hero Banner Comic -->
    <div class="comic-panel p-6 sm:p-8 bg-gradient-to-r from-sky-500/20 via-slate-900 to-slate-950 border-2 border-sky-400" data-aos="fade-down">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <span class="comic-tag text-[9px]">SESSION ACTIVE</span>
                    <span class="comic-tag-outline text-[9px] font-mono">[ROLE // {{ strtoupper(auth()->user()->role ?? 'ADMIN') }}]</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-black uppercase tracking-tight text-slate-100">
                    Selamat Bertugas, <span class="text-sky-400">{{ auth()->user()->name }}</span>
                </h1>
                <p class="text-xs font-mono text-slate-400 mt-1">
                    // Pusat operasi data agency: kelola talent, otomasi aset grafis, dan pantau kontrak komersial.
                </p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('talents.create') }}" class="btn-comic px-4 py-2 text-xs flex items-center gap-1.5">
                    <i data-lucide="plus" class="w-4 h-4"></i>
                    <span>+ Talent Baru</span>
                </a>
            </div>
        </div>
    </div>

    <!-- 4 Counter Metrics Comic Panel -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
        @php
        $cards = [
            ['label' => 'Total Talent Terdata', 'val' => $talentCount, 'icon' => 'users', 'sfx' => 'ACTIVE ROSTER'],
            ['label' => 'Aset Visual Selesai', 'val' => $assetCount, 'icon' => 'palette', 'sfx' => 'GENERATED'],
            ['label' => 'Kemitraan Klien Aktif', 'val' => $clientCount, 'icon' => 'briefcase', 'sfx' => 'COMMERCIAL'],
            ['label' => 'Total Nilai Kontrak', 'val' => 'Rp ' . number_format($totalRevenue, 0, ',', '.'), 'icon' => 'dollar-sign', 'sfx' => 'REVENUE GAIN'],
        ];
        @endphp
        @foreach($cards as $i => $c)
        <div class="comic-panel p-4 flex flex-col justify-between" data-aos="fade-up" data-aos-delay="{{ $i * 60 }}">
            <div class="flex items-start justify-between">
                <div>
                    <span class="text-[10px] font-mono text-slate-400 uppercase tracking-wider">{{ $c['label'] }}</span>
                    <div class="text-2xl font-black text-sky-400 font-mono mt-1 tracking-tight">{{ $c['val'] }}</div>
                </div>
                <div class="w-9 h-9 bg-sky-400 text-slate-950 border-2 border-slate-950 flex items-center justify-center font-bold">
                    <i data-lucide="{{ $c['icon'] }}" class="w-4 h-4"></i>
                </div>
            </div>
            <div class="mt-3 pt-2 border-t border-sky-400/20 text-[9px] font-mono text-slate-500 uppercase">
                [{{ $c['sfx'] }}]
            </div>
        </div>
        @endforeach
    </div>

    <!-- Quick Console Buttons -->
    <div class="grid sm:grid-cols-4 gap-3 font-mono text-xs">
        <a href="{{ route('talents.create') }}" class="comic-panel p-3 flex items-center gap-3 hover:border-sky-400 transition-all">
            <div class="w-8 h-8 bg-sky-400 text-slate-950 flex items-center justify-center font-bold shrink-0">
                <i data-lucide="user-plus" class="w-4 h-4"></i>
            </div>
            <div>
                <div class="font-bold text-slate-200">Daftar Talent</div>
                <div class="text-[10px] text-slate-500">[NEW ENTRY]</div>
            </div>
        </a>

        <a href="{{ route('assets.create') }}" class="comic-panel p-3 flex items-center gap-3 hover:border-sky-400 transition-all">
            <div class="w-8 h-8 bg-sky-400 text-slate-950 flex items-center justify-center font-bold shrink-0">
                <i data-lucide="wand-2" class="w-4 h-4"></i>
            </div>
            <div>
                <div class="font-bold text-slate-200">Generate Aset</div>
                <div class="text-[10px] text-slate-500">[RENDER VIZ]</div>
            </div>
        </a>

        <a href="{{ route('innovations.index') }}" class="comic-panel p-3 flex items-center gap-3 hover:border-sky-400 transition-all">
            <div class="w-8 h-8 bg-sky-400 text-slate-950 flex items-center justify-center font-bold shrink-0">
                <i data-lucide="sparkles" class="w-4 h-4"></i>
            </div>
            <div>
                <div class="font-bold text-slate-200">Inovasi AI</div>
                <div class="text-[10px] text-slate-500">[GAP ANALYSIS]</div>
            </div>
        </a>

        <a href="{{ route('clients.create') }}" class="comic-panel p-3 flex items-center gap-3 hover:border-sky-400 transition-all">
            <div class="w-8 h-8 bg-sky-400 text-slate-950 flex items-center justify-center font-bold shrink-0">
                <i data-lucide="folder-plus" class="w-4 h-4"></i>
            </div>
            <div>
                <div class="font-bold text-slate-200">Kemitraan Klien</div>
                <div class="text-[10px] text-slate-500">[DEAL PIPELINE]</div>
            </div>
        </a>
    </div>

    <!-- Dua Kolom Comic Panels -->
    <div class="grid lg:grid-cols-2 gap-6">
        <!-- Roster Talent Terkini -->
        <div class="comic-panel p-5">
            <div class="flex items-center justify-between pb-3 border-b-2 border-sky-400/30 mb-3">
                <div class="flex items-center gap-2">
                    <span class="comic-tag text-[9px]">PANEL A</span>
                    <h3 class="text-xs font-black uppercase tracking-wider text-slate-200">Roster Talent Terdaftar</h3>
                </div>
                <a href="{{ route('talents.index') }}" class="text-[10px] font-mono text-sky-400 hover:underline">[LIHAT SEMUA]</a>
            </div>

            <div class="space-y-2">
                @forelse($recentTalents as $t)
                <a href="{{ route('talents.show', $t) }}" class="flex items-center justify-between p-2.5 bg-slate-950/80 border border-slate-800 hover:border-sky-400 transition-colors">
                    <div class="flex items-center gap-2.5">
                        <div class="w-7 h-7 bg-sky-400 text-slate-950 font-black text-xs flex items-center justify-center border border-slate-950">
                            {{ strtoupper(substr($t->name, 0, 2)) }}
                        </div>
                        <div>
                            <div class="text-xs font-bold text-slate-200">{{ $t->name }}</div>
                            <div class="text-[10px] font-mono text-slate-500">{{ ucfirst($t->platform) }} // {{ strtoupper($t->model_type) }}</div>
                        </div>
                    </div>
                    <span class="comic-tag text-[8px]">{{ $t->status }}</span>
                </a>
                @empty
                <div class="text-center py-6 text-xs font-mono text-slate-500">[BELUM ADA TALENT TERDATA]</div>
                @endforelse
            </div>
        </div>

        <!-- Log Aktivitas Operasi -->
        <div class="comic-panel p-5">
            <div class="flex items-center justify-between pb-3 border-b-2 border-sky-400/30 mb-3">
                <div class="flex items-center gap-2">
                    <span class="comic-tag text-[9px]">PANEL B</span>
                    <h3 class="text-xs font-black uppercase tracking-wider text-slate-200">Log Aktivitas Operasi</h3>
                </div>
                <span class="text-[10px] font-mono text-slate-500">[SYS MONITOR]</span>
            </div>

            <div class="space-y-2 font-mono text-xs">
                @forelse($recentActivity as $act)
                <div class="p-2 bg-slate-950/80 border border-slate-800 flex items-start gap-2">
                    <span class="text-sky-400 font-bold">»</span>
                    <div class="flex-1">
                        <div class="text-slate-300 text-[11px]">{{ $act->description }}</div>
                        <div class="text-slate-500 text-[9px] mt-0.5">{{ $act->created_at->diffForHumans() }}</div>
                    </div>
                </div>
                @empty
                <div class="text-center py-6 text-xs font-mono text-slate-500">[BELUM ADA LOG AKTIVITAS]</div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Grafik Kontrak Bulanan -->
    <div class="comic-panel p-5">
        <div class="flex items-center justify-between pb-3 border-b-2 border-sky-400/30 mb-4">
            <div class="flex items-center gap-2">
                <span class="comic-tag text-[9px]">METRIC // GRAPH</span>
                <h3 class="text-xs font-black uppercase tracking-wider text-slate-200">Tren Kontrak Selesai (Bulan)</h3>
            </div>
            <span class="text-[10px] font-mono text-emerald-400">[REVENUE TRACKER]</span>
        </div>
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
                backgroundColor: 'rgba(56, 189, 248, 0.15)',
                fill: true,
                tension: 0.1,
                borderWidth: 3,
                pointBackgroundColor: '#38bdf8',
                pointBorderColor: '#060b18',
                pointBorderWidth: 2,
                pointRadius: 5,
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: { grid: { color: 'rgba(56, 189, 248, 0.1)' } },
                x: { grid: { display: false } }
            }
        }
    });
});
</script>
@endpush
@endsection
