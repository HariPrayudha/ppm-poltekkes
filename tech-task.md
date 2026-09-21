# PRODUCT REQUIREMENT DOCUMENT (PRD) & SOFTWARE REQUIREMENTS SPECIFICATION (SRS)

**Nama Proyek:** Website Portal & CMS Pusat Penjaminan Mutu (PPM) Poltekkes Kemenkes Medan
**Teknologi Utama:** Laravel 13, PHP 8.3+, MySQL / MariaDB, Blade / Tailwind CSS
**Tujuan Dokumen:** Spesifikasi Kebutuhan Teknis Proyek Uji / Technical Assessment Pelamar

---

# 1. RINGKASAN & RUANG LINGKUP PROYEK

## 1.1 Latar Belakang & Tujuan

Membangun web portal resmi **Pusat Penjaminan Mutu (PPM) Poltekkes Kemenkes Medan**.

Portal ini berfungsi sebagai:

- Media transparansi instrumen mutu internal.
- Repositori dokumen dan SOP yang dapat diakses civitas akademika.
- Media publikasi kegiatan penjaminan mutu.
- Pusat informasi dan kontak resmi PPM.

## 1.2 Target Deliverables Pelamar

### 1. Frontend Landing Page Publik

Tampilan web yang modern, clean, dan responsif sesuai struktur menu yang telah ditentukan.

### 2. Backoffice Admin Panel (CMS)

Panel administrasi terproteksi otentikasi login untuk mengelola **CRUD** seluruh komponen konten yang tampil pada landing page.

### 3. Hak Akses (Role-Based Access Control)

Sistem memiliki dua tingkat hak akses:

- **Super Admin**
- **Admin Operator Mutu**

### 4. Database & Setup

Menyediakan:

- File migration skema database.
- Seeder data awal.
- Panduan instalasi melalui berkas `README.md`.

---

# 2. SPESIFIKASI FUNGSIONAL: HALAMAN PUBLIK (FRONTEND)

## 2.1 Header & Navigasi Utama

Navbar institusi memuat logo resmi **Poltekkes Kemenkes Medan** dengan struktur menu:

- **Beranda / Dashboard**
- **Profil**
    - Struktur Organisasi
    - Tugas & Fungsi

- **Dokumen & SOP**
- **Galeri**
- **Kontak**

---

## 2.2 Halaman / Bagian Dashboard (Beranda)

### Hero Banner / Slider

Banner gambar bergerak menggunakan carousel/slider yang dapat memuat:

- Judul pengumuman.
- Teks ringkas / subjudul.
- Gambar pendukung.
- Tombol **Call-to-Action (CTA)**.

### Section Sambutan Kepala PPM

Menampilkan:

- Foto resmi Kepala PPM.
- Nama lengkap beserta gelar.
- NIP / jabatan.
- Teks sambutan resmi mengenai penjaminan mutu kampus.

### Section Layanan Kami

Menampilkan daftar kartu layanan penjaminan mutu, contoh:

- Konsultasi SPMI.
- Audit Mutu Internal (AMI).
- Pendampingan Akreditasi.
- Pengelolaan Survei Kepuasan.

### Section Link Terkait

Menampilkan daftar tautan eksternal penting beserta logo institusi / aplikasi terkait, contoh:

- Kemenkes RI.
- Pusat Penjaminan Mutu Nasional.
- LAM-PTKes.
- BAN-PT.
- Si-SDMK.

### Footer Institusi

Menampilkan:

- Informasi identitas kampus.
- Copyright.
- Tautan cepat.
- Akses menuju laman login admin.

---

## 2.3 Menu Profil (Dropdown)

### Sub-menu Struktur Organisasi

Menampilkan bagan visual struktur organisasi **PPM Poltekkes Kemenkes Medan** dengan fitur:

- Preview gambar.
- Tampilan ukuran penuh.
- Fitur perbesaran menggunakan lightbox / modal.

### Sub-menu Tugas & Fungsi

Menampilkan teks deskripsi lengkap mengenai **Tugas Pokok dan Fungsi (Tupoksi)** Pusat Penjaminan Mutu berdasarkan ketetapan statuta kampus.

---

## 2.4 Menu Dokumen & SOP

### Fitur Filter

Menyediakan dropdown atau tab filter untuk menyaring dokumen berdasarkan kategori, contoh:

- Kebijakan Mutu.
- Manual Mutu.
- Standar Mutu.
- SOP.
- Formulir.

### Input Pencarian

Form pencarian cepat berdasarkan:

- Nama dokumen.
- Kode dokumen.

### Tabel Data Dokumen & SOP

