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
        Greeting::firstOrCreate(
            ['id' => 1],
            [
                'photo_path' => null,
                'name' => 'Dr. Hj. Siti Aminah, M.Kes',
                'position' => 'Kepala Pusat Penjaminan Mutu Poltekkes Kemenkes Medan',
                'content' => '<p>Selamat datang di laman resmi Pusat Penjaminan Mutu (PPM) Poltekkes Kemenkes Medan. Kami berkomitmen untuk terus meningkatkan mutu pendidikan vokasi kesehatan secara berkelanjutan (continuous quality improvement) sesuai standar SPMI dan standar nasional pendidikan tinggi kesehatan.</p>',
            ]
        );
    }
}
