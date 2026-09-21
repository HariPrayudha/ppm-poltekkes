<?php

namespace Database\Seeders;

use App\Models\OrganizationProfile;
use Illuminate\Database\Seeder;

class OrganizationProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OrganizationProfile::firstOrCreate(
            ['id' => 1],
            [
                'org_chart_path' => null,
                'duties_content' => '<p><strong>Tugas Pokok:</strong> Menyelenggarakan dan mengoordinasikan sistem penjaminan mutu internal (SPMI) di lingkungan Poltekkes Kemenkes Medan.</p><p><strong>Fungsi:</strong> Perencanaan standar mutu, pelaksanaan monitoring dan evaluasi, pelaksanaan audit mutu internal (AMI), serta penyusunan rekomendasi peningkatan mutu berkelanjutan.</p>',
            ]
        );
    }
}