Tabel menampilkan kolom:

| No  | Kode            | Nama Dokumen   | Kategori | Tahun Terbit | Aksi          |
| --- | --------------- | -------------- | -------- | ------------ | ------------- |
| 1   | SOP/PPM/01/2026 | Contoh Dokumen | SOP      | 2026         | Lihat / Unduh |

Keterangan:

1. **No** — Nomor urut dinamis.
2. **Kode** — Contoh: `SOP/PPM/01/2026`.
3. **Nama Dokumen** — Nama dokumen.
4. **Kategori** — Kategori dokumen.
5. **Tahun Terbit** — Tahun penerbitan dokumen.
6. **Aksi** — Tombol **Lihat Dokumen** untuk membuka / preview PDF pada tab baru atau **Unduh Dokumen** untuk mengunduh file.

---

## 2.5 Menu Galeri

Menampilkan kartu galeri foto dalam bentuk grid.

Setiap item galeri memuat:

- Foto dokumentasi kegiatan.
- Judul kegiatan.
- Tanggal pelaksanaan.

Contoh kegiatan:

- RTM.
- Audit Mutu Internal.
- Workshop.
- Kegiatan penjaminan mutu lainnya.

---

## 2.6 Menu Kontak

Halaman kontak resmi institusi menyajikan:

- Alamat lengkap kampus Poltekkes Kemenkes Medan.
- Nomor telepon / WhatsApp resmi.
- Alamat email resmi PPM.
- Jam operasional pelayanan.
- Akun media sosial resmi:
    - Instagram.
    - YouTube.
    - Facebook.
    - Media sosial lainnya.

- Peta lokasi interaktif menggunakan **Google Maps Embed**.

---

# 3. SPESIFIKASI FUNGSIONAL: ADMIN PANEL & CMS (BACKOFFICE)

## 3.1 Manajemen Autentikasi & Role Pengguna

Sistem memiliki **2 tingkat hak akses (role)**.

### 1. Super Admin

Memiliki akses penuh terhadap seluruh fitur dan menu backoffice.

Hak akses meliputi:

- Mengelola seluruh modul CMS.
- Mengelola akun pengguna admin.
- CRUD data user admin.
- Menambah akun admin.
- Mengedit role pengguna.
- Reset password.
- Mengelola konfigurasi identitas website.
- Mengelola kontak institusi.

### 2. Admin Operator Mutu

Memiliki akses untuk mengelola konten operasional, meliputi:

- Banner Slider.
- Sambutan / Profil.
- Layanan.
- Link Terkait.
- Dokumen & SOP.
- Galeri.

Admin Operator Mutu **tidak memiliki izin untuk mengelola akun pengguna lain**.

---

## 3.2 Modul-Modul Backoffice (CMS)

### Dashboard Admin

Menampilkan ringkasan metrik statistik, seperti:

- Total dokumen & SOP.
- Total foto galeri.
- Total banner aktif.
- Informasi statistik konten lainnya yang relevan.

---

### Kelola Hero Banner / Slider

Menyediakan form CRUD dengan field:

- Upload gambar banner.
- Judul.
- Deskripsi / subjudul.
- Link CTA.
- Urutan / `order`.
- Toggle status:
    - Aktif.
    - Nonaktif.

---

### Kelola Sambutan Kepala PPM

Form untuk mengubah:

- Foto pimpinan.
- Nama dan gelar.
- Jabatan.
- Teks sambutan menggunakan rich-text editor.

---

### Kelola Layanan Kami

CRUD kartu layanan dengan field:

- Ikon / gambar layanan.
- Nama layanan.
- Deskripsi singkat.
- Status tayang.

---

### Kelola Link Terkait

CRUD daftar link eksternal dengan field:

- Nama institusi / aplikasi.
- Upload logo.
- URL tautan tujuan.

---

### Kelola Profil (Struktur Organisasi & Tupoksi)

#### Struktur Organisasi

- Upload gambar bagan Struktur Organisasi.
- Format yang diperbolehkan:
    - JPG
    - PNG
    - WebP

#### Tugas & Fungsi

- Form teks editor menggunakan WYSIWYG.
- Digunakan untuk memperbarui rincian Tugas & Fungsi.

---

### Kelola Dokumen & SOP

> **Modul Kritis**

#### CRUD Kategori Dokumen

Kategori awal:

- Kebijakan.
- Manual.
- Standar.
- SOP.
- Formulir.

#### CRUD Berkas Dokumen

Field yang harus tersedia:

- Kode Dokumen.
- Nama Dokumen.
- Kategori dokumen.
- Tahun Terbit.
- Upload file PDF lampiran.

