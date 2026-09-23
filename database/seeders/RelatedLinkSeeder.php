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
                'url' => 'https://siopset.poltekkes-medan.ac.id',
                'logo_path' => null,
            ],
            [
                'name' => 'LABIRIN',
                'url' => 'https://labirin.poltekkes-medan.ac.id',
                'logo_path' => null,
            ],
            [
                'name' => 'TELADAN',
                'url' => 'https://teladan.poltekkes-medan.ac.id',
                'logo_path' => null,
            ],
            [
                'name' => 'KEPK',
                'url' => 'https://kepk.poltekkes-medan.ac.id',
                'logo_path' => null,
            ],
            [
                'name' => 'LINGUA',
                'url' => 'https://lingua.poltekkes-medan.ac.id',
                'logo_path' => null,
            ],
            [
                'name' => 'SIGMA BLU',
                'url' => 'https://sigma-blu.poltekkes-medan.ac.id',
                'logo_path' => null,
            ],
            [
                'name' => 'SIPPM',
                'url' => 'https://sippm.poltekkes-medan.ac.id',
                'logo_path' => null,
            ],
            [
                'name' => 'UPK',
                'url' => 'https://upk.poltekkes-medan.ac.id',
                'logo_path' => null,
            ],
            [
                'name' => 'SIGMED',
                'url' => 'https://sigmed.poltekkes-medan.ac.id',
                'logo_path' => null,
            ],
            [
                'name' => 'SIPADU',
                'url' => 'https://sipadu.poltekkes-medan.ac.id',
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
