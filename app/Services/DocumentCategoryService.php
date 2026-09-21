<?php

namespace App\Services;

use App\Models\DocumentCategory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class DocumentCategoryService
{
    /**
     * Get all categories ordered by name ascending.
     */
    public function getAll(): Collection
    {
        return DocumentCategory::withCount('documents')
            ->orderBy('name', 'asc')
            ->get();
    }

    /**
     * Get paginated categories with document counts.
     */
    public function getAllPaginated(int $perPage = 10): LengthAwarePaginator
    {
        return DocumentCategory::withCount('documents')
            ->orderBy('name', 'asc')
            ->paginate($perPage);
    }

    /**
     * Create a category.
     */
    public function create(array $data): DocumentCategory
    {
        return DocumentCategory::create($data);
    }

    /**
     * Update a category.
     */
    public function update(DocumentCategory $category, array $data): DocumentCategory
    {
        $category->update($data);

        return $category;
    }

    /**
     * Delete a category if it has no documents.
     *
     * @throws \Exception
     */
    public function delete(DocumentCategory $category): bool
    {
        if ($category->documents()->exists()) {
            throw new \Exception('Kategori tidak dapat dihapus karena masih memiliki dokumen terkait.');
        }

        return (bool) $category->delete();
    }
}
