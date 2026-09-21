<?php

namespace App\Services;

use App\Models\Banner;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class BannerService
{
    /**
     * Get paginated banners ordered by latest uploaded.
     */
    public function getAllPaginated(int $perPage = 10): LengthAwarePaginator
    {
        return Banner::latest('id')->paginate($perPage);
    }

    /**
     * Create a new hero banner.
     */
    public function create(array $data, ?UploadedFile $image = null): Banner
    {
        if ($image) {
            $data['image_path'] = $image->store('banners', 'public');
        }

        $data['is_active'] = isset($data['is_active']) ? (bool) $data['is_active'] : false;

        return Banner::create($data);
    }

    /**
     * Update an existing hero banner.
     */
    public function update(Banner $banner, array $data, ?UploadedFile $image = null): Banner
    {
        if ($image) {
            if ($banner->image_path && Storage::disk('public')->exists($banner->image_path)) {
                Storage::disk('public')->delete($banner->image_path);
            }
            $data['image_path'] = $image->store('banners', 'public');
        }

        $data['is_active'] = isset($data['is_active']) ? (bool) $data['is_active'] : false;

        $banner->update($data);

        return $banner;
    }

    /**
     * Delete a hero banner and its image.
     */
    public function delete(Banner $banner): bool
    {
        if ($banner->image_path && Storage::disk('public')->exists($banner->image_path)) {
            Storage::disk('public')->delete($banner->image_path);
        }

        return (bool) $banner->delete();
    }

    /**
     * Toggle banner active status.
     */
    public function toggleActive(Banner $banner): Banner
    {
        $banner->update(['is_active' => ! $banner->is_active]);

        return $banner;
    }
}
