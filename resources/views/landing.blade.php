@extends('layouts.app')

@section('title', 'Agend Data — Pusat Pengembangan Kebutuhan Virtual Talent')

@section('body')
<!-- ===== NAVBAR ===== -->
<nav x-data="{ scrolled: false, mobileNav: false }" @scroll.window="scrolled = window.scrollY > 40"
     :class="scrolled ? 'glass-auto shadow-lg' : 'bg-transparent'"
     class="fixed top-0 inset-x-0 z-50 transition-all duration-300 border-b border-slate-200/20 dark:border-slate-800/40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <a href="#" class="flex items-center gap-2.5">
                <!-- Slot Logo Utama Navbar -->
                <div class="w-9 h-9 rounded-xl bg-sky-500/15 border border-sky-400/30 flex items-center justify-center text-sky-400 overflow-hidden">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-full h-full object-cover hidden" onerror="this.classList.add('hidden'); this.nextElementSibling.classList.remove('hidden');">
                    <i data-lucide="database" class="w-4 h-4"></i>
                </div>
                <span class="text-lg font-bold tracking-tight bg-gradient-to-r from-sky-400 to-blue-500 bg-clip-text text-transparent">Agend Data</span>
            </a>
            <div class="hidden md:flex items-center gap-6 text-xs font-medium">
                <a href="#about" class="text-slate-600 dark:text-slate-300 hover:text-sky-400 transition-colors">Tentang</a>
                <a href="#showcase" class="text-slate-600 dark:text-slate-300 hover:text-sky-400 transition-colors">Galeri Foto</a>
                <a href="#innovations" class="text-slate-600 dark:text-slate-300 hover:text-sky-400 transition-colors">Inovasi AI</a>
                <a href="#services" class="text-slate-600 dark:text-slate-300 hover:text-sky-400 transition-colors">Layanan</a>
                <a href="#roadmap" class="text-slate-600 dark:text-slate-300 hover:text-sky-400 transition-colors">Roadmap</a>
                <a href="#pricing" class="text-slate-600 dark:text-slate-300 hover:text-sky-400 transition-colors">Paket</a>
                <a href="#faq" class="text-slate-600 dark:text-slate-300 hover:text-sky-400 transition-colors">FAQ</a>
                <a href="#contact" class="text-slate-600 dark:text-slate-300 hover:text-sky-400 transition-colors">Kontak</a>
                @auth
                <a href="{{ route('dashboard') }}" class="bg-sky-500 hover:bg-sky-400 text-slate-950 px-4 py-2 rounded-xl font-semibold transition-all shadow-md shadow-sky-500/20">Dashboard</a>
                @else
                <a href="{{ route('login') }}" class="text-slate-600 dark:text-slate-300 hover:text-sky-400 transition-colors">Masuk</a>
                <a href="{{ route('register') }}" class="bg-sky-500 hover:bg-sky-400 text-slate-950 px-4 py-2 rounded-xl font-semibold transition-all shadow-md shadow-sky-500/20">Daftar</a>
                @endauth
            </div>
            <button @click="mobileNav = !mobileNav" class="md:hidden text-slate-400 hover:text-slate-100">
                <i data-lucide="menu" class="w-5 h-5"></i>
            </button>
        </div>
        <div x-show="mobileNav" x-transition class="md:hidden pb-4 space-y-2 text-xs">
            <a href="#about" @click="mobileNav=false" class="block px-3 py-2 rounded-lg hover:bg-slate-800">Tentang</a>
            <a href="#showcase" @click="mobileNav=false" class="block px-3 py-2 rounded-lg hover:bg-slate-800">Galeri Foto</a>
            <a href="#services" @click="mobileNav=false" class="block px-3 py-2 rounded-lg hover:bg-slate-800">Layanan</a>
            <a href="#pricing" @click="mobileNav=false" class="block px-3 py-2 rounded-lg hover:bg-slate-800">Paket</a>
            <a href="#contact" @click="mobileNav=false" class="block px-3 py-2 rounded-lg hover:bg-slate-800">Kontak</a>
            @auth
            <a href="{{ route('dashboard') }}" class="block bg-sky-500 text-slate-950 text-center py-2 rounded-xl font-semibold">Dashboard</a>
            @else
            <a href="{{ route('login') }}" class="block text-center py-2">Masuk</a>
            <a href="{{ route('register') }}" class="block bg-sky-500 text-slate-950 text-center py-2 rounded-xl font-semibold">Daftar</a>
            @endauth
        </div>
    </div>
