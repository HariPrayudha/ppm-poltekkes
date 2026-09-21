<?php

namespace App\Services;

use App\Helpers\SecurityHelper;
use App\Models\Greeting;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class GreetingService
{
    /**
     * Get or create the single greeting record.
     */
    public function getGreeting(): Greeting
    {
        return Greeting::firstOrCreate(
            ['id' => 1],
            [
                'name' => 'Dr. Hj. Siti Aminah, M.Kes',
                'position' => 'Kepala Pusat Penjaminan Mutu Poltekkes Kemenkes Medan',
                'content' => '<p>Selamat datang di laman resmi Pusat Penjaminan Mutu (PPM) Poltekkes Kemenkes Medan.</p>',
            ]
        );
    }

    /**
     * Update the greeting record and photo if uploaded.
     */
    public function update(Greeting $greeting, array $data, ?UploadedFile $photo = null): Greeting
    {
        if ($photo) {
            if ($greeting->photo_path && Storage::disk('public')->exists($greeting->photo_path)) {
                Storage::disk('public')->delete($greeting->photo_path);
            }
            $data['photo_path'] = $photo->store('greetings', 'public');
        }

        if (isset($data['content'])) {
            $data['content'] = SecurityHelper::cleanHtml($data['content']);
        }

        $greeting->update($data);

        return $greeting;
    }
}
