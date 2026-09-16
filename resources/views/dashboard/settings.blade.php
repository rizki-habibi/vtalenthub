@extends('layouts.dashboard')
@section('title', 'Konfigurasi Sistem')
@section('page-title', 'Pengaturan')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div>
        <h1 class="text-xl font-bold tracking-tight">Konfigurasi Agensi & Akun</h1>
        <p class="text-xs text-slate-500 mt-0.5">Parameter profil pengelola, preferensi tema antarmuka, dan integrasi API.</p>
    </div>

    <div class="glass-auto rounded-3xl p-6 sm:p-8 space-y-6 border border-slate-200/50 dark:border-slate-800">
        <div>
            <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">Profil Pengguna</h3>
            <div class="space-y-3 text-xs">
                <div>
                    <label class="block text-slate-500 mb-1">Nama Pengelola</label>
                    <input type="text" value="{{ auth()->user()->name }}" disabled
                           class="w-full bg-slate-900/50 rounded-xl px-3.5 py-2 text-slate-400 border border-slate-800">
                </div>
                <div>
                    <label class="block text-slate-500 mb-1">Alamat Email</label>
                    <input type="text" value="{{ auth()->user()->email }}" disabled
                           class="w-full bg-slate-900/50 rounded-xl px-3.5 py-2 text-slate-400 border border-slate-800">
                </div>
                <div>
                    <label class="block text-slate-500 mb-1">Peran Akses (Role Session)</label>
                    <input type="text" value="{{ strtoupper(auth()->user()->role ?? 'ADMIN') }}" disabled
                           class="w-full bg-slate-900/50 rounded-xl px-3.5 py-2 text-sky-400 font-mono border border-slate-800">
                </div>
            </div>
        </div>

        <div class="pt-4 border-t border-slate-800">
            <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">Konektivitas Autentikasi Google OAuth</h3>
            <div class="p-3.5 rounded-xl bg-slate-900/60 border border-slate-800 flex items-center justify-between text-xs">
                <div>
                    <div class="font-semibold text-slate-200">Google Single Sign-On (SSO)</div>
                    <div class="text-[11px] text-slate-500 font-mono mt-0.5">
                        Status: {{ auth()->user()->google_id ? 'Terhubung' : 'Belum ditautkan' }}
                    </div>
                </div>
                <span class="text-[10px] px-2 py-0.5 rounded-full font-mono {{ auth()->user()->google_id ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/30' : 'bg-slate-800 text-slate-400 border border-slate-700' }}">
                    {{ auth()->user()->google_id ? 'CONNECTED' : 'STANDALONE' }}
                </span>
            </div>
        </div>

        <div class="pt-4 border-t border-slate-800">
            <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">Penyimpanan & Basis Data</h3>
            <div class="text-xs text-slate-400 space-y-1 font-mono">
                <div>Driver: SQLite 3.x Engine</div>
                <div>Lokasi: database/database.sqlite</div>
                <div>Format Schema: Terenkripsi & Didukung Migrasi Otomatis</div>
            </div>
        </div>
    </div>
</div>
@endsection
