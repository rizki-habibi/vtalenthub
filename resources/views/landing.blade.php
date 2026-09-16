@extends('layouts.app')

@section('body')
<!-- ===== NAVBAR ===== -->
<nav x-data="{ scrolled: false, mobileNav: false }" @scroll.window="scrolled = window.scrollY > 40"
     :class="scrolled ? 'glass-auto shadow-lg' : 'bg-transparent'"
     class="fixed top-0 inset-x-0 z-50 transition-all duration-300 border-b border-slate-200/20 dark:border-slate-800/40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <a href="#" class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-sky-500/15 border border-sky-400/30 flex items-center justify-center text-sky-400">
                    <i data-lucide="sparkles" class="w-4 h-4"></i>
                </div>
                <span class="text-base font-bold tracking-tight bg-gradient-to-r from-sky-400 to-blue-500 bg-clip-text text-transparent">VTalentHub</span>
            </a>
            <div class="hidden md:flex items-center gap-6 text-xs font-medium">
                <a href="#about" class="text-slate-600 dark:text-slate-300 hover:text-sky-400 transition-colors">Tentang</a>
                <a href="#services" class="text-slate-600 dark:text-slate-300 hover:text-sky-400 transition-colors">Layanan</a>
                <a href="#features" class="text-slate-600 dark:text-slate-300 hover:text-sky-400 transition-colors">Fitur</a>
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
                <i data-lucide="activity" class="w-3.5 h-3.5"></i>
                <span>Data Agency & Operasional Virtual Talent Global</span>
            </div>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-[1.1]">
                Platform Data Agency untuk
                <span class="bg-gradient-to-r from-sky-400 via-blue-400 to-indigo-400 bg-clip-text text-transparent">Virtual Talent</span>
            </h1>
            <p class="mt-6 text-base sm:text-lg text-slate-600 dark:text-slate-400 leading-relaxed max-w-xl">
                Solusi menyeluruh bagi VTuber pemula hingga agency profesional: pengumpulan data performa, otomasi generator kebutuhan aset streaming, panduan kurikulum debut, dan portal monetisasi kemitraan brand.
            </p>
            <div class="flex flex-wrap gap-3 mt-8">
                <a href="{{ route('register') }}" class="bg-sky-500 hover:bg-sky-400 text-slate-950 px-6 py-3 rounded-xl text-sm font-semibold transition-all shadow-lg shadow-sky-500/25 flex items-center gap-2">
                    <span>Mulai Eksplorasi Gratis</span>
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
                <a href="#services" class="glass-auto px-6 py-3 rounded-xl text-sm font-semibold hover:border-sky-500/30 transition-all flex items-center gap-2">
                    <i data-lucide="layers" class="w-4 h-4"></i>
                    <span>Arsitektur Layanan</span>
                </a>
            </div>
            <div class="grid grid-cols-3 gap-6 mt-12 pt-8 border-t border-slate-200/50 dark:border-slate-800">
                <div>
                    <div class="text-2xl font-bold text-sky-400">{{ $talentCount }}</div>
                    <div class="text-xs text-slate-500 mt-0.5">Talent Terintegrasi</div>
                </div>
                <div>
                    <div class="text-2xl font-bold text-sky-400">{{ $assetCount }}</div>
                    <div class="text-xs text-slate-500 mt-0.5">Asset Terdistribusi</div>
                </div>
                <div>
                    <div class="text-2xl font-bold text-sky-400">{{ $clientCount }}</div>
                    <div class="text-xs text-slate-500 mt-0.5">Kemitraan Brand</div>
                </div>
            </div>
        </div>
        <div class="lg:col-span-5" data-aos="fade-left">
            <div class="glass-auto rounded-3xl p-6 border border-sky-500/20 shadow-2xl relative">
                <div class="flex items-center justify-between pb-4 border-b border-slate-200/40 dark:border-slate-800">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-rose-500/60"></div>
                        <div class="w-3 h-3 rounded-full bg-amber-500/60"></div>
                        <div class="w-3 h-3 rounded-full bg-emerald-500/60"></div>
                    </div>
                    <span class="text-[11px] text-slate-500 font-mono">agency-kernel.v1</span>
                </div>
                <div class="space-y-3 mt-4">
                    <div class="p-3 rounded-xl bg-slate-900/60 border border-slate-800 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-sky-500/10 text-sky-400 flex items-center justify-center">
                                <i data-lucide="cpu" class="w-4 h-4"></i>
                            </div>
                            <div>
                                <div class="text-xs font-semibold">Autonomous Asset Synthesis</div>
                                <div class="text-[11px] text-slate-500">Generating overlays & backgrounds</div>
                            </div>
                        </div>
                        <span class="text-[10px] text-emerald-400 bg-emerald-500/10 px-2 py-0.5 rounded-full border border-emerald-500/20">Ready</span>
                    </div>
                    <div class="p-3 rounded-xl bg-slate-900/60 border border-slate-800 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-blue-500/10 text-blue-400 flex items-center justify-center">
                                <i data-lucide="database" class="w-4 h-4"></i>
                            </div>
                            <div>
                                <div class="text-xs font-semibold">Audience Intelligence Matrix</div>
                                <div class="text-[11px] text-slate-500">Tracking reach across YouTube & Twitch</div>
                            </div>
                        </div>
                        <span class="text-[10px] text-sky-400 bg-sky-500/10 px-2 py-0.5 rounded-full border border-sky-500/20">Active</span>
                    </div>
                    <div class="p-3 rounded-xl bg-slate-900/60 border border-slate-800 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-indigo-500/10 text-indigo-400 flex items-center justify-center">
                                <i data-lucide="handshake" class="w-4 h-4"></i>
                            </div>
                            <div>
                                <div class="text-xs font-semibold">Commercial Deal Pipeline</div>
                                <div class="text-[11px] text-slate-500">Automated licensing contracts</div>
                            </div>
                        </div>
                        <span class="text-[10px] text-indigo-400 bg-indigo-500/10 px-2 py-0.5 rounded-full border border-indigo-500/20">Matched</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== 2. ABOUT SECTION ===== -->
