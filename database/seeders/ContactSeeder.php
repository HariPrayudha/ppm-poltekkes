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
        Contact::updateOrCreate(
            ['id' => 1],
            [
                'address' => 'Jl. Jamin Ginting KM 13,5, Kel. Lau Cih, Kec. Medan Tuntungan, Kota Medan, Sumatera Utara 20137',
                'operating_hours' => 'Senin - Kamis: 07.30 - 16.00 WIB | Jumat: 07.30 - 16.30 WIB',
                'email' => 'info@poltekkes-medan.ac.id',
                'phone' => '+62 811-6238-633',
                'instagram_url' => 'https://instagram.com/poltekkesmedan',
                'youtube_url' => 'https://youtube.com/@poltekkeskemenkesmedanofficial',
                'facebook_url' => 'https://facebook.com/poltekkesmedan',
                'maps_embed' => 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d31858.56293876502!2d98.6139837!3d3.5131805!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30312452458d243f%3A0xf9ebdd1dbf4f271a!2sPoltekkes%20Medan!5e0!3m2!1sid!2sid!4v1790091254878!5m2!1sid!2sid',
            ]
        );
    }
}
