@extends('layouts.dashboard')
@section('title', 'Tambah Talent')
@section('page-title', 'Tambah Talent')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold">🎭 Tambah Talent Baru</h1>
            <p class="text-sm text-gray-500">Daftarkan Virtual Talent ke dalam sistem agency.</p>
        </div>
        <a href="{{ route('talents.index') }}" class="text-sm text-gray-500 hover:text-primary">← Kembali</a>
    </div>

    <form method="POST" action="{{ route('talents.store') }}" class="glass rounded-2xl p-6 sm:p-8 space-y-6">
        @csrf

        @if($errors->any())
        <div class="bg-red-500/10 border border-red-500/30 text-red-400 p-4 rounded-xl text-sm">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach
            </ul>
        </div>
        @endif

        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Nama VTuber *</label>
                <input type="text" name="name" value="{{ old('name') }}" required placeholder="Contoh: Sakura Miko"
                       class="w-full bg-gray-100 dark:bg-gray-800 rounded-xl px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-primary/50">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Nama Asli / Behind The Scene</label>
                <input type="text" name="real_name" value="{{ old('real_name') }}" placeholder="Opsional (rahasia)"
                       class="w-full bg-gray-100 dark:bg-gray-800 rounded-xl px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-primary/50">
            </div>
        </div>

        <div class="grid sm:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Platform Utama *</label>
                <select name="platform" required class="w-full bg-gray-100 dark:bg-gray-800 rounded-xl px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-primary/50">
                    <option value="youtube">YouTube</option>
                    <option value="twitch">Twitch</option>
                    <option value="tiktok">TikTok</option>
                    <option value="bilibili">Bilibili</option>
                    <option value="multi">Multi-Platform</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Status Onboarding *</label>
                <select name="status" required class="w-full bg-gray-100 dark:bg-gray-800 rounded-xl px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-primary/50">
                    <option value="onboarding">Onboarding</option>
                    <option value="active">Aktif</option>
                    <option value="inactive">Nonaktif</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Tipe Model *</label>
                <select name="model_type" required class="w-full bg-gray-100 dark:bg-gray-800 rounded-xl px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-primary/50">
                    <option value="none">Belum Ada</option>
                    <option value="png">PNG Tuber</option>
                    <option value="live2d">Live2D</option>
                    <option value="3d">3D Model</option>
                </select>
            </div>
        </div>

        <div class="grid sm:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Subscribers / Followers</label>
                <input type="number" name="subscribers" value="{{ old('subscribers', 0) }}" min="0"
                       class="w-full bg-gray-100 dark:bg-gray-800 rounded-xl px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-primary/50">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Genre Konten</label>
                <input type="text" name="genre" value="{{ old('genre') }}" placeholder="Gaming, ASMR, Music"
                       class="w-full bg-gray-100 dark:bg-gray-800 rounded-xl px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-primary/50">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Bahasa</label>
                <input type="text" name="language" value="{{ old('language', 'ID') }}"
                       class="w-full bg-gray-100 dark:bg-gray-800 rounded-xl px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-primary/50">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Bio / Lore Singkat</label>
            <textarea name="bio" rows="3" placeholder="Ceritakan latar belakang karakter VTuber..."
                      class="w-full bg-gray-100 dark:bg-gray-800 rounded-xl p-4 text-sm outline-none focus:ring-2 focus:ring-primary/50 resize-none">{{ old('bio') }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium mb-2">Kebutuhan Awal Talent (Asset / Support)</label>
            <div class="grid sm:grid-cols-3 gap-2">
                @foreach(['model' => 'Model Karakter', 'rigging' => 'Live2D/3D Rigging', 'background' => 'Stream Background', 'overlay' => 'Stream Overlay', 'emotes' => 'Emote Pack', 'logo' => 'Logo & Branding', 'banner' => 'Banner / Wallpaper', 'bgm' => 'BGM / Sound Effect', 'schedule' => 'Schedule Card'] as $k => $v)
                <label class="flex items-center gap-2 text-xs bg-gray-100 dark:bg-gray-800/50 p-2.5 rounded-lg cursor-pointer hover:bg-primary/10">
                    <input type="checkbox" name="needs[]" value="{{ $k }}" class="rounded text-primary">
                    <span>{{ $v }}</span>
                </label>
                @endforeach
            </div>
        </div>

        <div class="flex justify-end gap-3 pt-4 border-t border-gray-200/30 dark:border-gray-700/30">
            <a href="{{ route('talents.index') }}" class="px-5 py-2.5 rounded-xl text-sm font-medium hover:bg-gray-100 dark:hover:bg-gray-800">Batal</a>
            <button type="submit" class="bg-primary hover:bg-primary-dark text-white px-6 py-2.5 rounded-xl text-sm font-semibold transition-all">Simpan Talent</button>
        </div>
    </form>
</div>
@endsection