</nav>

<!-- ===== 1. HERO SECTION ===== -->
<section class="relative min-h-screen flex items-center pt-24 pb-16 overflow-hidden">
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-sky-500/10 via-slate-950/0 to-transparent"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative grid lg:grid-cols-12 gap-12 items-center">
        <div class="lg:col-span-7" data-aos="fade-right">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-sky-500/10 border border-sky-400/20 text-sky-400 text-xs font-semibold mb-6">
                <i data-lucide="database" class="w-3.5 h-3.5"></i>
                <span>Agend Data · Pusat Ekosistem & Riset Kebutuhan Talent</span>
            </div>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-[1.1]">
                Platform Agend Data
                <span class="bg-gradient-to-r from-sky-400 via-blue-400 to-indigo-400 bg-clip-text text-transparent">Semua Kebutuhan Dikembangkan</span>
            </h1>
            <p class="mt-6 text-base sm:text-lg text-slate-600 dark:text-slate-400 leading-relaxed max-w-xl">
                Tempat berkumpulnya data virtual talent, riset tren global, otomatisasi aset visual (background, wallpaper, overlay), dan konseling pemula agar produk yang tadinya tidak ada menjadi ada serta siap bermitra secara komersial.
            </p>
            <div class="flex flex-wrap gap-3 mt-8">
                <a href="{{ route('register') }}" class="bg-sky-500 hover:bg-sky-400 text-slate-950 px-6 py-3 rounded-xl text-sm font-semibold transition-all shadow-lg shadow-sky-500/25 flex items-center gap-2">
                    <span>Mulai Kolaborasi</span>
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
                <a href="#showcase" class="glass-auto px-6 py-3 rounded-xl text-sm font-semibold hover:border-sky-500/30 transition-all flex items-center gap-2">
                    <i data-lucide="image" class="w-4 h-4"></i>
                    <span>Lihat Bingkai Foto</span>
                </a>
            </div>
            <div class="grid grid-cols-3 gap-6 mt-12 pt-8 border-t border-slate-200/50 dark:border-slate-800">
                <div>
                    <div class="text-2xl font-bold text-sky-400">{{ $talentCount }}</div>
                    <div class="text-xs text-slate-500 mt-0.5">Talent Terdata</div>
                </div>
                <div>
                    <div class="text-2xl font-bold text-sky-400">{{ $assetCount }}</div>
                    <div class="text-xs text-slate-500 mt-0.5">Asset Visual</div>
                </div>
                <div>
                    <div class="text-2xl font-bold text-sky-400">{{ $clientCount }}</div>
                    <div class="text-xs text-slate-500 mt-0.5">Mitra Klien Aktif</div>
                </div>
            </div>
        </div>

        <!-- BINGKAI UTAMA HERO (MENGGANTIKAN TERMINAL) -->
        <div class="lg:col-span-5" data-aos="fade-left">
            <div class="glass-auto rounded-3xl p-6 border border-sky-500/30 shadow-2xl relative overflow-hidden group">
                <div class="aspect-4/3 w-full rounded-2xl bg-gradient-to-br from-slate-900 via-sky-950/40 to-slate-900 border border-sky-500/20 flex flex-col items-center justify-center p-6 text-center relative overflow-hidden">
                    <!-- Target Gambar Logo / Foto Utama -->
                    <img src="{{ asset('images/main-photo.png') }}" 
                         alt="Foto Utama Agend Data" 
                         class="absolute inset-0 w-full h-full object-cover rounded-2xl hidden" 
                         onerror="this.classList.add('hidden'); this.nextElementSibling.classList.remove('hidden');">
                    
                    <!-- Fallback Placeholder Bersih Jika Foto Belum Diisi -->
                    <div class="flex flex-col items-center justify-center gap-3">
                        <div class="w-16 h-16 rounded-2xl bg-sky-500/10 border border-sky-400/30 flex items-center justify-center text-sky-400 group-hover:scale-105 transition-transform">
                            <i data-lucide="image" class="w-8 h-8"></i>
                        </div>
                        <div>
                            <div class="text-sm font-bold text-slate-200 tracking-tight">Bingkai Foto / Logo Utama</div>
                            <p class="text-[11px] text-slate-500 mt-1 max-w-xs">
                                Letakkan file di <code class="text-sky-400 font-mono">public/images/main-photo.png</code>
                            </p>
                        </div>
                        <span class="text-[10px] uppercase font-mono px-3 py-1 rounded-full bg-sky-500/10 border border-sky-500/30 text-sky-400">
                            Slot Foto 1 (Hero Utama)
                        </span>
                    </div>
                </div>
                <div class="mt-4 flex items-center justify-between text-xs text-slate-500 pt-3 border-t border-slate-800">
                    <span class="flex items-center gap-1.5 text-slate-400">
                        <i data-lucide="sparkles" class="w-3.5 h-3.5 text-sky-400"></i>
                        <span>Visual Brand Identity</span>
                    </span>
                    <span class="font-mono text-[11px] text-sky-400">1920 x 1080 Ready</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== 2. GALERI 4 BINGKAI FOTO (DATA DINAMIS DARI DATABASE / SEEDER) ===== -->
