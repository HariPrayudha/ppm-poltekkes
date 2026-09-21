<?php

namespace App\Services;

use App\Models\RelatedLink;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class RelatedLinkService
{
    /**
     * Get paginated related links ordered by latest.
     */
    public function getAllPaginated(int $perPage = 10): LengthAwarePaginator
    {
        return RelatedLink::latest('id')->paginate($perPage);
    }

    /**
     * Create a new related link.
     */
    public function create(array $data, ?UploadedFile $logo = null): RelatedLink
    {
        if ($logo) {
            $data['logo_path'] = $logo->store('related-links', 'public');
        }

        return RelatedLink::create($data);
    }

    /**
     * Update an existing related link.
     */
    public function update(RelatedLink $relatedLink, array $data, ?UploadedFile $logo = null): RelatedLink
    {
        if ($logo) {
            if ($relatedLink->logo_path && Storage::disk('public')->exists($relatedLink->logo_path)) {
                Storage::disk('public')->delete($relatedLink->logo_path);
            }
            $data['logo_path'] = $logo->store('related-links', 'public');
        }

        $relatedLink->update($data);

        return $relatedLink;
    }

    /**
     * Delete a related link.
     */
    public function delete(RelatedLink $relatedLink): bool
    {
        if ($relatedLink->logo_path && Storage::disk('public')->exists($relatedLink->logo_path)) {
            Storage::disk('public')->delete($relatedLink->logo_path);
        }

        return (bool) $relatedLink->delete();
    }
}