#### Validasi File

- File wajib berformat **PDF**.
- Ukuran maksimal **5 MB**.
- Nama file harus disanitasi sebelum disimpan.

---

### Kelola Galeri

CRUD foto galeri dengan field:

- Upload gambar.
- Judul foto / kegiatan.
- Tanggal pelaksanaan.
- Deskripsi singkat.

---

### Kelola Data Kontak & Footer

Form pengaturan:

- Alamat institusi.
- Jam operasional.
- Email.
- Nomor telepon.
- Link media sosial.
- Kode iframe Google Maps Embed.

---

# 4. KEBUTUHAN NON-FUNGSIONAL & SPESIFIKASI TEKNIS

## 4.1 Framework Backend

- **Laravel 13**
- **PHP 8.3+**

---

## 4.2 Basis Data

Menggunakan:

- **MySQL 8.0+**, atau
- **MariaDB**

Relasi database menggunakan **Eloquent ORM** Laravel.

---

## 4.3 Penyimpanan File

Menggunakan Laravel Filesystem dengan:

```text
public disk
```

File publik diakses melalui konfigurasi:

```bash
php artisan storage:link
```

---

## 4.4 Keamanan Web

Sistem wajib menerapkan:

### Proteksi CSRF

Seluruh form POST / PUT / PATCH / DELETE harus menggunakan:

```blade
@csrf
```

### Validasi Form

Menggunakan **Laravel Form Request Validation** atau mekanisme validasi Laravel yang sesuai.

### Proteksi SQL Injection

Menggunakan:

- Eloquent ORM.
- Parameterized queries.

### Proteksi XSS

Konten HTML yang berasal dari input administrator harus disanitasi / ditampilkan secara aman untuk mencegah Cross-Site Scripting (XSS).

### Proteksi Route Admin

Route backoffice harus dilindungi menggunakan:

- Middleware `auth`.
- Middleware role check.

---

## 4.5 Tampilan Antarmuka

Antarmuka harus:

- Bersih.
- Modern.
- Representatif untuk institusi perguruan tinggi kesehatan.
- Mudah digunakan.
- Sepenuhnya responsif pada:
    - Desktop.
    - Tablet.
    - Smartphone.

Teknologi frontend utama:

- **Blade**
- **Tailwind CSS**

---

# 5. TEKNOLOGI YANG DIGUNAKAN

| Komponen             | Teknologi                        |
| -------------------- | -------------------------------- |
| Backend Framework    | Laravel 13                       |
| Programming Language | PHP 8.3+                         |
| Database             | MySQL 8.0+ / MariaDB             |
| ORM                  | Laravel Eloquent ORM             |
| Frontend Template    | Blade                            |
| CSS Framework        | Tailwind CSS                     |
| Authentication       | Laravel Authentication           |
| File Storage         | Laravel Filesystem / Public Disk |
| Document Format      | PDF                              |
| Map                  | Google Maps Embed                |

---

# 6. REFERENSI WEBSITE

Website referensi:

https://mutu.poltekkes-kaltim.ac.id/index.php

Website tersebut dapat digunakan sebagai referensi dalam memahami struktur konten, penyajian informasi, dan kebutuhan umum portal **Pusat Penjaminan Mutu**.

---

# 7. OUTPUT YANG DIHARAPKAN

Pelamar diharapkan menghasilkan:

1. **Website frontend publik** yang responsif dan sesuai spesifikasi.
2. **Admin Panel / CMS** untuk mengelola seluruh konten.
3. **Role-Based Access Control** dengan role:
    - Super Admin.
    - Admin Operator Mutu.

4. **Database migration**.
5. **Seeder data awal**.
6. **Validasi dan keamanan aplikasi** sesuai spesifikasi.
7. **README.md** yang berisi:
    - Requirement sistem.
    - Installation guide.
    - Konfigurasi environment.
    - Database setup.
    - Storage setup.
    - Seeder.
    - Cara menjalankan aplikasi.
    - Informasi akun admin awal apabila diperlukan.

---

# 8. KRITERIA UMUM IMPLEMENTASI

Implementasi diharapkan memperhatikan:

- Struktur kode yang rapi dan maintainable.
- Penggunaan prinsip Laravel yang sesuai.
- Pemisahan logic antara controller, model, request validation, dan view.
- Penggunaan relasi database yang tepat.
- Reusable component pada frontend.
- Responsive design.
- Validasi input dan keamanan aplikasi.
- Kemudahan pengembangan fitur di kemudian hari.
- Pengalaman pengguna yang baik baik pada frontend maupun backoffice.
