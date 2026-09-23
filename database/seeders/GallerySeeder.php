<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $galleryItems = [
            [
                'title' => 'Rapat Tinjauan Manajemen (RTM) Penjaminan Mutu Tahunan',
                'event_date' => '2025-01-15',
                'description' => 'Evaluasi menyeluruh terhadap hasil temuan Audit Mutu Internal bersama jajaran pimpinan direktorat Poltekkes Medan.',
                'image_path' => 'gallery/PFMJndFoFO21HdzGDiWFTJuECMcyeZaKTvWYrIl8.png',
            ],
            [
                'title' => 'Pelaksanaan Audit Mutu Internal (AMI) Semester Ganjil',
                'event_date' => '2024-11-20',
                'description' => 'Kegiatan visitasi auditor internal ke Jurusan Keperawatan dan Kebidanan guna memastikan ketercapaian standar pembelajaran.',
                'image_path' => 'gallery/IQ6BQIlwOayn1dZGtlX59dZSDE5gF3OzJP6bej5Y.png',
            ],
            [
                'title' => 'Workshop Pemutakhiran Dokumen Standar SPMI Berbasis Permendikbudristek 53/2023',
                'event_date' => '2024-09-12',
                'description' => 'Penguatan pemahaman tim penyusun standar mutu dalam merespons regulasi nasional pendidikan tinggi terbaru.',
                'image_path' => 'gallery/H7DgWbR2I23AqdeI1CC4pxXKkPzm7YGorxUtd9tq.png',
            ],
            [
                'title' => 'Sosialisasi Instrumen Akreditasi LAM-PTKes bagi Pengelola Program Studi',
                'event_date' => '2024-08-05',
                'description' => 'Pendampingan intensif bagi ketua jurusan dan sekretaris prodi dalam persiapan borang akreditasi unggul.',
                'image_path' => 'gallery/QvLVfB58itRAq4WFHDFtgKU1Yrf0ffojS2YrASUT.png',
            ],
            [
                'title' => 'Pelatihan dan Sertifikasi Auditor Mutu Internal Bersertifikat',
                'event_date' => '2024-06-18',
                'description' => 'Peningkatan kapasitas dan kompetensi dosen pengampu auditor mutu di lingkungan Poltekkes Kemenkes Medan.',
                'image_path' => 'gallery/L3BeZBEn5nZ3CFA6NYDdXZKuyoGjzdYZev0sR4Ak.png',
            ],
            [
                'title' => 'Benchmarking Sistem Tata Kelola Mutu ke Poltekkes Mitra',
                'event_date' => '2024-04-10',
                'description' => 'Studi komparatif implementasi sistem informasi penjaminan mutu dan manajemen risiko institusi kesehatan.',
                'image_path' => 'gallery/xgSRtusHd7zqOMp0jLqZfcvyNyMBQ2KC192gxhP6.png',
            ],
        ];

        foreach ($galleryItems as $item) {
            Gallery::updateOrCreate(
                ['title' => $item['title']],
                $item
            );
        }
    }
}
