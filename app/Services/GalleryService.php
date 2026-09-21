<?php

namespace App\Services;

use App\Models\Gallery;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class GalleryService
{
    /**
     * Get paginated gallery items ordered by event_date desc.
     */
    public function getAllPaginated(int $perPage = 12): LengthAwarePaginator
    {
        return Gallery::orderBy('event_date', 'desc')
            ->latest('id')
            ->paginate($perPage);
    }

    /**
     * Create a new gallery photo item.
     */
    public function create(array $data, UploadedFile $image): Gallery
    {
        $data['image_path'] = $image->store('gallery', 'public');

        return Gallery::create($data);
    }

    /**
     * Update an existing gallery item.
     */
    public function update(Gallery $gallery, array $data, ?UploadedFile $image = null): Gallery
    {
        if ($image) {
            if ($gallery->image_path && Storage::disk('public')->exists($gallery->image_path)) {
                Storage::disk('public')->delete($gallery->image_path);
            }
            $data['image_path'] = $image->store('gallery', 'public');
        }

        $gallery->update($data);

        return $gallery;
    }

    /**
     * Delete a gallery item.
     */
    public function delete(Gallery $gallery): bool
    {
        if ($gallery->image_path && Storage::disk('public')->exists($gallery->image_path)) {
            Storage::disk('public')->delete($gallery->image_path);
        }

        return (bool) $gallery->delete();
    }
}
