<?php

namespace App\Services;

use App\Helpers\SecurityHelper;
use App\Models\OrganizationProfile;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProfileService
{
    /**
     * Get or create the single organization profile record.
     */
    public function getProfile(): OrganizationProfile
    {
        return OrganizationProfile::firstOrCreate(
            ['id' => 1],
            [
                'org_chart_path' => null,
                'duties_content' => '<p><strong>Tugas Pokok:</strong> Menyelenggarakan dan mengoordinasikan sistem penjaminan mutu internal (SPMI) di lingkungan Poltekkes Kemenkes Medan.</p>',
            ]
        );
    }

    /**
     * Update the organization profile and org chart image.
     */
    public function update(OrganizationProfile $profile, array $data, ?UploadedFile $orgChart = null): OrganizationProfile
    {
        if ($orgChart) {
            if ($profile->org_chart_path && Storage::disk('public')->exists($profile->org_chart_path)) {
                Storage::disk('public')->delete($profile->org_chart_path);
            }
            $data['org_chart_path'] = $orgChart->store('profile', 'public');
        }

        if (isset($data['duties_content'])) {
            $data['duties_content'] = SecurityHelper::cleanHtml($data['duties_content']);
        }

        $profile->update($data);

        return $profile;
    }
}