<section id="showcase" class="py-20 border-t border-slate-200/50 dark:border-slate-800/60 bg-slate-900/20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4" data-aos="fade-up">
            <div>
                <span class="text-xs uppercase tracking-wider font-semibold text-sky-400">Koleksi Visual Dinamis</span>
                <h2 class="text-3xl font-bold mt-2">Empat Bingkai Portofolio & Aset</h2>
                <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">
                    Dikelola langsung melalui basis data agensi dan terintegrasi otomatis dengan katalog talent.
                </p>
            </div>
            <a href="{{ route('talents.index') }}" class="text-xs text-sky-400 hover:underline flex items-center gap-1 font-semibold">
                <span>Kelola Database</span>
                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
            </a>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-12">
            @forelse($showcases as $i => $sc)
            <div class="glass-auto rounded-2xl p-4 border border-slate-200/50 dark:border-slate-800 hover:border-sky-500/40 transition-all flex flex-col justify-between" data-aos="fade-up" data-aos-delay="{{ $i * 80 }}">
                <div class="aspect-video w-full rounded-xl bg-slate-900/90 border border-slate-800 relative overflow-hidden flex flex-col items-center justify-center text-center p-4 group">
                    <img src="{{ asset($sc->image_url) }}" 
                         alt="{{ $sc->title }}" 
                         class="absolute inset-0 w-full h-full object-cover hidden" 
                         onerror="this.classList.add('hidden'); this.nextElementSibling.classList.remove('hidden');">
                    
                    <div class="flex flex-col items-center justify-center gap-2">
                        <div class="w-10 h-10 rounded-xl bg-sky-500/10 text-sky-400 flex items-center justify-center">
                            <i data-lucide="image" class="w-5 h-5"></i>
                        </div>
                        <span class="text-xs font-bold text-slate-300">Bingkai {{ $i + 1 }}</span>
                        <span class="text-[10px] font-mono text-slate-500">public/{{ $sc->image_url }}</span>
                    </div>

                    <span class="absolute top-2 right-2 text-[9px] font-mono px-2 py-0.5 rounded bg-slate-950/80 border border-slate-700 text-sky-400">
                        {{ $sc->category }}
                    </span>
                </div>

                <div class="mt-4">
                    <div class="text-[11px] font-mono text-sky-400 font-semibold">{{ $sc->author_or_talent }}</div>
                    <h3 class="text-sm font-bold tracking-tight mt-0.5">{{ $sc->title }}</h3>
                    <p class="text-xs text-slate-500 mt-1 leading-relaxed line-clamp-2">{{ $sc->description }}</p>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12 text-xs text-slate-500 glass-auto rounded-2xl border border-slate-800">
                Belum ada data bingkai foto terdata di basis data. Jalankan database seeder.
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- ===== 3. ABOUT SECTION ===== -->
<section id="about" class="py-20 border-t border-slate-200/50 dark:border-slate-800/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto" data-aos="fade-up">
            <span class="text-xs uppercase tracking-wider font-semibold text-sky-400">Konsep Agend Data</span>
            <h2 class="text-3xl font-bold mt-2">Mengapa Agend Data Diperlukan?</h2>
            <p class="text-sm text-slate-600 dark:text-slate-400 mt-3">
                Agend Data mengumpulkan seluruh data kebutuhan talent yang belum dijangkau agensi besar, mentransformasikannya menjadi produk siap komersialisasi, dan mempertemukannya dengan klien.
            </p>
        </div>
        <div class="grid md:grid-cols-3 gap-6 mt-12">
            <div class="glass-auto rounded-2xl p-6 border border-slate-200/50 dark:border-slate-800" data-aos="fade-up" data-aos-delay="100">
                <div class="w-10 h-10 rounded-xl bg-sky-500/10 text-sky-400 flex items-center justify-center mb-4">
                    <i data-lucide="database" class="w-5 h-5"></i>
                </div>
                <h3 class="text-base font-bold">Pusat Data Agensi</h3>
                <p class="text-xs text-slate-600 dark:text-slate-400 mt-2 leading-relaxed">
                    Pengumpulan data talenta, portofolio model, dan metrik audiens dari berbagai platform dalam satu wadah.
                </p>
            </div>
            <div class="glass-auto rounded-2xl p-6 border border-slate-200/50 dark:border-slate-800" data-aos="fade-up" data-aos-delay="200">
                <div class="w-10 h-10 rounded-xl bg-blue-500/10 text-blue-400 flex items-center justify-center mb-4">
                    <i data-lucide="sparkles" class="w-5 h-5"></i>
                </div>
                <h3 class="text-base font-bold">Produk yang Belum Ada Menjadi Ada</h3>
                <p class="text-xs text-slate-600 dark:text-slate-400 mt-2 leading-relaxed">
                    Menyediakan paket kebutuhan awal: background siaran, overlay, identitas logo, hingga pendampingan kurikulum.
                </p>
            </div>
            <div class="glass-auto rounded-2xl p-6 border border-slate-200/50 dark:border-slate-800" data-aos="fade-up" data-aos-delay="300">
                <div class="w-10 h-10 rounded-xl bg-indigo-500/10 text-indigo-400 flex items-center justify-center mb-4">
                    <i data-lucide="handshake" class="w-5 h-5"></i>
                </div>
                <h3 class="text-base font-bold">Konektivitas Hasil Profit</h3>
                <p class="text-xs text-slate-600 dark:text-slate-400 mt-2 leading-relaxed">
                    Membuka pintu kolaborasi dengan klien, sponsor, dan kontributor untuk mendatangkan revenue berkelanjutan.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- ===== 4. SERVICES SECTION ===== -->
