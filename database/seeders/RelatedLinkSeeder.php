<?php

namespace Database\Seeders;

use App\Models\RelatedLink;
use Illuminate\Database\Seeder;

class RelatedLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $links = [
            [
                'name' => 'SIOPSET',
                'url' => 'https://poltekkes-medan.ac.id/siopset',
                'logo_path' => null,
            ],
            [
                'name' => 'LABIRIN',
                'url' => 'https://poltekkes-medan.ac.id/labirin',
                'logo_path' => null,
            ],
            [
                'name' => 'TELADAN',
                'url' => 'https://poltekkes-medan.ac.id/teladan',
                'logo_path' => null,
            ],
            [
                'name' => 'KEPK',
                'url' => 'https://poltekkes-medan.ac.id/kepk',
                'logo_path' => null,
            ],
            [
                'name' => 'LINGUA',
                'url' => 'https://poltekkes-medan.ac.id/lingua',
                'logo_path' => null,
            ],
            [
                'name' => 'SIGMA BLU',
                'url' => 'https://poltekkes-medan.ac.id/sigma-blu',
                'logo_path' => null,
            ],
            [
                'name' => 'SIPPM',
                'url' => 'https://poltekkes-medan.ac.id/sippm',
                'logo_path' => null,
            ],
            [
                'name' => 'UPK',
                'url' => 'https://poltekkes-medan.ac.id/upk',
                'logo_path' => null,
            ],
            [
                'name' => 'SIGMED',
                'url' => 'https://poltekkes-medan.ac.id/sigmed',
                'logo_path' => null,
            ],
            [
                'name' => 'SIPADU',
                'url' => 'https://poltekkes-medan.ac.id/sipadu',
                'logo_path' => null,
            ],
        ];

        foreach ($links as $link) {
            RelatedLink::updateOrCreate(
                ['name' => $link['name']],
                $link
            );
        }
    }
}
