<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'Audit Mutu Internal',
                'description' => 'Melaksanakan audit mutu internal secara berkala untuk memastikan kepatuhan terhadap standar mutu.',
                'icon_path' => null,
                'is_active' => true,
            ],
            [
                'name' => 'Standar & SOP',
                'description' => 'Menyusun dan mengelola dokumen standar mutu serta Standar Operasional Prosedur (SOP).',
                'icon_path' => null,
                'is_active' => true,
            ],
            [
                'name' => 'Monitoring & Evaluasi',
                'description' => 'Melakukan monitoring dan evaluasi terhadap pelaksanaan standar mutu di seluruh unit kerja.',
                'icon_path' => null,
                'is_active' => true,
            ],
            [
                'name' => 'Akreditasi',
                'description' => 'Mengkoordinasikan persiapan dan pelaksanaan akreditasi institusi maupun program studi.',
                'icon_path' => null,
                'is_active' => true,
            ],
            [
                'name' => 'Pelatihan Mutu',
                'description' => 'Menyelenggarakan pelatihan dan sosialisasi terkait sistem penjaminan mutu.',
                'icon_path' => null,
                'is_active' => true,
            ],
            [
                'name' => 'Database Mutu',
                'description' => 'Mengelola database dan sistem informasi penjaminan mutu.',
                'icon_path' => null,
                'is_active' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(
                ['name' => $service['name']],
                $service
            );
        }
    }
}
