@extends('layouts.dashboard')
@section('title', 'Perbarui Talent — ' . $talent->name)
@section('page-title', 'Edit / ' . $talent->name)

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl font-bold">Perbarui Profil Talent</h1>
            <p class="text-xs text-slate-500">Ubah data identitas virtual atau status kesiapan siaran.</p>
        </div>
        <a href="{{ route('talents.show', $talent) }}" class="text-xs text-slate-400 hover:text-sky-400">Kembali</a>
    </div>

    <form method="POST" action="{{ route('talents.update', $talent) }}" class="glass-auto rounded-3xl p-6 sm:p-8 space-y-4 border border-slate-200/50 dark:border-slate-800">
        @csrf @method('PUT')

        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold text-slate-400 mb-1">Nama Karakter</label>
                <input type="text" name="name" value="{{ old('name', $talent->name) }}" required
                       class="w-full bg-slate-900/80 rounded-xl px-3.5 py-2 text-xs outline-none focus:ring-1 focus:ring-sky-400 border border-slate-800">
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-400 mb-1">Nama Asli / Catatan Internal</label>
                <input type="text" name="real_name" value="{{ old('real_name', $talent->real_name) }}"
                       class="w-full bg-slate-900/80 rounded-xl px-3.5 py-2 text-xs outline-none focus:ring-1 focus:ring-sky-400 border border-slate-800">
            </div>
        </div>

        <div class="grid sm:grid-cols-3 gap-4">
            <div>
                <label class="block text-xs font-semibold text-slate-400 mb-1">Platform Siaran</label>
                <select name="platform" class="w-full bg-slate-900/80 rounded-xl px-3.5 py-2 text-xs outline-none border border-slate-800">
                    <option value="youtube" {{ $talent->platform === 'youtube' ? 'selected' : '' }}>YouTube</option>
                    <option value="twitch" {{ $talent->platform === 'twitch' ? 'selected' : '' }}>Twitch</option>
                    <option value="tiktok" {{ $talent->platform === 'tiktok' ? 'selected' : '' }}>TikTok</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-400 mb-1">Status Kesiapan</label>
                <select name="status" class="w-full bg-slate-900/80 rounded-xl px-3.5 py-2 text-xs outline-none border border-slate-800">
                    <option value="onboarding" {{ $talent->status === 'onboarding' ? 'selected' : '' }}>Onboarding</option>
                    <option value="active" {{ $talent->status === 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="inactive" {{ $talent->status === 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-400 mb-1">Spesifikasi Model</label>
                <select name="model_type" class="w-full bg-slate-900/80 rounded-xl px-3.5 py-2 text-xs outline-none border border-slate-800">
                    <option value="none" {{ $talent->model_type === 'none' ? 'selected' : '' }}>Belum Ada</option>
                    <option value="png" {{ $talent->model_type === 'png' ? 'selected' : '' }}>PNG Tuber</option>
                    <option value="live2d" {{ $talent->model_type === 'live2d' ? 'selected' : '' }}>Live2D</option>
                    <option value="3d" {{ $talent->model_type === '3d' ? 'selected' : '' }}>3D Model</option>
                </select>
            </div>
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-400 mb-1">Bio / Lore Karakter</label>
            <textarea name="bio" rows="4" class="w-full bg-slate-900/80 rounded-xl p-3 text-xs outline-none focus:ring-1 focus:ring-sky-400 border border-slate-800 resize-none">{{ old('bio', $talent->bio) }}</textarea>
        </div>

        <div class="flex justify-end gap-3 pt-4 border-t border-slate-800">
            <a href="{{ route('talents.show', $talent) }}" class="px-4 py-2 rounded-xl text-xs font-medium hover:bg-slate-800">Batal</a>
            <button type="submit" class="bg-sky-500 hover:bg-sky-400 text-slate-950 px-5 py-2 rounded-xl text-xs font-semibold transition-all">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