<section id="services" class="py-20 bg-slate-100/40 dark:bg-slate-900/30 border-y border-slate-200/50 dark:border-slate-800/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-xl mx-auto" data-aos="fade-up">
            <span class="text-xs uppercase tracking-wider font-semibold text-sky-400">Modul Kerja</span>
            <h2 class="text-3xl font-bold mt-2">Layanan Pengelolaan Terpadu</h2>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5 mt-12">
            @php
            $services = [
                ['icon' => 'users-round', 'title' => 'Manajemen Data Talent', 'desc' => 'Pencatatan profil karakter, channel YouTube/Twitch, model Live2D/3D, dan analitik jangkauan.'],
                ['icon' => 'wand-2', 'title' => 'Generator Kebutuhan Aset', 'desc' => 'Otomasi background stream, stream overlay responsif, jadwal tayang, wallpaper, dan logo.'],
                ['icon' => 'compass', 'title' => 'Konseling & Kurikulum', 'desc' => 'Panduan bertahap dari konsep awal karakter hingga pelaksanaan debut live stream perdana.'],
                ['icon' => 'briefcase', 'title' => 'Portal Kemitraan Klien', 'desc' => 'Penghubung antara kreator dengan brand sponsorship untuk menghasilkan profit nyata.'],
                ['icon' => 'bar-chart-3', 'title' => 'Analitik Multi-Platform', 'desc' => 'Pelacakan tren subscriber, segmentasi konten, dan evaluasi hasil kerjasama komersial.'],
                ['icon' => 'shield-check', 'title' => 'Perlindungan Hak Intelektual', 'desc' => 'Pencatatan kepemilikan aset avatar digital dan perlindungan identitas panggung talent.'],
            ];
            @endphp
            @foreach($services as $i => $s)
            <div class="glass-auto rounded-2xl p-6 border border-slate-200/50 dark:border-slate-800 hover:border-sky-500/30 transition-all" data-aos="fade-up" data-aos-delay="{{ $i * 50 }}">
                <div class="w-10 h-10 rounded-xl bg-sky-500/10 text-sky-400 flex items-center justify-center mb-4">
                    <i data-lucide="{{ $s['icon'] }}" class="w-5 h-5"></i>
                </div>
                <h3 class="text-sm font-bold tracking-tight">{{ $s['title'] }}</h3>
                <p class="text-xs text-slate-600 dark:text-slate-400 mt-2 leading-relaxed">{{ $s['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ===== 5. ROADMAP ===== -->
<section id="roadmap" class="py-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-xl mx-auto" data-aos="fade-up">
            <span class="text-xs uppercase tracking-wider font-semibold text-sky-400">Arah Pengembangan</span>
            <h2 class="text-3xl font-bold mt-2">Roadmap Agend Data</h2>
        </div>
        <div class="space-y-4 mt-12">
            @php
            $milestones = [
                ['q' => 'Fase 1 (Aktif)', 'title' => 'Sentralisasi Data & Generator Visual', 'desc' => 'Penyediaan katalog talent, otomasi background/overlay, dan modul konsultasi awal.', 'status' => 'Berjalan'],
                ['q' => 'Fase 2', 'title' => 'Integrasi API Brand & Ekosistem Sponsor', 'desc' => 'Menghubungkan klien langsung dengan talent terverifikasi untuk kontrak endorsement resmi.', 'status' => 'Mendatang'],
                ['q' => 'Fase 3', 'title' => 'Bursa Pertukaran Aset Berlisensi', 'desc' => 'Penyediaan pasar aset model, rigging, dan perlengkapan siaran siap pakai.', 'status' => 'Mendatang'],
            ];
            @endphp
            @foreach($milestones as $i => $m)
            <div class="glass-auto rounded-2xl p-5 border border-slate-200/50 dark:border-slate-800 flex flex-col sm:flex-row sm:items-center justify-between gap-4" data-aos="fade-up">
                <div>
                    <div class="flex items-center gap-2">
                        <span class="text-xs font-mono text-sky-400 font-semibold">{{ $m['q'] }}</span>
                        <span class="text-[11px] px-2 py-0.5 rounded-full bg-slate-800 text-slate-400 border border-slate-700">{{ $m['status'] }}</span>
                    </div>
                    <h3 class="text-sm font-bold mt-1">{{ $m['title'] }}</h3>
                    <p class="text-xs text-slate-600 dark:text-slate-400 mt-1">{{ $m['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ===== 6. PRICING ===== -->
<section id="pricing" class="py-20 bg-slate-100/40 dark:bg-slate-900/30 border-y border-slate-200/50 dark:border-slate-800/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-xl mx-auto" data-aos="fade-up">
            <span class="text-xs uppercase tracking-wider font-semibold text-sky-400">Model Kolaborasi</span>
            <h2 class="text-3xl font-bold mt-2">Pilihan Paket Akses</h2>
        </div>
        <div class="grid md:grid-cols-3 gap-6 mt-12 max-w-5xl mx-auto">
            <div class="glass-auto rounded-2xl p-6 border border-slate-200/50 dark:border-slate-800" data-aos="fade-up">
                <span class="text-xs font-mono text-slate-400">PEMULA</span>
                <div class="text-2xl font-bold mt-2">Gratis</div>
                <p class="text-xs text-slate-500 mt-1">Untuk talent baru yang ingin mendata profil dan konsultasi.</p>
                <ul class="mt-6 space-y-2 text-xs text-slate-600 dark:text-slate-300">
                    <li class="flex items-center gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-sky-400"></i> Pendaftaran Profil Talent</li>
                    <li class="flex items-center gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-sky-400"></i> Generator Aset Terbatas</li>
                    <li class="flex items-center gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-sky-400"></i> Asisten Konsultasi Virtual</li>
                </ul>
                <a href="{{ route('register') }}" class="block text-center mt-6 py-2.5 rounded-xl border border-slate-700 text-xs font-semibold hover:bg-slate-800 transition-colors">Daftar Akun</a>
            </div>
            <div class="glass-auto rounded-2xl p-6 border border-sky-500/40 bg-sky-500/5 shadow-xl shadow-sky-500/10 relative" data-aos="fade-up" data-aos-delay="100">
                <span class="absolute top-4 right-4 text-[10px] bg-sky-500 text-slate-950 px-2 py-0.5 rounded-full font-bold">REKOMENDASI</span>
                <span class="text-xs font-mono text-sky-400">KOLABORASI AKTIF</span>
                <div class="text-2xl font-bold mt-2">Rp 149.000 <span class="text-xs font-normal text-slate-500">/ bulan</span></div>
                <p class="text-xs text-slate-500 mt-1">Akses penuh ke pipeline klien dan generator visual tanpa batas.</p>
                <ul class="mt-6 space-y-2 text-xs text-slate-600 dark:text-slate-300">
                    <li class="flex items-center gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-sky-400"></i> Hingga 5 Profil Karakter</li>
                    <li class="flex items-center gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-sky-400"></i> Generate Background & Overlay Tanpa Batas</li>
                    <li class="flex items-center gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-sky-400"></i> Akses Pipeline Kerjasama Klien</li>
                </ul>
                <a href="{{ route('register') }}" class="block text-center mt-6 py-2.5 rounded-xl bg-sky-500 hover:bg-sky-400 text-slate-950 text-xs font-semibold transition-all">Pilih Kolaborasi</a>
            </div>
            <div class="glass-auto rounded-2xl p-6 border border-slate-200/50 dark:border-slate-800" data-aos="fade-up" data-aos-delay="200">
                <span class="text-xs font-mono text-slate-400">AGENCY SCALE</span>
                <div class="text-2xl font-bold mt-2">Rp 599.000 <span class="text-xs font-normal text-slate-500">/ bulan</span></div>
                <p class="text-xs text-slate-500 mt-1">Untuk organisasi pengelola banyak talent dan mitra brand.</p>
                <ul class="mt-6 space-y-2 text-xs text-slate-600 dark:text-slate-300">
                    <li class="flex items-center gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-sky-400"></i> Profil Talent Tanpa Batas</li>
                    <li class="flex items-center gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-sky-400"></i> Multi-Pengelola Tim</li>
                    <li class="flex items-center gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-sky-400"></i> Prioritas Kontrak Sponsor Brand</li>
                </ul>
                <a href="{{ route('register') }}" class="block text-center mt-6 py-2.5 rounded-xl border border-slate-700 text-xs font-semibold hover:bg-slate-800 transition-colors">Hubungi Tim</a>
            </div>
        </div>
    </div>
</section>

<!-- ===== 7. FAQ ===== -->
<section id="faq" class="py-20">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center" data-aos="fade-up">
            <span class="text-xs uppercase tracking-wider font-semibold text-sky-400">Tanya Jawab</span>
            <h2 class="text-3xl font-bold mt-2">Pertanyaan Seputar Agend Data</h2>
        </div>
        <div class="mt-10 space-y-3">
            @php
            $faqs = [
                ['q' => 'Apa peran utama Agend Data untuk virtual talent baru?', 'a' => 'Agend Data bertindak sebagai pengumpul data kebutuhan yang belum terpenuhi, menyediakan fasilitas pembuatan aset siaran, serta mendampingi dari tahap nol hingga talent siap menerima kemitraan komersial.'],
                ['q' => 'Bagaimana cara menambahkan foto ke dalam bingkai yang sudah disiapkan?', 'a' => 'Cukup letakkan berkas foto pada folder public/images dengan nama main-photo.png (untuk Hero), atau frame-1.png hingga frame-4.png untuk galeri showcase.'],
                ['q' => 'Apakah talenta independen bisa mendapatkan hasil profit?', 'a' => 'Ya, melalui modul Client Portal, profil talenta dan data performa akan ditawarkan kepada brand atau klien yang membutuhkan endorsement maupun event streaming.'],
            ];
            @endphp
            @foreach($faqs as $i => $f)
            <div x-data="{ open: false }" class="glass-auto rounded-xl border border-slate-200/50 dark:border-slate-800 overflow-hidden" data-aos="fade-up">
                <button @click="open = !open" class="w-full flex items-center justify-between p-4 text-left text-xs font-semibold">
                    <span>{{ $f['q'] }}</span>
                    <i data-lucide="chevron-down" class="w-4 h-4 text-slate-500 transition-transform duration-200" :class="{ 'rotate-180': open }"></i>
                </button>
                <div x-show="open" x-transition class="px-4 pb-4 text-xs text-slate-600 dark:text-slate-400 leading-relaxed border-t border-slate-800/40 pt-3">
                    {{ $f['a'] }}
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ===== 7.5. BANK INOVASI & RISET AI (PRODUK BARU YANG DIKEMBANGKAN) ===== -->
<section id="innovations" class="py-20 bg-slate-900/40 border-y border-slate-200/50 dark:border-slate-800/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4" data-aos="fade-up">
            <div>
                <span class="text-xs uppercase tracking-wider font-semibold text-sky-400">Riset Celah Pasar & Produk Baru</span>
                <h2 class="text-3xl font-bold mt-2">Bank Ide & Inovasi Komersialisasi</h2>
                <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">
                    Ide produk virtual talent yang belum digarap secara global, dikembangkan otomatis berbasis data untuk mendatangkan profit.
                </p>
            </div>
            @auth
            <a href="{{ route('innovations.index') }}" class="bg-sky-500 hover:bg-sky-400 text-slate-950 px-4 py-2 rounded-xl text-xs font-semibold flex items-center gap-1.5 shadow-md shadow-sky-500/20">
                <i data-lucide="sparkles" class="w-4 h-4"></i>
                <span>Buka Bank Inovasi AI</span>
            </a>
            @endauth
        </div>

        <div class="grid md:grid-cols-3 gap-6 mt-12">
            @foreach($innovations as $inno)
            <div class="glass-auto rounded-2xl p-6 border border-slate-200/50 dark:border-slate-800 hover:border-sky-500/40 transition-all flex flex-col justify-between" data-aos="fade-up">
                <div>
                    <div class="flex items-center justify-between gap-2">
                        <span class="text-[10px] uppercase font-mono px-2 py-0.5 rounded-full bg-sky-500/10 text-sky-400 border border-sky-500/20">
                            {{ str_replace('_', ' ', $inno->category) }}
                        </span>
                        @if($inno->generated_by_ai)
                        <span class="text-[10px] font-mono text-emerald-400 flex items-center gap-1">
                            <i data-lucide="bot" class="w-3 h-3"></i>
                            <span>AI SYNTHESIZED</span>
                        </span>
                        @endif
                    </div>
                    <h3 class="text-base font-bold tracking-tight mt-3">{{ $inno->title }}</h3>
                    <div class="mt-3 text-xs">
                        <div class="text-slate-500 font-semibold">Celah Pasar:</div>
                        <p class="text-slate-400 mt-0.5 leading-relaxed">{{ $inno->problem_statement }}</p>
                    </div>
                    <div class="mt-3 text-xs">
                        <div class="text-sky-400 font-semibold">Solusi Dikembangkan:</div>
                        <p class="text-slate-300 mt-0.5 leading-relaxed">{{ $inno->proposed_solution }}</p>
                    </div>
                </div>

                <div class="pt-4 mt-4 border-t border-slate-800/80 flex items-center justify-between text-xs">
                    <span class="font-mono text-[11px] text-emerald-400">{{ $inno->monetization_potential }}</span>
                    <span class="text-[10px] px-2 py-0.5 rounded bg-slate-800 text-slate-400 uppercase font-mono">{{ $inno->status }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ===== 8. CONTACT ===== -->
<section id="contact" class="py-20 bg-slate-100/40 dark:bg-slate-900/30 border-t border-slate-200/50 dark:border-slate-800/60">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 grid md:grid-cols-2 gap-10 items-center">
        <div data-aos="fade-right">
            <span class="text-xs uppercase tracking-wider font-semibold text-sky-400">Kerjasama & Kontribusi</span>
            <h2 class="text-3xl font-bold mt-2">Mulai Kolaborasi Bersama Agend Data</h2>
            <p class="text-xs text-slate-600 dark:text-slate-400 mt-3 leading-relaxed">
                Klien, sponsor, atau talent baru dapat menghubungi tim kami untuk penjajakan kerjasama maupun pendaftaran portofolio.
            </p>
            <div class="space-y-3 mt-6 text-xs text-slate-400">
                <div class="flex items-center gap-2.5">
                    <i data-lucide="mail" class="w-4 h-4 text-sky-400"></i>
                    <span>kolaborasi@agenddata.internal</span>
                </div>
                <div class="flex items-center gap-2.5">
                    <i data-lucide="database" class="w-4 h-4 text-sky-400"></i>
                    <span>Pusat Data Agensi Virtual Talent</span>
                </div>
            </div>
        </div>
        <form class="glass-auto rounded-2xl p-6 border border-slate-200/50 dark:border-slate-800 space-y-3"
              onsubmit="event.preventDefault(); this.reset(); alert('Pesan kerjasama berhasil terkirim.')" data-aos="fade-left">
            <div>
                <label class="block text-[11px] font-semibold text-slate-400 mb-1">Nama / Klien / Brand</label>
                <input type="text" required placeholder="Nama Klien atau Talent"
                       class="w-full bg-slate-900/80 rounded-xl px-3.5 py-2 text-xs outline-none focus:ring-1 focus:ring-sky-400 border border-slate-800">
            </div>
            <div>
                <label class="block text-[11px] font-semibold text-slate-400 mb-1">Email Korespodensi</label>
                <input type="email" required placeholder="nama@klien.com"
                       class="w-full bg-slate-900/80 rounded-xl px-3.5 py-2 text-xs outline-none focus:ring-1 focus:ring-sky-400 border border-slate-800">
            </div>
            <div>
                <label class="block text-[11px] font-semibold text-slate-400 mb-1">Pesan Kerjasama / Kebutuhan</label>
                <textarea rows="3" required placeholder="Jelaskan kebutuhan aset atau tawaran sponsor..."
                          class="w-full bg-slate-900/80 rounded-xl px-3.5 py-2 text-xs outline-none focus:ring-1 focus:ring-sky-400 border border-slate-800 resize-none"></textarea>
            </div>
            <button type="submit" class="w-full bg-sky-500 hover:bg-sky-400 text-slate-950 py-2.5 rounded-xl text-xs font-semibold transition-all">
                Kirim Penawaran
            </button>
        </form>
    </div>
</section>

<!-- ===== 9. FOOTER ===== -->
<footer class="py-12 border-t border-slate-200/50 dark:border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
        <div class="flex items-center gap-2">
            <div class="w-6 h-6 rounded-md bg-sky-500/10 text-sky-400 flex items-center justify-center">
                <i data-lucide="database" class="w-3.5 h-3.5"></i>
            </div>
            <span class="font-bold text-slate-400">Agend Data</span>
            <span>· Mengumpulkan Data & Mengembangkan Kebutuhan Virtual Talent Menjadi Profit</span>
        </div>
        <div>
            &copy; {{ date('Y') }} Agend Data. Hak cipta dilindungi.
        </div>
    </div>
</footer>
@endsection