<section id="about" class="py-20 border-t border-slate-200/50 dark:border-slate-800/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto" data-aos="fade-up">
            <span class="text-xs uppercase tracking-wider font-semibold text-sky-400">Fondasi Konsep</span>
            <h2 class="text-3xl font-bold mt-2">Mengapa Model Agensi Virtual Perlu Berevolusi?</h2>
            <p class="text-sm text-slate-600 dark:text-slate-400 mt-3">
                Industri VTuber global telah menembus valuasi multi-miliar dollar, namun hambatan masuk bagi talenta independen tetap tinggi pada aspek teknis, aset visual, dan konektivitas monetisasi sponsor.
            </p>
        </div>
        <div class="grid md:grid-cols-3 gap-6 mt-12">
            <div class="glass-auto rounded-2xl p-6 border border-slate-200/50 dark:border-slate-800" data-aos="fade-up" data-aos-delay="100">
                <div class="w-10 h-10 rounded-xl bg-sky-500/10 text-sky-400 flex items-center justify-center mb-4">
                    <i data-lucide="target" class="w-5 h-5"></i>
                </div>
                <h3 class="text-base font-bold">Misi Demokratisasi</h3>
                <p class="text-xs text-slate-600 dark:text-slate-400 mt-2 leading-relaxed">
                    Menyediakan infrastruktur agensi korporat untuk kreator independen tanpa potongan komisi yang memberatkan.
                </p>
            </div>
            <div class="glass-auto rounded-2xl p-6 border border-slate-200/50 dark:border-slate-800" data-aos="fade-up" data-aos-delay="200">
                <div class="w-10 h-10 rounded-xl bg-blue-500/10 text-blue-400 flex items-center justify-center mb-4">
                    <i data-lucide="orbit" class="w-5 h-5"></i>
                </div>
                <h3 class="text-base font-bold">Infrastruktur Terintegrasi</h3>
                <p class="text-xs text-slate-600 dark:text-slate-400 mt-2 leading-relaxed">
                    Penggabungan manajemen data talent, generator aset visual siap pakai, dan negosiasi komersial dalam satu arsitektur terpusat.
                </p>
            </div>
            <div class="glass-auto rounded-2xl p-6 border border-slate-200/50 dark:border-slate-800" data-aos="fade-up" data-aos-delay="300">
                <div class="w-10 h-10 rounded-xl bg-indigo-500/10 text-indigo-400 flex items-center justify-center mb-4">
                    <i data-lucide="shield-check" class="w-5 h-5"></i>
                </div>
                <h3 class="text-base font-bold">Perlindungan Kekayaan Intelektual</h3>
                <p class="text-xs text-slate-600 dark:text-slate-400 mt-2 leading-relaxed">
                    Hak cipta avatar, model rigging, dan nama karakter sepenuhnya berada di tangan talent dengan dukungan perlindungan reputasi.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- ===== 3. SERVICES SECTION ===== -->
