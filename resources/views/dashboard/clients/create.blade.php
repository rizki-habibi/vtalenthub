@extends('layouts.dashboard')
@section('title', 'Pencatatan Client Baru')
@section('page-title', 'Client / Entri Baru')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl font-bold">Entri Kemitraan Komersial</h1>
            <p class="text-xs text-slate-500">Pencatatan negosiasi sponsorship, penempatan produk, atau sewa talent.</p>
        </div>
        <a href="{{ route('clients.index') }}" class="text-xs text-slate-400 hover:text-sky-400">Kembali</a>
    </div>

    <form method="POST" action="{{ route('clients.store') }}" class="glass-auto rounded-3xl p-6 sm:p-8 space-y-4 border border-slate-200/50 dark:border-slate-800">
        @csrf

        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold text-slate-400 mb-1">Nama Brand / Klien *</label>
                <input type="text" name="name" required placeholder="Contoh: Asus ROG Indonesia"
                       class="w-full bg-slate-900/80 rounded-xl px-3.5 py-2 text-xs outline-none focus:ring-1 focus:ring-sky-400 border border-slate-800">
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-400 mb-1">Perusahaan / Entitas</label>
                <input type="text" name="company" placeholder="Nama PT atau Brand Group"
                       class="w-full bg-slate-900/80 rounded-xl px-3.5 py-2 text-xs outline-none focus:ring-1 focus:ring-sky-400 border border-slate-800">
            </div>
        </div>

        <div class="grid sm:grid-cols-3 gap-4">
            <div>
                <label class="block text-xs font-semibold text-slate-400 mb-1">Nama Kontak PIC</label>
                <input type="text" name="contact_person" placeholder="Nama narahubung"
                       class="w-full bg-slate-900/80 rounded-xl px-3.5 py-2 text-xs outline-none border border-slate-800">
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-400 mb-1">Email Resmi</label>
                <input type="email" name="email" placeholder="sponsor@brand.com"
                       class="w-full bg-slate-900/80 rounded-xl px-3.5 py-2 text-xs outline-none border border-slate-800">
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-400 mb-1">Nomor Telepon</label>
                <input type="text" name="phone" placeholder="+62..."
                       class="w-full bg-slate-900/80 rounded-xl px-3.5 py-2 text-xs outline-none border border-slate-800">
            </div>
        </div>

        <div class="grid sm:grid-cols-3 gap-4">
            <div>
                <label class="block text-xs font-semibold text-slate-400 mb-1">Jenis Kerjasama</label>
                <select name="type" class="w-full bg-slate-900/80 rounded-xl px-3.5 py-2 text-xs outline-none border border-slate-800">
                    <option value="sponsorship">Sponsorship Siaran</option>
                    <option value="commission">Komisi Aset Khusus</option>
                    <option value="talent-hire">Sewa Talent Event</option>
                    <option value="merch">Lisensi Merchandise</option>
                    <option value="other">Bentuk Lain</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-400 mb-1">Status Pipeline</label>
                <select name="status" class="w-full bg-slate-900/80 rounded-xl px-3.5 py-2 text-xs outline-none border border-slate-800">
                    <option value="lead">Lead Baru</option>
                    <option value="negotiation">Dalam Negosiasi</option>
                    <option value="active">Kontrak Aktif</option>
                    <option value="completed">Selesai</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-400 mb-1">Nilai Kesepakatan (Rp)</label>
                <input type="number" name="deal_value" min="0" placeholder="0"
                       class="w-full bg-slate-900/80 rounded-xl px-3.5 py-2 text-xs outline-none border border-slate-800">
            </div>
        </div>

        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold text-slate-400 mb-1">Target Talent</label>
                <select name="talent_id" class="w-full bg-slate-900/80 rounded-xl px-3.5 py-2 text-xs outline-none border border-slate-800">
                    <option value="">Terbuka untuk Seluruh Talent</option>
                    @foreach($talents as $t)
                    <option value="{{ $t->id }}">{{ $t->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-400 mb-1">Batas Waktu Pelaksanaan</label>
                <input type="date" name="deadline" class="w-full bg-slate-900/80 rounded-xl px-3.5 py-2 text-xs outline-none border border-slate-800">
            </div>
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-400 mb-1">Detail Ruang Lingkup Kerja</label>
            <textarea name="notes" rows="3" placeholder="Deliverables siaran, durasi tayang logo, penyebutan verbal..."
                      class="w-full bg-slate-900/80 rounded-xl p-3 text-xs outline-none focus:ring-1 focus:ring-sky-400 border border-slate-800 resize-none"></textarea>
        </div>

        <div class="flex justify-end gap-3 pt-4 border-t border-slate-800">
            <a href="{{ route('clients.index') }}" class="px-4 py-2 rounded-xl text-xs font-medium hover:bg-slate-800">Batal</a>
            <button type="submit" class="bg-sky-500 hover:bg-sky-400 text-slate-950 px-5 py-2 rounded-xl text-xs font-semibold transition-all">Simpan Kemitraan</button>
        </div>
    </form>
</div>
@endsection
