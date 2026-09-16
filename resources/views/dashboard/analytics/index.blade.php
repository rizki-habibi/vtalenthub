@extends('layouts.dashboard')
@section('title', 'Analitik Data Agensi')
@section('page-title', 'Ecosystem Analytics')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-xl font-bold tracking-tight">Analitik Ekosistem Agensi Virtual</h1>
            <p class="text-xs text-slate-500 mt-0.5">Metrik distribusi platform siaran, status talent, dan performa komersial.</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('analytics.export', ['type' => 'all']) }}" class="px-3 py-1.5 rounded-xl border border-slate-700 hover:bg-slate-800 text-xs font-semibold flex items-center gap-1.5 transition-colors">
                <i data-lucide="download" class="w-3.5 h-3.5"></i>
                <span>Ekspor JSON</span>
            </a>
        </div>
    </div>

    <!-- Chart Grid -->
    <div class="grid md:grid-cols-2 gap-6">
        <!-- Chart 1: Platform -->
        <div class="glass-auto rounded-2xl p-5 border border-slate-200/50 dark:border-slate-800">
            <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">Distribusi Platform Siaran</h3>
            <canvas id="platformChart" height="150"></canvas>
        </div>

        <!-- Chart 2: Status Talent -->
        <div class="glass-auto rounded-2xl p-5 border border-slate-200/50 dark:border-slate-800">
            <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">Status Kesiapan Siaran</h3>
            <canvas id="statusChart" height="150"></canvas>
        </div>

        <!-- Chart 3: Kategori Aset -->
        <div class="glass-auto rounded-2xl p-5 border border-slate-200/50 dark:border-slate-800">
            <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">Komposisi Aset Tergenerate</h3>
            <canvas id="assetChart" height="150"></canvas>
        </div>

        <!-- Chart 4: Tipe Kerjasama Sponsor -->
        <div class="glass-auto rounded-2xl p-5 border border-slate-200/50 dark:border-slate-800">
            <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">Kategori Kemitraan Komersial</h3>
            <canvas id="revenueTypeChart" height="150"></canvas>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', async () => {
    try {
        const res = await fetch('{{ route("analytics.data") }}');
        const data = await res.json();

        // Platform Chart
        new Chart(document.getElementById('platformChart'), {
            type: 'doughnut',
            data: {
                labels: data.platforms.map(p => p.platform.toUpperCase()),
                datasets: [{
                    data: data.platforms.map(p => p.count),
                    backgroundColor: ['#38bdf8', '#818cf8', '#34d399', '#fbbf24', '#f472b6'],
                    borderWidth: 0,
                }]
            },
            options: { plugins: { legend: { position: 'bottom', labels: { boxWidth: 12, font: { size: 10 } } } } }
        });

        // Status Chart
        new Chart(document.getElementById('statusChart'), {
            type: 'pie',
            data: {
                labels: data.statuses.map(s => s.status.toUpperCase()),
                datasets: [{
                    data: data.statuses.map(s => s.count),
                    backgroundColor: ['#10b981', '#f59e0b', '#64748b'],
                    borderWidth: 0,
                }]
            },
            options: { plugins: { legend: { position: 'bottom', labels: { boxWidth: 12, font: { size: 10 } } } } }
        });

        // Asset Chart
        new Chart(document.getElementById('assetChart'), {
            type: 'bar',
            data: {
                labels: data.assetCategories.map(a => a.type),
                datasets: [{
                    label: 'Jumlah Aset',
                    data: data.assetCategories.map(a => a.count),
                    backgroundColor: 'rgba(56, 189, 248, 0.4)',
                    borderColor: '#38bdf8',
                    borderWidth: 1.5,
                    borderRadius: 6,
                }]
            },
            options: {
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { color: 'rgba(148, 163, 184, 0.1)' } },
                    x: { grid: { display: false } }
                }
            }
        });

        // Revenue Type
        new Chart(document.getElementById('revenueTypeChart'), {
            type: 'bar',
            data: {
                labels: data.revenueByType.map(r => r.type),
                datasets: [{
                    label: 'Nilai Deal (Rp)',
                    data: data.revenueByType.map(r => r.total),
                    backgroundColor: 'rgba(52, 211, 153, 0.4)',
                    borderColor: '#34d399',
                    borderWidth: 1.5,
                    borderRadius: 6,
                }]
            },
            options: {
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { color: 'rgba(148, 163, 184, 0.1)' } },
                    x: { grid: { display: false } }
                }
            }
        });
    } catch (e) {
        console.error(e);
    }
});
</script>
@endpush
@endsection