<section id="services" class="py-20 bg-slate-100/40 dark:bg-slate-900/30 border-y border-slate-200/50 dark:border-slate-800/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-xl mx-auto" data-aos="fade-up">
            <span class="text-xs uppercase tracking-wider font-semibold text-sky-400">Ekosistem Modul</span>
            <h2 class="text-3xl font-bold mt-2">Enam Pilar Layanan Agency</h2>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5 mt-12">
            @php
            $services = [
                ['icon' => 'users-round', 'title' => 'Talent Data Core', 'desc' => 'Katalogisasi profil karakter, channel stream, spesifikasi model Live2D/3D, dan analitik jangkauan pemirsa.'],
                ['icon' => 'wand-2', 'title' => 'Asset Generation Suite', 'desc' => 'Generator otomatis background stream resolusi tinggi, stream overlay responsif, jadwal tayang, dan visual kit.'],
                ['icon' => 'compass', 'title' => 'Curriculum & Counseling', 'desc' => 'Modul konsultasi dan roadmap terstruktur dari tahap penyusunan lore hingga pelaksanaan debut live stream.'],
                ['icon' => 'briefcase', 'title' => 'Brand Collaboration Portal', 'desc' => 'Pipeline penjajakan sponsor brand, kontrak digital legal, verifikasi deliverables, dan pencatatan komisi.'],
                ['icon' => 'bar-chart-3', 'title' => 'Ecosystem Analytics', 'desc' => 'Matriks performa multi-platform, tren subscriber, segmentasi kategori konten, dan proyeksi finansial.'],
                ['icon' => 'shield', 'title' => 'Talent IP Custody', 'desc' => 'Pencatatan aset digital dan sertifikasi keaslian karakter untuk mencegah klaim ilegal pihak luar.'],
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

<!-- ===== 4. HOW IT WORKS ===== -->
<section class="py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-xl mx-auto" data-aos="fade-up">
            <span class="text-xs uppercase tracking-wider font-semibold text-sky-400">Siklus Kerja</span>
            <h2 class="text-3xl font-bold mt-2">Alur Operasional Empat Tahap</h2>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-12">
            @php
            $steps = [
                ['num' => '01', 'title' => 'Registrasi & Persona', 'desc' => 'Pendaftaran akun, penetapan identitas virtual, lore cerita, dan platform siaran utama.'],
                ['num' => '02', 'title' => 'Spesifikasi & Visual', 'desc' => 'Identifikasi kebutuhan model Live2D/3D, rig tracking, dan otomasi visual kit siaran.'],
                ['num' => '03', 'title' => 'Uji Siaran & Debut', 'desc' => 'Kalibrasi audio, OBS capture, tracking webcam/iPhone, dan pelaksanaan stream pembuka.'],
                ['num' => '04', 'title' => 'Monetisasi & Kemitraan', 'desc' => 'Penerimaan tawaran kampanye brand sponsorship dan pelacakan hasil bagi hasil.'],
            ];
            @endphp
            @foreach($steps as $i => $st)
            <div class="glass-auto rounded-2xl p-6 border border-slate-200/50 dark:border-slate-800" data-aos="fade-up" data-aos-delay="{{ $i * 80 }}">
                <span class="text-xs font-mono font-bold text-sky-400">{{ $st['num'] }}</span>
                <h3 class="text-sm font-bold mt-3">{{ $st['title'] }}</h3>
                <p class="text-xs text-slate-600 dark:text-slate-400 mt-2 leading-relaxed">{{ $st['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ===== 5. ASSET GENERATOR DETAILS ===== -->
<section class="py-20 bg-slate-100/40 dark:bg-slate-900/30 border-y border-slate-200/50 dark:border-slate-800/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-12 items-center">
        <div data-aos="fade-right">
            <span class="text-xs uppercase tracking-wider font-semibold text-sky-400">Spesifikasi Aset Siap Pakai</span>
            <h2 class="text-3xl font-bold mt-2">Standarisasi Visual Stream Kualitas Agensi</h2>
            <p class="text-sm text-slate-600 dark:text-slate-400 mt-3 leading-relaxed">
                Platform menyediakan generator parameterik untuk memproduksi elemen visual beresolusi tinggi yang langsung kompatibel dengan perangkat lunak siaran seperti OBS Studio dan Streamlabs.
            </p>
            <div class="grid grid-cols-2 gap-3 mt-6 text-xs">
                <div class="p-3 rounded-xl bg-slate-900/40 border border-slate-800 flex items-center gap-2">
                    <i data-lucide="image" class="w-4 h-4 text-sky-400"></i>
                    <span>Background 1920x1080 / 2K</span>
                </div>
                <div class="p-3 rounded-xl bg-slate-900/40 border border-slate-800 flex items-center gap-2">
                    <i data-lucide="layout" class="w-4 h-4 text-sky-400"></i>
                    <span>Overlay Gameplay 60FPS</span>
                </div>
                <div class="p-3 rounded-xl bg-slate-900/40 border border-slate-800 flex items-center gap-2">
                    <i data-lucide="calendar" class="w-4 h-4 text-sky-400"></i>
                    <span>Weekly Stream Schedule</span>
                </div>
                <div class="p-3 rounded-xl bg-slate-900/40 border border-slate-800 flex items-center gap-2">
                    <i data-lucide="smile" class="w-4 h-4 text-sky-400"></i>
                    <span>Emote Badge Grid</span>
                </div>
            </div>
        </div>
        <div class="glass-auto rounded-3xl p-6 border border-sky-500/20" data-aos="fade-left">
            <div class="space-y-3">
                <div class="p-4 rounded-xl bg-slate-900/70 border border-slate-800 flex items-center justify-between">
                    <div>
                        <div class="text-xs font-semibold text-slate-200">Cyberpunk Room Backdrop</div>
                        <div class="text-[11px] text-slate-500 font-mono">1920x1080 · PNG Lossless</div>
                    </div>
                    <span class="text-[10px] text-sky-400 font-mono">RENDERED</span>
                </div>
                <div class="p-4 rounded-xl bg-slate-900/70 border border-slate-800 flex items-center justify-between">
                    <div>
                        <div class="text-xs font-semibold text-slate-200">Minimalist Frame Overlay</div>
                        <div class="text-[11px] text-slate-500 font-mono">WebM Transparent · Chat & Cam</div>
                    </div>
                    <span class="text-[10px] text-sky-400 font-mono">READY</span>
                </div>
                <div class="p-4 rounded-xl bg-slate-900/70 border border-slate-800 flex items-center justify-between">
                    <div>
                        <div class="text-xs font-semibold text-slate-200">Weekly Schedule Card</div>
                        <div class="text-[11px] text-slate-500 font-mono">1080x1920 Story & 1200x675 X</div>
                    </div>
                    <span class="text-[10px] text-sky-400 font-mono">EXPORTED</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== 6. ROADMAP ===== -->
<section id="roadmap" class="py-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-xl mx-auto" data-aos="fade-up">
            <span class="text-xs uppercase tracking-wider font-semibold text-sky-400">Peta Rencana</span>
            <h2 class="text-3xl font-bold mt-2">Milestone Pengembangan Sistem</h2>
        </div>
        <div class="space-y-4 mt-12">
            @php
            $milestones = [
                ['q' => 'Fase 1 (Aktif)', 'title' => 'Dasar Infrastruktur Agency', 'desc' => 'Modul katalogisasi talent, generator aset terstandarisasi, serta basis data SQLite/MySQL terenkripsi.', 'status' => 'Selesai'],
                ['q' => 'Fase 2', 'title' => 'Integrasi API OAuth & Tracking', 'desc' => 'Autentikasi aman melalui Google OAuth, sinkronisasi metrik statistik langsung ke YouTube Data API dan Twitch API.', 'status' => 'Berjalan'],
                ['q' => 'Fase 3', 'title' => 'Sistem Rekomendasi Sponsor AI', 'desc' => 'Pencocokan profil demografi audiens talent secara otomatis terhadap kriteria brand pengiklan global.', 'status' => 'Mendatang'],
                ['q' => 'Fase 4', 'title' => 'Marketplace Aset & Hak Lisensi', 'desc' => 'Bursa pertukaran model Live2D dan rigging 3D berlisensi komersial dengan pembagian royalti transparan.', 'status' => 'Mendatang'],
            ];
            @endphp
            @foreach($milestones as $i => $m)
            <div class="glass-auto rounded-2xl p-5 border border-slate-200/50 dark:border-slate-800 flex flex-col sm:flex-row sm:items-center justify-between gap-4" data-aos="fade-up" data-aos-delay="{{ $i * 60 }}">
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

<!-- ===== 7. PRICING ===== -->
<section id="pricing" class="py-20 bg-slate-100/40 dark:bg-slate-900/30 border-y border-slate-200/50 dark:border-slate-800/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-xl mx-auto" data-aos="fade-up">
            <span class="text-xs uppercase tracking-wider font-semibold text-sky-400">Struktur Biaya</span>
            <h2 class="text-3xl font-bold mt-2">Transparansi Paket Akses</h2>
        </div>
        <div class="grid md:grid-cols-3 gap-6 mt-12 max-w-5xl mx-auto">
            <div class="glass-auto rounded-2xl p-6 border border-slate-200/50 dark:border-slate-800" data-aos="fade-up">
                <span class="text-xs font-mono text-slate-400">INDEPENDENT</span>
                <div class="text-2xl font-bold mt-2">Gratis</div>
                <p class="text-xs text-slate-500 mt-1">Untuk kreator virtual yang baru merintis siaran.</p>
                <ul class="mt-6 space-y-2 text-xs text-slate-600 dark:text-slate-300">
                    <li class="flex items-center gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-sky-400"></i> 1 Profil Karakter Virtual</li>
                    <li class="flex items-center gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-sky-400"></i> 5 Kali Generate Aset / Bulan</li>
                    <li class="flex items-center gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-sky-400"></i> Modul Konseling Dasar</li>
                </ul>
                <a href="{{ route('register') }}" class="block text-center mt-6 py-2.5 rounded-xl border border-slate-700 text-xs font-semibold hover:bg-slate-800 transition-colors">Daftar Akun</a>
            </div>
            <div class="glass-auto rounded-2xl p-6 border border-sky-500/40 bg-sky-500/5 shadow-xl shadow-sky-500/10 relative" data-aos="fade-up" data-aos-delay="100">
                <span class="absolute top-4 right-4 text-[10px] bg-sky-500 text-slate-950 px-2 py-0.5 rounded-full font-bold">REKOMENDASI</span>
                <span class="text-xs font-mono text-sky-400">AFFILIATE VTUBER</span>
                <div class="text-2xl font-bold mt-2">Rp 149.000 <span class="text-xs font-normal text-slate-500">/ bulan</span></div>
                <p class="text-xs text-slate-500 mt-1">Untuk talent aktif yang mengincar kontrak brand berbayar.</p>
                <ul class="mt-6 space-y-2 text-xs text-slate-600 dark:text-slate-300">
                    <li class="flex items-center gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-sky-400"></i> Hingga 5 Profil Talent</li>
                    <li class="flex items-center gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-sky-400"></i> Generate Aset Tanpa Batas</li>
                    <li class="flex items-center gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-sky-400"></i> Portal Kerjasama Brand Terbuka</li>
                    <li class="flex items-center gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-sky-400"></i> Ekspor Analitik Format JSON/CSV</li>
                </ul>
                <a href="{{ route('register') }}" class="block text-center mt-6 py-2.5 rounded-xl bg-sky-500 hover:bg-sky-400 text-slate-950 text-xs font-semibold transition-all">Pilih Paket Affiliate</a>
            </div>
            <div class="glass-auto rounded-2xl p-6 border border-slate-200/50 dark:border-slate-800" data-aos="fade-up" data-aos-delay="200">
                <span class="text-xs font-mono text-slate-400">CORPO / AGENCY</span>
                <div class="text-2xl font-bold mt-2">Rp 599.000 <span class="text-xs font-normal text-slate-500">/ bulan</span></div>
                <p class="text-xs text-slate-500 mt-1">Untuk agensi beranggotakan banyak talent dan manajer tim.</p>
                <ul class="mt-6 space-y-2 text-xs text-slate-600 dark:text-slate-300">
                    <li class="flex items-center gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-sky-400"></i> Profil Talent Tanpa Batas</li>
                    <li class="flex items-center gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-sky-400"></i> Akun Manajer Multi-User</li>
                    <li class="flex items-center gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-sky-400"></i> Kustomisasi Branding Agensi</li>
                    <li class="flex items-center gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-sky-400"></i> Prioritas Penanganan Kemitraan</li>
                </ul>
                <a href="{{ route('register') }}" class="block text-center mt-6 py-2.5 rounded-xl border border-slate-700 text-xs font-semibold hover:bg-slate-800 transition-colors">Hubungi Tim</a>
            </div>
        </div>
    </div>
</section>

<!-- ===== 8. FAQ ===== -->
<section id="faq" class="py-20">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center" data-aos="fade-up">
            <span class="text-xs uppercase tracking-wider font-semibold text-sky-400">Klarifikasi Informasi</span>
            <h2 class="text-3xl font-bold mt-2">Pertanyaan yang Sering Diajukan</h2>
        </div>
        <div class="mt-10 space-y-3">
            @php
            $faqs = [
                ['q' => 'Apakah hak cipta model karakter saya tetap menjadi milik pribadi?', 'a' => 'Ya, 100%. VTalentHub bertindak sebagai sistem pendukung data dan tidak memegang hak kepemilikan atas desain karakter, kekayaan intelektual, maupun aset model Anda.'],
                ['q' => 'Bagaimana sistem mencocokkan talent dengan brand pengiklan?', 'a' => 'Data jangkauan statistik, demografi audiens, serta genre konten Anda disajikan dalam format katalog anonim/publik yang dapat dipilih langsung oleh sponsor.'],
                ['q' => 'Apakah diperlukan perangkat keras spesifikasi tinggi untuk menggunakan generator aset?', 'a' => 'Tidak. Seluruh proses perenderan visual ditangani di sisi server dan disajikan dalam format berkas siap unduh langsung.'],
                ['q' => 'Bisakah agensi yang sudah memiliki talent memakai platform ini?', 'a' => 'Bisa. Tersedia tingkatan peran akun Manager dan Admin untuk memantau performa banyak talent dalam satu organisasi.'],
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

<!-- ===== 9. CONTACT ===== -->
<section id="contact" class="py-20 bg-slate-100/40 dark:bg-slate-900/30 border-t border-slate-200/50 dark:border-slate-800/60">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 grid md:grid-cols-2 gap-10 items-center">
        <div data-aos="fade-right">
            <span class="text-xs uppercase tracking-wider font-semibold text-sky-400">Saluran Komunikasi</span>
            <h2 class="text-3xl font-bold mt-2">Bermitra atau Ajukan Konsultasi</h2>
            <p class="text-xs text-slate-600 dark:text-slate-400 mt-3 leading-relaxed">
                Tim operasional kami siap membantu integrasi agensi baru, lisensi konten, maupun kebutuhan kampanye sponsor brand.
            </p>
            <div class="space-y-3 mt-6 text-xs text-slate-400">
                <div class="flex items-center gap-2.5">
                    <i data-lucide="mail" class="w-4 h-4 text-sky-400"></i>
                    <span>partnerships@vtalenthub.internal</span>
                </div>
                <div class="flex items-center gap-2.5">
                    <i data-lucide="globe" class="w-4 h-4 text-sky-400"></i>
                    <span>Jakarta · Tokyo · Global Network</span>
                </div>
            </div>
        </div>
        <form class="glass-auto rounded-2xl p-6 border border-slate-200/50 dark:border-slate-800 space-y-3"
              onsubmit="event.preventDefault(); this.reset(); alert('Pesan berhasil terkirim ke tim operasi.')" data-aos="fade-left">
            <div>
                <label class="block text-[11px] font-semibold text-slate-400 mb-1">Nama / Identitas</label>
                <input type="text" required placeholder="Nama Anda atau Brand"
                       class="w-full bg-slate-900/80 rounded-xl px-3.5 py-2 text-xs outline-none focus:ring-1 focus:ring-sky-400 border border-slate-800">
            </div>
            <div>
                <label class="block text-[11px] font-semibold text-slate-400 mb-1">Email Korespodensi</label>
                <input type="email" required placeholder="nama@domain.com"
                       class="w-full bg-slate-900/80 rounded-xl px-3.5 py-2 text-xs outline-none focus:ring-1 focus:ring-sky-400 border border-slate-800">
            </div>
            <div>
                <label class="block text-[11px] font-semibold text-slate-400 mb-1">Pesan / Penawaran</label>
                <textarea rows="3" required placeholder="Tuliskan tujuan kerjasama atau pertanyaan..."
                          class="w-full bg-slate-900/80 rounded-xl px-3.5 py-2 text-xs outline-none focus:ring-1 focus:ring-sky-400 border border-slate-800 resize-none"></textarea>
            </div>
            <button type="submit" class="w-full bg-sky-500 hover:bg-sky-400 text-slate-950 py-2.5 rounded-xl text-xs font-semibold transition-all">
                Kirimkan Pesan
            </button>
        </form>
    </div>
</section>

<!-- ===== 10. FOOTER ===== -->
<footer class="py-12 border-t border-slate-200/50 dark:border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
        <div class="flex items-center gap-2">
            <div class="w-6 h-6 rounded-md bg-sky-500/10 text-sky-400 flex items-center justify-center">
                <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
            </div>
            <span class="font-bold text-slate-400">VTalentHub</span>
            <span>· Virtual Talent Data Agency Infrastructure</span>
        </div>
        <div>
            &copy; {{ date('Y') }} Hak cipta dilindungi undang-undang.
        </div>
    </div>
</footer>
@endsection
