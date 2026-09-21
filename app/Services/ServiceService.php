<?php

namespace App\Services;

use App\Models\Service;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class ServiceService
{
    /**
     * Get paginated services ordered by latest.
     */
    public function getAllPaginated(int $perPage = 10): LengthAwarePaginator
    {
        return Service::latest('id')->paginate($perPage);
    }

    /**
     * Create a new service.
     */
    public function create(array $data, ?UploadedFile $icon = null): Service
    {
        if ($icon) {
            $data['icon_path'] = $icon->store('services', 'public');
        }

        $data['is_active'] = isset($data['is_active']) ? (bool) $data['is_active'] : false;

        return Service::create($data);
    }

    /**
     * Update an existing service.
     */
    public function update(Service $service, array $data, ?UploadedFile $icon = null): Service
    {
        if ($icon) {
            if ($service->icon_path && Storage::disk('public')->exists($service->icon_path)) {
                Storage::disk('public')->delete($service->icon_path);
            }
            $data['icon_path'] = $icon->store('services', 'public');
        }

        $data['is_active'] = isset($data['is_active']) ? (bool) $data['is_active'] : false;

        $service->update($data);

        return $service;
    }

    /**
     * Delete a service.
     */
    public function delete(Service $service): bool
    {
        if ($service->icon_path && Storage::disk('public')->exists($service->icon_path)) {
            Storage::disk('public')->delete($service->icon_path);
        }

        return (bool) $service->delete();
    }

    /**
     * Toggle service active status.
     */
    public function toggleActive(Service $service): Service
    {
        $service->update(['is_active' => ! $service->is_active]);

        return $service;
    }
}
