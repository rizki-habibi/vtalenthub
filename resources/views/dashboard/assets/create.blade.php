@extends('layouts.dashboard')
@section('title', 'Generate Aset')
@section('page-title', 'Asset Studio / Generate')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl font-bold">Generator Sintesis Aset Visual</h1>
            <p class="text-xs text-slate-500">Buat spesifikasi aset grafis baru untuk stream VTuber.</p>
        </div>
        <a href="{{ route('assets.index') }}" class="text-xs text-slate-400 hover:text-sky-400">Kembali</a>
    </div>

    <form method="POST" action="{{ route('assets.store') }}" class="glass-auto rounded-3xl p-6 sm:p-8 space-y-4 border border-slate-200/50 dark:border-slate-800">
        @csrf

        <div>
            <label class="block text-xs font-semibold text-slate-400 mb-1">Judul / Identifikasi Aset</label>
            <input type="text" name="name" required placeholder="Misal: Cyber City Night Backdrop"
                   class="w-full bg-slate-900/80 rounded-xl px-3.5 py-2 text-xs outline-none focus:ring-1 focus:ring-sky-400 border border-slate-800">
        </div>

        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold text-slate-400 mb-1">Kategori Aset</label>
                <select name="type" required class="w-full bg-slate-900/80 rounded-xl px-3.5 py-2 text-xs outline-none border border-slate-800">
                    <option value="background">Stream Background</option>
                    <option value="overlay">Stream Overlay HUD</option>
                    <option value="wallpaper">Wallpaper & Banner</option>
                    <option value="emotes">Emote Pack (Chibi)</option>
                    <option value="logo">Logo & Watermark</option>
                    <option value="schedule">Jadwal Siaran Mingguan</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-400 mb-1">Peruntukan Talent (Opsional)</label>
                <select name="talent_id" class="w-full bg-slate-900/80 rounded-xl px-3.5 py-2 text-xs outline-none border border-slate-800">
                    <option value="">Aset Publik Agensi</option>
                    @foreach($talents as $t)
                    <option value="{{ $t->id }}">{{ $t->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid sm:grid-cols-3 gap-4">
            <div>
                <label class="block text-xs font-semibold text-slate-400 mb-1">Palet / Nuansa</label>
                <input type="text" name="theme" placeholder="Cyberpunk, Kawaii Pastel, Sci-fi"
                       class="w-full bg-slate-900/80 rounded-xl px-3.5 py-2 text-xs outline-none border border-slate-800">
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-400 mb-1">Resolusi Target</label>
                <select name="resolution" class="w-full bg-slate-900/80 rounded-xl px-3.5 py-2 text-xs outline-none border border-slate-800">
                    <option value="1920x1080">1920x1080 (FHD)</option>
                    <option value="2560x1440">2560x1440 (2K)</option>
                    <option value="1080x1920">1080x1920 (Vertical/Shorts)</option>
                    <option value="128x128">128x128 (Twitch Emote)</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-400 mb-1">Warna Dominan</label>
                <input type="color" name="color" value="#38bdf8" class="w-full h-8 bg-slate-900/80 rounded-xl border border-slate-800 cursor-pointer">
            </div>
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-400 mb-1">Catatan Panduan Render</label>
            <textarea name="notes" rows="3" placeholder="Instruksi penempatan chatbox, kamera, partikel latar..."
                      class="w-full bg-slate-900/80 rounded-xl p-3 text-xs outline-none focus:ring-1 focus:ring-sky-400 border border-slate-800 resize-none"></textarea>
        </div>

        <div class="flex justify-end gap-3 pt-4 border-t border-slate-800">
            <a href="{{ route('assets.index') }}" class="px-4 py-2 rounded-xl text-xs font-medium hover:bg-slate-800">Batal</a>
            <button type="submit" class="bg-sky-500 hover:bg-sky-400 text-slate-950 px-5 py-2 rounded-xl text-xs font-semibold transition-all">
                Mulai Sintesis
            </button>
        </div>
    </form>
</div>
@endsection
