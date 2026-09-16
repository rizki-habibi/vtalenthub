@extends('layouts.app')

@section('title', 'Agend Data — Cyber Comic Data Agency')

@section('body')
<!-- ===== NAVBAR COMIC STYLE ===== -->
<nav x-data="{ scrolled: false, mobileNav: false }" @scroll.window="scrolled = window.scrollY > 40"
     :class="scrolled ? 'bg-slate-950/90 border-b-2 border-sky-400/50 shadow-[0_4px_20px_rgba(56,189,248,0.15)]' : 'bg-transparent border-b border-sky-500/20'"
     class="fixed top-0 inset-x-0 z-50 transition-all duration-200 backdrop-blur-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Brand Logo Comic -->
            <a href="#" class="flex items-center gap-2.5 group">
                <div class="w-9 h-9 bg-sky-400 text-slate-950 border-2 border-slate-950 shadow-[2px_2px_0px_#38bdf8] flex items-center justify-center font-black text-sm group-hover:rotate-6 transition-transform">
                    AD
                </div>
                <div class="flex flex-col">
                    <span class="text-base font-black tracking-tight font-display text-sky-400">AGEND DATA</span>
                    <span class="text-[9px] font-mono tracking-widest text-slate-400 uppercase -mt-1">[VIRTUAL TALENT HUB]</span>
                </div>
            </a>

            <!-- Menu Navigation -->
            <div class="hidden md:flex items-center gap-6 text-xs font-bold uppercase tracking-wider font-display">
                <a href="#about" class="text-slate-300 hover:text-sky-400 transition-colors">Tentang</a>
                <a href="#showcase" class="text-slate-300 hover:text-sky-400 transition-colors">Galeri Panel</a>
                <a href="#innovations" class="text-slate-300 hover:text-sky-400 transition-colors">Inovasi AI</a>
                <a href="#services" class="text-slate-300 hover:text-sky-400 transition-colors">Layanan</a>
                <a href="#pricing" class="text-slate-300 hover:text-sky-400 transition-colors">Paket</a>
                <a href="#contact" class="text-slate-300 hover:text-sky-400 transition-colors">Kontak</a>
                @auth
                <a href="{{ route('dashboard') }}" class="btn-comic px-4 py-1.5 text-xs">Dashboard</a>
                @else
                <a href="{{ route('login') }}" class="text-slate-300 hover:text-sky-400">Masuk</a>
                <a href="{{ route('register') }}" class="btn-comic px-4 py-1.5 text-xs">Mulai Gratis</a>
                @endauth
            </div>

            <button @click="mobileNav = !mobileNav" class="md:hidden text-sky-400 p-1 border-2 border-sky-400">
                <i data-lucide="menu" class="w-5 h-5"></i>
            </button>
        </div>

        <div x-show="mobileNav" x-transition class="md:hidden pb-4 space-y-2 text-xs font-bold uppercase tracking-wider bg-slate-950 p-4 border-t-2 border-sky-400">
            <a href="#about" @click="mobileNav=false" class="block py-1 hover:text-sky-400">Tentang</a>
            <a href="#showcase" @click="mobileNav=false" class="block py-1 hover:text-sky-400">Galeri Panel</a>
            <a href="#innovations" @click="mobileNav=false" class="block py-1 hover:text-sky-400">Inovasi AI</a>
            <a href="#services" @click="mobileNav=false" class="block py-1 hover:text-sky-400">Layanan</a>
            <a href="#pricing" @click="mobileNav=false" class="block py-1 hover:text-sky-400">Paket</a>
            @auth
            <a href="{{ route('dashboard') }}" class="block btn-comic text-center py-2 mt-2">Masuk Dashboard</a>
            @else
            <a href="{{ route('login') }}" class="block text-center py-1">Masuk</a>
            <a href="{{ route('register') }}" class="block btn-comic text-center py-2 mt-1">Daftar Akun</a>
            @endauth
        </div>
    </div>
</nav>

