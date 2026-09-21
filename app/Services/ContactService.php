<?php

namespace App\Services;

use App\Helpers\SecurityHelper;
use App\Models\Contact;

class ContactService
{
    /**
     * Get or create the single contact record.
     */
    public function getContact(): Contact
    {
        return Contact::firstOrCreate(
            ['id' => 1],
            [
                'address' => 'Jl. Jamin Ginting KM. 13.5, Kel. Lau Cih, Kec. Medan Tuntungan, Kota Medan, Sumatera Utara 20137',
                'operating_hours' => 'Senin - Jumat: 08.00 - 16.00 WIB',
                'email' => 'ppm@poltekkes-medan.ac.id',
                'phone' => '(061) 8368633',
                'instagram_url' => 'https://instagram.com/poltekkesmedan',
                'youtube_url' => 'https://youtube.com/@poltekkeskemenkesmedanofficial',
                'facebook_url' => 'https://facebook.com/poltekkesmedan',
                'maps_embed' => null,
            ]
        );
    }

    /**
     * Update the contact information.
     */
    public function update(Contact $contact, array $data): Contact
    {
        if (isset($data['maps_embed'])) {
            $data['maps_embed'] = SecurityHelper::cleanMapEmbed($data['maps_embed']);
        }

        $contact->update($data);

        return $contact;
    }
}
