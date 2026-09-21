<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Contact::firstOrCreate(
            ['id' => 1],
            [
                'address' => 'Jl. Jamin Ginting KM. 13.5, Kel. Lau Cih, Kec. Medan Tuntungan, Kota Medan, Sumatera Utara 20137',
                'operating_hours' => 'Senin - Jumat: 08.00 - 16.00 WIB',
                'email' => 'ppm@poltekkes-medan.ac.id',
                'phone' => '(061) 8368633',
                'instagram_url' => 'https://instagram.com/poltekkesmedan',
                'youtube_url' => 'https://youtube.com/@poltekkeskemenkesmedanofficial',
                'facebook_url' => 'https://facebook.com/poltekkesmedan',
                'maps_embed' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3982.433605212354!2d98.6015569!3d3.486241!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30312527b14d805f%3A0x1bb1f2cf19cf5f76!2sPoliteknik%20Kesehatan%20Kemenkes%20Medan!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
            ]
        );
    }
}
