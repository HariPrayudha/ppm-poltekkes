# Web Portal & CMS Pusat Penjaminan Mutu (PPM) Poltekkes Kemenkes Medan

[![Laravel 13](https://img.shields.io/badge/Laravel-13.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP 8.3+](https://img.shields.io/badge/PHP-8.3%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![Tailwind CSS v4](https://img.shields.io/badge/Tailwind_CSS-v4.0-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![MySQL](https://img.shields.io/badge/MySQL-8.0%2B-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://mysql.com)
[![Test Suite](https://img.shields.io/badge/Tests-68%20Passed%20%7C%20241%20Assertions-success?style=for-the-badge&logo=checkmarx&logoColor=white)](https://github.com/HariPrayudha/ppm-poltekkes)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg?style=for-the-badge)](LICENSE)

Aplikasi Web Portal Publik dan Content Management System (CMS) resmi untuk **Pusat Penjaminan Mutu (PPM) Politeknik Kesehatan Kementerian Kesehatan Medan**. Sistem ini dirancang untuk mendiseminasikan dokumen Sistem Penjaminan Mutu Internal (SPMI), profil organisasi, standar mutu, berita visual kegiatan, dan saluran komunikasi secara transparan, aman, responsif, dan mudah dikelola.

---

## Tautan Resmi Proyek

- **Production Live URL:** [https://ppm.hariprayudha.tech/](https://ppm.hariprayudha.tech/)
- **Repository GitHub:** [https://github.com/HariPrayudha/ppm-poltekkes.git](https://github.com/HariPrayudha/ppm-poltekkes.git)

---

## Ringkasan Fitur

### 1. Portal Publik (Frontend)
- **Beranda Institusi:**
  - Banner informasi dan pengumuman visual interaktif.
  - Sambutan resmi Kepala Pusat Penjaminan Mutu beserta profil pimpinan.
  - Informasi 6 pilar layanan penjaminan mutu internal kampus.
  - Akses cepat ke portal dan aplikasi eksternal mitra kesehatan dan pendidikan tinggi.
- **Profil Organisasi:**
  - Bagan struktur organisasi resmi kepemimpinan PPM dengan fitur perbesaran gambar.
  - Informasi lengkap tugas pokok, fungsi, dan landasan operasional mutu.
- **Repositori Dokumen & SOP:**
  - Repositori dokumen mutu (Kebijakan, Manual, Standar, Formulir, dan SOP).
  - Pencarian dokumen cepat dan filter berdasarkan kategori serta tahun terbit.
  - Pratinjau dokumen PDF langsung di peramban serta opsi unduh berkas resmi.
- **Galeri Dokumentasi:**
  - Dokumentasi visual kegiatan audit mutu, workshop, dan akreditasi.
  - Penyaringan foto berdasarkan tahun kegiatan disertai keterangan pelaksanaan.
- **Layanan Informasi & Kontak:**
  - Informasi alamat kampus, jam operasional layanan, telepon, dan pos-el resmi.
  - Peta lokasi interaktif dan tautan media sosial kampus.
  - Akses langsung menuju Portal Admin pada bagian footer.

### 2. Panel Pengelolaan Konten (CMS Admin)
- **Dashboard Statistik:** Ringkasan jumlah dokumen, banner, layanan, galeri, dan tautan aktif.
- **Manajemen Banner:** Pengelolaan gambar banner pengumuman dan tautan aksi.
- **Manajemen Sambutan:** Pembaruan foto pimpinan dan naskah sambutan resmi Kepala PPM.
- **Manajemen Layanan:** Pengelolaan daftar layanan penjaminan mutu, deskripsi, dan ikon pendukung.
- **Manajemen Link Terkait:** Pengelolaan tautan situs eksternal dan logo institusi mitra.
- **Manajemen Profil Institusi:** Pembaruan bagan struktur organisasi dan isi tugas fungsi.
- **Manajemen Dokumen Mutu:** Pengelolaan kategori dokumen, kode resmi SPMI, tahun terbit, dan unggah berkas PDF.
- **Manajemen Galeri Kegiatan:** Publikasi dokumentasi foto, tanggal kegiatan, dan deskripsi acara.
- **Manajemen Kontak:** Pembaruan data kontak kampus, jam operasional, dan lokasi.
- **Manajemen Pengguna (Khusus Super Admin):** Pengelolaan akun pengguna, pembagian peran hak akses (role), pengaturan kata sandi, dan status keaktifan akun.

---

## Hak Akses & Akun Bawaan (Role-Based Access Control)

Sistem menerapkan Role-Based Access Control (RBAC) ketat yang dikonfigurasi melalui middleware:

| Role | Batasan Akses | Kredensial Default |
| :--- | :--- | :--- |
| **Super Admin** | Akses penuh ke seluruh modul sistem, konfigurasi konten, serta modul Manajemen Pengguna (User Management). | **Email:** `superadmin@ppm.ac.id`<br>**Password:** `password` |
| **Operator Mutu** | Akses ke seluruh modul pengelolaan konten publik (Banner, Sambutan, Profil, Dokumen, Galeri, Layanan, Kontak). Tidak memiliki hak akses ke Manajemen Pengguna. | **Email:** `operator@ppm.ac.id`<br>**Password:** `password` |

---

## Spesifikasi Teknologi (Tech Stack)

- **Framework:** Laravel 13 (Arsitektur MVC Tradisional)
- **Bahasa Pemrograman:** PHP 8.3+
- **Database Engine:** MySQL 8.0+
- **Styling & CSS Engine:** Tailwind CSS v4 dengan CSS Variable Tokens
- **Ikon Antarmuka:** Feather Icons & Font Awesome Brands (Free)
- **Rich Text Editor:** TinyMCE (via Official CDN)
- **Notifikasi Interaktif:** SweetAlert2 (via Official CDN)
- **Standar Kode & Linter:** Laravel Pint (PSR-12 compliant)
- **Automated Testing:** PHPUnit Test Framework

---

## Panduan Instalasi & Konfigurasi Lokal

Ikuti langkah-langkah berikut untuk menjalankan proyek di lingkungan pengembangan lokal:

### 1. Prasyarat Sistem
- PHP >= 8.3 dengan ekstensi `pdo_mysql`, `mbstring`, `fileinfo`, `gd`, `openssl`
- Composer >= 2.6
- Node.js >= 20.x & NPM >= 10.x
- Server Database MySQL (XAMPP, Laragon, atau Docker)

### 2. Kloning Repository
```bash
git clone https://github.com/HariPrayudha/ppm-poltekkes.git
cd ppm-poltekkes
```

### 3. Instalasi Dependensi PHP & JavaScript
```bash
composer install
npm install
```

### 4. Konfigurasi Environment (`.env`)
Salin file `.env.example` menjadi `.env`:
```bash
cp .env.example .env
```
Buka file `.env` dan sesuaikan parameter koneksi database Anda:
```env
APP_NAME="PPM Poltekkes Medan"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ppm_poltekkes
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Generate Application Key
```bash
php artisan key:generate
```

### 6. Migrasi & Seeder Database
Pastikan database dengan nama `ppm_poltekkes` telah dibuat di MySQL, kemudian jalankan migrasi beserta 10 dataset seeder resmi:
```bash
php artisan migrate:fresh --seed
```

### 7. Buat Symbolic Link Storage
Pastikan direktori publik terhubung ke storage berkas:
```bash
php artisan storage:link
```

### 8. Jalankan Server Pengembangan
Jalankan kompilasi aset frontend dan web server Laravel:

**Terminal 1 (Vite Asset Server):**
```bash
npm run dev
```

**Terminal 2 (Laravel Artisan Server):**
```bash
php artisan serve
```

Aplikasi kini dapat diakses melalui browser di [http://localhost:8000](http://localhost:8000).

---

## Pengujian Otomatis (Automated Testing)

Proyek ini dilengkapi dengan cakupan pengujian komprehensif (Unit & Feature Test) yang menguji fungsionalitas autentikasi, otorisasi RBAC, operasi CRUD modul admin, penyajian dokumen publik, pengalihan rute, serta keamanan berkas.

Untuk menjalankan seluruh rangkaian pengujian:
```bash
php artisan test
```

### Ringkasan Cakupan Pengujian:
- **`AuthTest`**: Validasi otentikasi login, sesi aktif, proteksi akun nonaktif, dan logout.
- **`RoleAccessTest`**: Pengujian batas hak akses antara role `super_admin` dan `operator_mutu` pada modul kritis.
- **`AdminCrudTest`**: Pengujian integritas penyimpanan, pembaruan, dan penghapusan data master untuk seluruh 9 modul admin.
- **`PublicPagesTest`**: Pengujian render halaman utama, halaman dokumen, streaming Anti-IDM Blob PDF, galeri, dan kontak institusi.

Hasil pengujian terkini:
```text
Pass: 68 tests, 241 assertions (Duration: ~23s)
```

---

## Standardisasi Kode & Linter

Pemeriksaan gaya penulisan kode PHP menggunakan Laravel Pint:
```bash
vendor/bin/pint --test
```
Untuk memformat ulang kode secara otomatis:
```bash
vendor/bin/pint
```

---

## Arsitektur & Keamanan Kode

1. **Anti-IDM Blob Streaming:**
   Endpoint pratinjau dokumen publik (`/dokumen/{document}/preview`) mengirimkan header `X-Preview-Request: 1` dengan respons biner. JavaScript di sisi peramban membuat instansiasi `URL.createObjectURL(blob)` lokal untuk elemen `iframe`, sehingga software pihak ketiga seperti IDM tidak mencegat aliran pembacaan berkas.
2. **Thin Controllers & Dedicated Services:**
   Logika pemrosesan file, penyimpanan multi-part, dan transaksi database didelegasikan ke layer service (`app/Services/`), menjaga controller tetap ringkas dan mudah dipelihara.
3. **Form Request Validation:**
   Seluruh input form divalidasi melalui kelas Form Request tersendiri (`app/Http/Requests/Admin/`) dengan format array `['required', 'string']` dan pesan kesalahan dalam Bahasa Indonesia yang formal.
4. **Proteksi Akses & Sanitasi Input:**
   - Semua form dilindungi token CSRF `@csrf`.
   - Pencegahan XSS dilakukan dengan penggunaan sintaks interpolasi `{{ ... }}` di seluruh template Blade.
   - Pengecualian rich text TinyMCE (`{!! ... !!}`) hanya diterapkan pada konten berwenang yang telah disaring.
5. **Clean Typography & Anti-Slop:**
   Antarmuka pengguna menerapkan Bahasa Indonesia baku institusional dengan tipografi yang bersih dan profesional khas instansi pemerintah Kementerian Kesehatan.

---

## Struktur Direktori Utama

```text
ppm-poltekkes/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/         # Controller pengelolaan modul CMS
│   │   │   ├── Auth/          # Controller login & otentikasi
│   │   │   └── Frontend/      # Controller halaman publik portal
│   │   ├── Middleware/        # Middleware proteksi role & status akun
│   │   └── Requests/Admin/    # Kelas Form Request validasi terpusat
│   ├── Models/                # Model Eloquent data master
│   └── Services/              # Business logic & penanganan berkas
├── database/
│   ├── migrations/            # Skema tabel database
│   └── seeders/               # 10 seeder data inisialisasi resmi
├── public/
│   ├── dashboard/assets/      # Aset CSS & JS khusus panel admin
│   └── frontend/assets/       # Aset CSS & JS khusus portal publik
├── resources/
│   └── views/
│       ├── admin/             # Tampilan Blade panel admin
│       ├── auth/              # Tampilan formulir login
│       ├── components/        # Komponen Blade reusable (admin & frontend)
│       ├── frontend/          # Tampilan Blade halaman portal publik
│       └── layouts/           # Master layout admin & frontend
├── routes/
│   └── web.php                # Deklarasi rute web publik & admin
└── tests/
    └── Feature/               # Skenario pengujian otomatis
```

---

## Pengembang & Lisensi

Proyek aplikasi web ini dirancang dan dikembangkan secara mandiri oleh:

- **Pengembang:** Hari Prayudha
- **Tujuan Proyek:** Proses Seleksi & Penilaian Teknis (Recruitment Technical Assessment)
- **Lisensi:** Open-source di bawah lisensi [MIT License](LICENSE)

Hak cipta (c) 2026 Hari Prayudha. Seluruh kode sumber, dokumentasi, dan aset yang dikembangkan dalam repositori ini dapat dipergunakan dan didistribusikan sesuai dengan ketentuan lisensi MIT.

