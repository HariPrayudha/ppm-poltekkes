<?php

namespace Database\Seeders;

use App\Models\Greeting;
use Illuminate\Database\Seeder;

class GreetingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Greeting::updateOrCreate(
            ['id' => 1],
            [
                'photo_path' => null,
                'name' => 'Dr. Dra. Ida Nurhayati, M.Kes.',
                'position' => 'Kepala Pusat Penjaminan Mutu Poltekkes Kemenkes Medan',
                'content' => '<p>Selamat datang di portal resmi Pusat Penjaminan Mutu (PPM) Poltekkes Kemenkes Medan. Pusat Penjaminan Mutu memegang mandat strategis dalam mengawal mutu akademik dan tata kelola institusi secara berkelanjutan (Continuous Quality Improvement) demi melahirkan tenaga kesehatan yang profesional, unggul, dan berintegritas.</p><p>Melalui implementasi siklus PPEPP (Penetapan, Pelaksanaan, Evaluasi, Pengendalian, dan Peningkatan), kami memastikan seluruh program studi di lingkungan Poltekkes Kemenkes Medan senantiasa memenuhi bahkan melampaui Standar Nasional Pendidikan Tinggi (SN-Dikti) dan kriteria akreditasi LAM-PTKes menuju predikat Unggul.</p><p>Portal ini kami sediakan sebagai pusat keterbukaan informasi dan repositori resmi Sistem Penjaminan Mutu Internal (SPMI), dokumen SOP, instrumen Audit Mutu Internal (AMI), serta laporan penjaminan mutu bagi seluruh sivitas akademika dan masyarakat.</p>',
            ]
        );
    }
}
