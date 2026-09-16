@extends('layouts.app')
@section('title', 'Masuk ke Sistem')
@section('body')
<div class="min-h-screen flex items-center justify-center px-4 bg-gradient-to-br from-sky-500/5 via-slate-950/0 to-transparent">
    <div class="w-full max-w-md" data-aos="zoom-in">
        <div class="text-center mb-6">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2.5">
                <div class="w-9 h-9 rounded-xl bg-sky-500/15 border border-sky-400/30 flex items-center justify-center text-sky-400">
                    <i data-lucide="sparkles" class="w-5 h-5"></i>
                </div>
                <span class="text-lg font-bold tracking-tight bg-gradient-to-r from-sky-400 to-blue-500 bg-clip-text text-transparent">VTalentHub</span>
            </a>
        </div>
        <div class="glass-auto rounded-3xl p-6 sm:p-8 border border-slate-200/50 dark:border-slate-800 shadow-2xl">
            <h2 class="text-xl font-bold tracking-tight text-center">Masuk ke Portal Operasional</h2>
            <p class="text-center text-xs text-slate-500 mt-1">Akses dashboard data agency dan manajemen talent</p>

            @if($errors->any())
            <div class="bg-rose-500/10 border border-rose-500/30 text-rose-400 text-xs rounded-xl p-3 mt-4">
                {{ $errors->first() }}
            </div>
            @endif

            <!-- Google Login SSO -->
            <a href="{{ route('auth.google.redirect') }}" class="flex items-center justify-center gap-3 w-full mt-6 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 hover:bg-slate-100 dark:hover:bg-slate-800 transition-all font-medium text-xs">
                <svg class="w-4 h-4" viewBox="0 0 24 24"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 01-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
                <span>Masuk dengan Google OAuth</span>
            </a>

            <div class="flex items-center gap-3 my-5">
                <div class="flex-1 h-px bg-slate-200 dark:bg-slate-800"></div>
                <span class="text-[11px] font-mono text-slate-500 uppercase">Atau Kredensial</span>
                <div class="flex-1 h-px bg-slate-200 dark:bg-slate-800"></div>
            </div>

            <form method="POST" action="{{ route('login.post') }}" class="space-y-3.5">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-slate-400 mb-1">Alamat Email</label>
                    <input type="email" name="email" value="{{ old('email', 'admin@vtalenthub.internal') }}" required autofocus
                           class="w-full bg-slate-900/80 rounded-xl px-3.5 py-2 text-xs outline-none focus:ring-1 focus:ring-sky-400 border border-slate-800">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-400 mb-1">Kata Sandi</label>
                    <input type="password" name="password" value="password" required
                           class="w-full bg-slate-900/80 rounded-xl px-3.5 py-2 text-xs outline-none focus:ring-1 focus:ring-sky-400 border border-slate-800">
                </div>
                <div class="flex items-center justify-between text-xs text-slate-400">
                    <label class="flex items-center gap-1.5 cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded border-slate-700 bg-slate-900 text-sky-500">
                        <span>Ingat sesi saya</span>
                    </label>
                    <span class="text-[11px] font-mono text-slate-500">Demo: password</span>
                </div>
                <button type="submit" class="w-full bg-sky-500 hover:bg-sky-400 text-slate-950 py-2.5 rounded-xl font-semibold text-xs transition-all shadow-md shadow-sky-500/20">
                    Autentikasi Akun
                </button>
            </form>

            <p class="text-center text-xs text-slate-500 mt-5">
                Belum terdaftar? <a href="{{ route('register') }}" class="text-sky-400 font-semibold hover:underline">Registrasi Baru</a>
            </p>
        </div>
    </div>
</div>
@endsection
