<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banners = [
            [
                'title' => 'Pusat Penjaminan Mutu Poltekkes Kemenkes Medan',
                'description' => 'Mengawal mutu pendidikan vokasi kesehatan yang unggul, berdaya saing, dan berstandar nasional secara berkelanjutan.',
                'cta_label' => 'Lihat Dokumen SPMI',
                'cta_url' => '/dokumen',
                'image_path' => 'banners/cVMWKzToadWlaSaSBzUMQgOwlbIvIcKIP6vX3smU.png',
                'is_active' => true,
            ],
            [
                'title' => 'Pelaksanaan Audit Mutu Internal (AMI) Terintegrasi',
                'description' => 'Evaluasi berkala siklus PPEPP untuk memastikan kepatuhan terhadap standar mutu akademik dan tata kelola unit kerja.',
                'cta_label' => 'Pelajari Tugas & Fungsi',
                'cta_url' => '/profil/tugas-fungsi',
                'image_path' => 'banners/cVMWKzToadWlaSaSBzUMQgOwlbIvIcKIP6vX3smU.png',
                'is_active' => true,
            ],
            [
                'title' => 'Menuju Akreditasi Program Studi Berpredikat Unggul',
                'description' => 'Pendampingan dan penguatan standar akreditasi LAM-PTKes dan BAN-PT pada seluruh jurusan dan program studi.',
                'cta_label' => 'Repositori Dokumen',
                'cta_url' => '/dokumen',
                'image_path' => 'banners/cVMWKzToadWlaSaSBzUMQgOwlbIvIcKIP6vX3smU.png',
                'is_active' => true,
            ],
            [
                'title' => 'Transformasi Mutu Layanan Pendidikan Kesehatan',
                'description' => 'Penguatan tata kelola Badan Layanan Umum (BLU) yang transparan, akuntabel, dan berorientasi pada kepuasan sivitas akademika.',
                'cta_label' => 'Hubungi Kami',
                'cta_url' => '/kontak',
                'image_path' => 'banners/cVMWKzToadWlaSaSBzUMQgOwlbIvIcKIP6vX3smU.png',
                'is_active' => true,
            ],
            [
                'title' => 'Penguatan Budaya Mutu Berkelanjutan',
                'description' => 'Sinergi pimpinan, dosen, tenaga kependidikan, dan mahasiswa demi mencetak tenaga kesehatan profesional dan berintegritas.',
                'cta_label' => 'Struktur Organisasi',
                'cta_url' => '/profil/struktur-organisasi',
                'image_path' => 'banners/cVMWKzToadWlaSaSBzUMQgOwlbIvIcKIP6vX3smU.png',
                'is_active' => true,
            ],
        ];

        foreach ($banners as $banner) {
            Banner::updateOrCreate(
                ['title' => $banner['title']],
                $banner
            );
        }
    }
}