<!-- ===== 1. HERO SECTION (COMIC COVER STYLE) ===== -->
<section class="relative min-h-screen flex items-center pt-24 pb-16 overflow-hidden comic-speedlines">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative grid lg:grid-cols-12 gap-10 items-center">
        <!-- Kolom Teks Hero -->
        <div class="lg:col-span-7 space-y-6" data-aos="fade-right">
            <div class="inline-flex items-center gap-2">
                <span class="comic-tag">VOLUME // 2026</span>
                <span class="comic-tag-outline text-[11px]">DATA-DRIVEN VTUBER PRODUCTION</span>
            </div>

            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black font-display tracking-tight uppercase leading-[1.05]">
                Kembangkan
                <span class="text-sky-400 underline decoration-4 underline-offset-8 decoration-sky-400/80">Kebutuhan Virtual Talent</span>
                Menjadi Produk Nyata
            </h1>

            <div class="comic-balloon p-4 rounded-xl max-w-xl">
                <p class="text-xs sm:text-sm text-slate-300 font-medium leading-relaxed">
                    "Produk yang tadinya tidak ada kami buat menjadi ada: mulai dari aset background loss-less, overlay interaktif, sampai konektivitas kontrak brand sponsor untuk menghasilkan profit."
                </p>
            </div>

            <div class="flex flex-wrap gap-4 pt-2">
                <a href="{{ route('register') }}" class="btn-comic px-6 py-3 rounded-none flex items-center gap-2 text-xs">
                    <span>Mulai Eksplorasi Sekarang</span>
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
                <a href="#showcase" class="btn-comic-ghost px-6 py-3 rounded-none flex items-center gap-2 text-xs">
                    <i data-lucide="layout-grid" class="w-4 h-4"></i>
                    <span>Buka Panel Galeri</span>
                </a>
            </div>

            <!-- Counter Strip Komik -->
            <div class="grid grid-cols-3 gap-3 pt-6 border-t-2 border-sky-400/30 font-display">
                <div class="comic-panel p-3 text-center">
                    <div class="text-2xl font-black text-sky-400 font-mono">{{ $talentCount }}</div>
                    <div class="text-[10px] uppercase tracking-wider text-slate-400 mt-0.5">Talent Terdata</div>
                </div>
                <div class="comic-panel p-3 text-center">
                    <div class="text-2xl font-black text-sky-400 font-mono">{{ $assetCount }}</div>
                    <div class="text-[10px] uppercase tracking-wider text-slate-400 mt-0.5">Aset Diproduksi</div>
                </div>
                <div class="comic-panel p-3 text-center">
                    <div class="text-2xl font-black text-sky-400 font-mono">{{ $clientCount }}</div>
                    <div class="text-[10px] uppercase tracking-wider text-slate-400 mt-0.5">Mitra Klien</div>
                </div>
            </div>
        </div>

        <!-- Kolom Bingkai Komik Hero -->
        <div class="lg:col-span-5" data-aos="fade-left">
            <div class="comic-panel p-5 relative group">
                <div class="absolute -top-3 -right-3 z-10">
                    <span class="comic-tag shadow-md">COVER // #01</span>
                </div>

                <div class="aspect-4/3 w-full bg-slate-950 border-2 border-sky-400 relative overflow-hidden flex flex-col items-center justify-center p-6 text-center">
                    <!-- Foto Utama Dinamis / Statis -->
                    <img src="{{ asset('images/main-photo.png') }}" 
                         alt="Cover Utama" 
                         class="absolute inset-0 w-full h-full object-cover hidden" 
                         onerror="this.classList.add('hidden'); this.nextElementSibling.classList.remove('hidden');">

                    <!-- Fallback Tampilan Komik -->
                    <div class="flex flex-col items-center justify-center gap-3">
                        <div class="w-16 h-16 bg-sky-400 text-slate-950 border-2 border-slate-950 flex items-center justify-center font-black shadow-[3px_3px_0px_#38bdf8]">
                            <i data-lucide="sparkles" class="w-8 h-8"></i>
                        </div>
                        <div>
                            <div class="text-sm font-black font-display uppercase tracking-wider text-sky-400">Bingkai Utama / Logo Agensi</div>
                            <p class="text-[11px] font-mono text-slate-400 mt-1">public/images/main-photo.png</p>
                        </div>
                        <span class="comic-tag-outline text-[10px]">READY TO PITCH</span>
                    </div>
                </div>

                <div class="mt-4 flex items-center justify-between text-[11px] font-mono text-slate-400 border-t-2 border-sky-400/20 pt-3">
                    <span class="text-sky-400 font-bold uppercase">[STATUS // BROADCAST READY]</span>
                    <span>1920x1080 LOSSLESS</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== 2. GALERI 4 BINGKAI FOTO ALA PANEL KOMIK ===== -->
<section id="showcase" class="py-20 border-t-2 border-sky-400/30 bg-slate-950/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4" data-aos="fade-up">
            <div>
                <span class="comic-tag text-[10px]">PANEL STRIP // 02</span>
                <h2 class="text-3xl font-black font-display tracking-tight uppercase mt-2">
                    Empat Bingkai Portofolio & Visual
                </h2>
                <p class="text-xs text-slate-400 mt-1 font-mono">
                    // Data aset visual yang dikembangkan langsung dari basis data agensi.
                </p>
            </div>
            <a href="{{ route('talents.index') }}" class="btn-comic-ghost px-4 py-2 text-xs flex items-center gap-1.5 self-start sm:self-auto">
                <span>Buka Basis Data</span>
                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
            </a>
        </div>

        <!-- 4 Panel Grid Comic Style -->
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-12">
            @forelse($showcases as $i => $sc)
            <div class="comic-panel p-4 flex flex-col justify-between" data-aos="fade-up" data-aos-delay="{{ $i * 80 }}">
                <div>
                    <!-- Kotak Gambar Panel -->
                    <div class="aspect-video w-full bg-slate-950 border-2 border-sky-400/60 relative overflow-hidden flex flex-col items-center justify-center p-3 text-center group">
                        <img src="{{ asset($sc->image_url) }}" 
                             alt="{{ $sc->title }}" 
                             class="absolute inset-0 w-full h-full object-cover hidden" 
                             onerror="this.classList.add('hidden'); this.nextElementSibling.classList.remove('hidden');">

                        <div class="flex flex-col items-center justify-center gap-1.5">
                            <i data-lucide="image" class="w-6 h-6 text-sky-400"></i>
                            <span class="text-xs font-bold font-display uppercase tracking-wider text-slate-200">Panel {{ $i + 1 }}</span>
                            <span class="text-[9px] font-mono text-slate-500">public/{{ $sc->image_url }}</span>
                        </div>

                        <span class="absolute top-2 right-2 comic-tag text-[8px]">
                            {{ $sc->category }}
                        </span>
                    </div>

                    <div class="mt-4">
                        <span class="text-[10px] font-mono text-sky-400 font-bold uppercase tracking-wider">
                            {{ $sc->author_or_talent ?? 'Agend Data' }}
                        </span>
                        <h3 class="text-sm font-bold font-display tracking-tight text-slate-100 mt-0.5 leading-snug">
                            {{ $sc->title }}
                        </h3>
                        <p class="text-xs text-slate-400 mt-1.5 leading-relaxed line-clamp-2">
                            {{ $sc->description }}
                        </p>
                    </div>
                </div>

                <div class="mt-4 pt-3 border-t border-sky-400/20 flex items-center justify-between text-[10px] font-mono text-slate-400">
                    <span>PANEL ID #0{{ $sc->id }}</span>
                    <span class="text-sky-400 font-bold">[VERIFIED]</span>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12 text-xs font-mono text-slate-500 comic-panel">
                [DATABASE EMPTY] Belum ada data panel tersimpan di basis data.
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- ===== 3. BANK INOVASI AI (PRODUK BARU YANG DIKEMBANGKAN) ===== -->
<section id="innovations" class="py-20 border-t-2 border-sky-400/30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4" data-aos="fade-up">
            <div>
                <span class="comic-tag text-[10px]">INNOVATION LAB // 03</span>
                <h2 class="text-3xl font-black font-display tracking-tight uppercase mt-2">
                    Bank Ide & Inovasi Celah Pasar AI
                </h2>
                <p class="text-xs text-slate-400 mt-1 font-mono">
                    // Sintesis produk yang belum ada di pasar global untuk menghasilkan aliran profit.
                </p>
            </div>
            @auth
            <a href="{{ route('innovations.index') }}" class="btn-comic px-4 py-2 text-xs flex items-center gap-1.5 self-start sm:self-auto">
                <i data-lucide="sparkles" class="w-4 h-4"></i>
                <span>Buka Lab Inovasi</span>
            </a>
            @endauth
        </div>

        <div class="grid md:grid-cols-3 gap-6 mt-12">
            @foreach($innovations as $inno)
            <div class="comic-panel p-6 flex flex-col justify-between" data-aos="fade-up">
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="comic-tag-outline text-[9px] font-mono">
                            {{ strtoupper(str_replace('_', ' ', $inno->category)) }}
                        </span>
                        @if($inno->generated_by_ai)
                        <span class="text-[10px] font-mono text-sky-400 font-bold flex items-center gap-1">
                            <i data-lucide="bot" class="w-3.5 h-3.5"></i>
                            <span>AI SYNTHESIZED</span>
                        </span>
                        @endif
                    </div>

                    <h3 class="text-base font-black font-display tracking-tight text-slate-100 uppercase">
                        {{ $inno->title }}
                    </h3>

                    <div class="p-3 bg-slate-950/80 border border-slate-800 text-xs space-y-2 font-mono">
                        <div>
                            <span class="text-rose-400 font-bold">[GAP PROBLEM]:</span>
                            <p class="text-slate-400 mt-0.5 leading-relaxed">{{ $inno->problem_statement }}</p>
                        </div>
                        <div>
                            <span class="text-sky-400 font-bold">[NEW PRODUCT]:</span>
                            <p class="text-slate-300 mt-0.5 leading-relaxed">{{ $inno->proposed_solution }}</p>
                        </div>
                    </div>
                </div>

                <div class="pt-4 mt-4 border-t-2 border-sky-400/20 flex items-center justify-between text-xs">
                    <span class="text-[11px] font-mono font-bold text-emerald-400">
                        {{ $inno->monetization_potential }}
                    </span>
                    <span class="comic-tag text-[9px]">{{ $inno->status }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ===== 4. ABOUT (KONSEP COMIC) ===== -->
<section id="about" class="py-20 border-t-2 border-sky-400/30 bg-slate-950/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto" data-aos="fade-up">
            <span class="comic-tag text-[10px]">MISSION BRIEF // 04</span>
            <h2 class="text-3xl font-black font-display tracking-tight uppercase mt-2">
                Mengapa Agend Data Diciptakan?
            </h2>
            <p class="text-xs text-slate-400 mt-2 font-mono">
                Menyediakan seluruh infrastruktur yang dilewatkan oleh agensi konglomerat tradisional.
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-6 mt-12">
            <div class="comic-panel p-6" data-aos="fade-up">
                <div class="w-10 h-10 bg-sky-400 text-slate-950 border-2 border-slate-950 flex items-center justify-center font-bold mb-4">
                    01
                </div>
                <h3 class="text-sm font-black font-display uppercase tracking-wider text-sky-400">Pusat Data Terpusat</h3>
                <p class="text-xs text-slate-300 mt-2 leading-relaxed">
                    Pengumpulan data talenta, model avatar, analitik siaran lintas platform dari YouTube hingga Twitch dalam satu panel kendali.
                </p>
            </div>
            <div class="comic-panel p-6" data-aos="fade-up" data-aos-delay="100">
                <div class="w-10 h-10 bg-sky-400 text-slate-950 border-2 border-slate-950 flex items-center justify-center font-bold mb-4">
                    02
                </div>
                <h3 class="text-sm font-black font-display uppercase tracking-wider text-sky-400">Penciptaan Produk Baru</h3>
                <p class="text-xs text-slate-300 mt-2 leading-relaxed">
                    Kebutuhan yang belum ada kami buat otomatis: background siaran resolusi tinggi, overlay HUD, aset merchandise, dan panduan kurikulum debut.
                </p>
            </div>
            <div class="comic-panel p-6" data-aos="fade-up" data-aos-delay="200">
                <div class="w-10 h-10 bg-sky-400 text-slate-950 border-2 border-slate-950 flex items-center justify-center font-bold mb-4">
                    03
                </div>
                <h3 class="text-sm font-black font-display uppercase tracking-wider text-sky-400">Hasil Profit Nyata</h3>
                <p class="text-xs text-slate-300 mt-2 leading-relaxed">
                    Menghubungkan langsung talenta terdata dengan mitra klien sponsor brand komersial dengan pembagian bagi hasil yang transparan.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- ===== 5. SERVICES (COMIC GRID) ===== -->
<section id="services" class="py-20 border-t-2 border-sky-400/30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-xl mx-auto" data-aos="fade-up">
            <span class="comic-tag text-[10px]">OPERATIONS // 05</span>
            <h2 class="text-3xl font-black font-display tracking-tight uppercase mt-2">
                Enam Pilar Layanan Agend Data
            </h2>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5 mt-12">
            @php
            $services = [
                ['icon' => 'users', 'title' => 'Talent Manager', 'desc' => 'Pencatatan profil panggung, lore karakter, tipe model Live2D/3D, dan analitik jangkauan pemirsa.'],
                ['icon' => 'wand-2', 'title' => 'Asset Generator', 'desc' => 'Otomasi rendering background 2K, stream overlay, wallpaper, emote pack, dan jadwal tayang mingguan.'],
                ['icon' => 'compass', 'title' => 'Kurikulum Konseling', 'desc' => 'Panduan tahap demi tahap persiapan teknis siaran, OBS capture, audio routing, hingga stream debut perdana.'],
                ['icon' => 'briefcase', 'title' => 'Portal Kemitraan Klien', 'desc' => 'Pipeline penjajakan sponsor brand, kontrak endorsement terverifikasi, dan monitoring pembayaran.'],
                ['icon' => 'bar-chart-3', 'title' => 'Analitik Ekosistem', 'desc' => 'Grafik komparasi platform, rasio status kesiapan siaran, dan kalkulasi potensi nilai deal komersial.'],
                ['icon' => 'shield-check', 'title' => 'Perlindungan Hak Aset', 'desc' => 'Sertifikasi kepemilikan aset model avatar dan penjagaan integritas merek karakter secara legal.'],
            ];
            @endphp
            @foreach($services as $i => $s)
            <div class="comic-panel p-5 flex flex-col justify-between" data-aos="fade-up" data-aos-delay="{{ $i * 50 }}">
                <div>
                    <div class="w-10 h-10 bg-slate-950 border-2 border-sky-400 text-sky-400 flex items-center justify-center mb-4">
                        <i data-lucide="{{ $s['icon'] }}" class="w-5 h-5"></i>
                    </div>
                    <h3 class="text-sm font-black font-display uppercase tracking-wider text-slate-100">{{ $s['title'] }}</h3>
                    <p class="text-xs text-slate-400 mt-2 leading-relaxed font-sans">{{ $s['desc'] }}</p>
                </div>
                <div class="mt-4 pt-3 border-t border-sky-400/20 text-[10px] font-mono text-sky-400 font-bold uppercase">
                    [STATUS // OPERATIONAL]
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ===== 6. PRICING COMIC ===== -->
<section id="pricing" class="py-20 border-t-2 border-sky-400/30 bg-slate-950/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-xl mx-auto" data-aos="fade-up">
            <span class="comic-tag text-[10px]">COMMERCIAL // 06</span>
            <h2 class="text-3xl font-black font-display tracking-tight uppercase mt-2">
                Paket Akses Operasional
            </h2>
        </div>

        <div class="grid md:grid-cols-3 gap-6 mt-12 max-w-5xl mx-auto">
            <div class="comic-panel p-6" data-aos="fade-up">
                <span class="comic-tag-outline text-[10px]">TIER // STARTER</span>
                <div class="text-3xl font-black font-display mt-2 text-slate-100">GRATIS</div>
                <p class="text-xs text-slate-400 mt-1 font-mono">Untuk talenta baru yang ingin memulai pendataan.</p>
                <ul class="mt-6 space-y-2 text-xs text-slate-300 font-mono">
                    <li class="flex items-center gap-2">✓ 1 Profil Talent Terdata</li>
                    <li class="flex items-center gap-2">✓ Generator Aset Terbatas</li>
                    <li class="flex items-center gap-2">✓ Asisten Konsultasi Virtual</li>
                </ul>
                <a href="{{ route('register') }}" class="btn-comic-ghost block text-center mt-6 py-2.5 text-xs">Daftar Akun</a>
            </div>

            <div class="comic-panel p-6 border-sky-400 bg-sky-500/10 shadow-[6px_6px_0px_#38bdf8] relative" data-aos="fade-up" data-aos-delay="100">
                <span class="absolute -top-3 right-4 comic-tag text-[9px]">PILIHAN POPULER</span>
                <span class="comic-tag-outline text-[10px]">TIER // PRO KREATOR</span>
                <div class="text-3xl font-black font-display mt-2 text-sky-400">Rp 149K <span class="text-xs font-normal text-slate-400">/bln</span></div>
                <p class="text-xs text-slate-400 mt-1 font-mono">Untuk kreator aktif yang mengincar sponsor komersial.</p>
                <ul class="mt-6 space-y-2 text-xs text-slate-200 font-mono">
                    <li class="flex items-center gap-2">✓ Hingga 5 Profil Talent</li>
                    <li class="flex items-center gap-2">✓ Generator Aset Tanpa Batas</li>
                    <li class="flex items-center gap-2">✓ Akses Pipeline Kerjasama Klien</li>
                    <li class="flex items-center gap-2">✓ Akses Bank Inovasi AI</li>
                </ul>
                <a href="{{ route('register') }}" class="btn-comic block text-center mt-6 py-2.5 text-xs">Pilih Kolaborasi</a>
            </div>

            <div class="comic-panel p-6" data-aos="fade-up" data-aos-delay="200">
                <span class="comic-tag-outline text-[10px]">TIER // CORPO AGENCY</span>
                <div class="text-3xl font-black font-display mt-2 text-slate-100">Rp 599K <span class="text-xs font-normal text-slate-400">/bln</span></div>
                <p class="text-xs text-slate-400 mt-1 font-mono">Untuk tim pengelola multi-talent dan banyak klien.</p>
                <ul class="mt-6 space-y-2 text-xs text-slate-300 font-mono">
                    <li class="flex items-center gap-2">✓ Profil Talent Tanpa Batas</li>
                    <li class="flex items-center gap-2">✓ Akun Manajer Multi-User</li>
                    <li class="flex items-center gap-2">✓ Prioritas Kontrak Sponsor Brand</li>
                    <li class="flex items-center gap-2">✓ Ekspor Analitik JSON/CSV</li>
                </ul>
                <a href="{{ route('register') }}" class="btn-comic-ghost block text-center mt-6 py-2.5 text-xs">Hubungi Agensi</a>
            </div>
        </div>
    </div>
</section>

<!-- ===== 7. CONTACT ===== -->
<section id="contact" class="py-20 border-t-2 border-sky-400/30">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 grid md:grid-cols-2 gap-10 items-center">
        <div data-aos="fade-right">
            <span class="comic-tag text-[10px]">TRANSMISSION // 07</span>
            <h2 class="text-3xl font-black font-display tracking-tight uppercase mt-2">
                Kirim Pesan Kolaborasi
            </h2>
            <p class="text-xs text-slate-400 mt-3 font-mono leading-relaxed">
                // Agend Data membuka penjajakan kemitraan sponsor brand, talenta baru, dan kontributor kreatif.
            </p>
            <div class="space-y-2 mt-6 text-xs font-mono text-slate-300">
                <div class="flex items-center gap-2">
                    <span class="text-sky-400 font-bold">[EMAIL]:</span>
                    <span>kolaborasi@agenddata.internal</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-sky-400 font-bold">[HQ]:</span>
                    <span>Pusat Data Operasional Virtual Talent</span>
                </div>
            </div>
        </div>

        <form class="comic-panel p-6 space-y-3"
              onsubmit="event.preventDefault(); this.reset(); alert('Pesan berhasil ditransmisikan ke tim Agend Data.')" data-aos="fade-left">
            <div>
                <label class="block text-[11px] font-bold font-mono uppercase text-sky-400 mb-1">Identitas Klien / Talent</label>
                <input type="text" required placeholder="Nama Anda atau Brand..."
                       class="w-full bg-slate-950 border-2 border-slate-800 p-2.5 text-xs text-slate-100 outline-none focus:border-sky-400">
            </div>
            <div>
                <label class="block text-[11px] font-bold font-mono uppercase text-sky-400 mb-1">Email Korespodensi</label>
                <input type="email" required placeholder="nama@domain.com..."
                       class="w-full bg-slate-950 border-2 border-slate-800 p-2.5 text-xs text-slate-100 outline-none focus:border-sky-400">
            </div>
            <div>
                <label class="block text-[11px] font-bold font-mono uppercase text-sky-400 mb-1">Deskripsi Kebutuhan</label>
                <textarea rows="3" required placeholder="Jelaskan kebutuhan aset siaran atau tawaran sponsorship..."
                          class="w-full bg-slate-950 border-2 border-slate-800 p-2.5 text-xs text-slate-100 outline-none focus:border-sky-400 resize-none"></textarea>
            </div>
            <button type="submit" class="btn-comic w-full py-2.5 text-xs">
                Kirimkan Transmisi
            </button>
        </form>
    </div>
</section>

<!-- ===== 8. FOOTER ===== -->
<footer class="py-10 border-t-2 border-sky-400/30 bg-slate-950 font-mono text-xs text-slate-500">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4">
        <div class="flex items-center gap-2">
            <span class="comic-tag text-[10px]">AGEND DATA</span>
            <span>// Mengembangkan Kebutuhan Virtual Talent Menjadi Profit Nyata</span>
        </div>
        <div>
            &copy; {{ date('Y') }} AGEND DATA KERNEL. ALL RIGHTS RESERVED.
        </div>
    </div>
</footer>
@endsection
