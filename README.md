# VTalentHub — Virtual Talent Data Agency Infrastructure

Platform operasional data agency dan otomatisasi aset bagi ekosistem Virtual Talent (VTuber) independen maupun skala agensi profesional. Dibangun di atas **Laravel 13**, **Tailwind CSS v4 (Browser CDN)**, **Alpine.js**, **AOS Animation**, dan pustaka vektor **Lucide Icons CDN**.

---

## 1. Latar Belakang & Nilai Inovasi

Industri Virtual YouTuber (VTuber) global pada tahun 2026 telah melewati valuasi $3.13 Miliar dengan pertumbuhan tahunan (CAGR) tinggi. Namun terdapat ketimpangan signifikan:
- **Kesenjangan Teknis**: VTuber baru kerap terbentur proses penyiapan aset (background loss-less, overlay HUD, weekly schedule card, emote pack, dan pengikatan rigging Live2D/3D).
- **Akses Sponsorship Tertutup**: Mayoritas brand korporat hanya bertransaksi melalui agensi konglomerat (seperti Hololive / Nijisanji), menyisakan talent independen tanpa jalur legal dan pipeline komersial yang terstruktur.
- **Ketiadaan Platform Data Terpusat**: Belum adanya platform yang mengumpulkan data metrik talent multi-platform (YouTube, Twitch, TikTok) sekaligus menyediakan generator otomatisasi kebutuhan siaran.

**VTalentHub** hadir untuk menjawab celah ini dengan menyediakan infrastruktur operasional layaknya agensi korporat untuk setiap kreator virtual.

---

## 2. Fitur & Modul Utama

### A. Katalogisasi & Manajemen Talent (`/talents`)
- Penyimpanan profil karakter virtual lengkap (nama panggung, identitas internal, lore, genre konten, bahasa, tipe model).
- Pelacakan status kesiapan debut (`onboarding`, `active`, `inactive`).
- Manajemen daftar kebutuhan aset individual per talent (`talent_needs`).

### B. Generator & Sintesis Aset Visual (`/assets`)
- Otomasi pendefinisian berkas grafis siaran:
  - Stream Background (1920x1080 / 2K)
  - Stream Overlay HUD (kompatibel OBS & Streamlabs)
  - Wallpaper Promosi
  - Emote Pack (128x128)
  - Weekly Schedule Template
- Penyesuaian tema visual (Cyberpunk, Kawaii Pastel, Minimalist Slate, Sci-fi).
- Pelacakan metrik jumlah unduhan dan alokasi aset untuk talent khusus.

### C. Kurikulum & Asisten Konsultasi Virtual (`/counseling`)
- Modul panduan 5 tahap terstruktur menuju debut siaran.
- Asisten interaktif berbasis dialog asinkron untuk menjawab rincian teknis:
  - Alur memulai dari nol
  - Rincian estimasi biaya (Gratis vs Budget vs Premium)
  - Pemilihan software (OBS Studio, VTube Studio, VSeeFace)
  - Metode monetisasi (Super Chat, Membership, Sponsorship, Merch).

### D. Pipeline Kemitraan Komersial Brand (`/clients`)
- Manajemen siklus kesepakatan endorsement (`Lead` -> `Negosiasi` -> `Kontrak Aktif` -> `Selesai`).
- Kalkulasi total nilai transaksi per tahap pipeline.
- Pengaitan kontrak sponsorship dengan talent tertentu atau terbuka untuk seluruh talent agensi.

### E. Analitik & Ekspor Data (`/analytics`)
- Visualisasi Chart.js real-time:
  - Distribusi talent per platform
  - Rasio status kesiapan talent
  - Komposisi kategori aset tergenerate
  - Rincian sumber pendapatan kerjasama sponsor
- Fitur ekspor basis data format JSON.

### F. Keamanan, Sesi & Autentikasi
- Arsitektur berbasis **Google OAuth Single Sign-On (SSO)** via Laravel Socialite.
- Sistem otentikasi ganda (Kredensial lokal + Google Login).
- Manajemen peran pengguna (`RoleMiddleware`: admin, manager, talent, client, user).
- Proteksi CSRF, enkripsi sesi, dan parameterized query PDO.

---

## 3. Arsitektur Basis Data

Skrip pembuatan schema lengkap dan mandiri tersedia di:
```
database/schema.sql
```

Tabel inti mencakup:
1. `users`: Entitas pengelola, talent, atau mitra brand dengan kolom `google_id` dan `role`.
2. `talents`: Data profil karakter virtual, statistik audiens, dan referensi channel siaran.
3. `talent_needs`: Item checklist kebutuhan aset per karakter.
4. `assets`: Metadata dan spesifikasi aset grafis yang tergenerate.
5. `clients`: Pipeline kesepakatan komersial dan nilai deal kemitraan.
6. `counseling_sessions`: Riwayat sesi tanya jawab konsultasi virtual.
7. `activity_logs`: Jejak audit tindakan sistem.
8. `team_members`: Struktur tim agensi.

---

## 4. Prasyarat Sistem

- **PHP**: 8.2 atau lebih baru (Diuji pada PHP 8.5.5)
- **Ekstensi PHP**: `pdo_sqlite` (atau `pdo_mysql`), `mbstring`, `openssl`, `curl`
- **Composer**: v2.x
- **Web Server**: Apache / Nginx / Built-in PHP CLI

---

## 5. Panduan Instalasi & Menjalankan

### Langkah 1: Kloning / Salin Berkas
```bash
git clone <URL_REPOSITORY>
cd aplikasih
```

### Langkah 2: Instalasi Ketergantungan Backend
```bash
composer install --no-interaction
```

### Langkah 3: Konfigurasi Lingkungan (`.env`)
Salin berkas konfigurasi sampel jika belum ada:
```bash
cp .env.example .env
php artisan key:generate
```

Untuk mengaktifkan autentikasi Google OAuth, tambahkan kredensial pada `.env`:
```env
GOOGLE_CLIENT_ID=your_client_id_here
GOOGLE_CLIENT_SECRET=your_client_secret_here
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback
```

### Langkah 4: Migrasi & Inisialisasi Data Demo
```bash
php artisan migrate:fresh --seed
```

### Langkah 5: Menjalankan Server Lokal
```bash
php artisan serve
```
Akses aplikasi melalui peramban: `http://127.0.0.1:8000`

---

## 6. Akun Pengujian Default

- **URL Login**: `http://127.0.0.1:8000/login`
- **Email**: `admin@vtalenthub.internal`
- **Kata Sandi**: `password`
- **Peran**: `admin`

---

## 7. Desain Antarmuka

- Menggunakan palet biru muda profesional (`#38bdf8` / Sky Blue) dengan aksen Indigo.
- Mendukung mode tampilan Gelap (Dark Mode) dan Terang (Light Mode) otomatis via Alpine.js.
- Seluruh ikon menggunakan pustaka vektor SVG melalui Lucide CDN tanpa ketergantungan emoji dekoratif.
- Animasi transisi halus didukung pustaka AOS (Animate on Scroll).

---

## 8. Lisensi

Hak Cipta dilindungi. Dikembangkan untuk standardisasi operasional agensi virtual talent modern.
