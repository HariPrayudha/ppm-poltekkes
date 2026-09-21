<?php

namespace App\Services;

use App\Models\Document;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DocumentService
{
    /**
     * Get paginated documents with filtering and search.
     */
    public function getAllPaginated(?int $categoryId = null, ?string $search = null, ?int $year = null, int $perPage = 10): LengthAwarePaginator
    {
        return Document::with('category')
            ->when($categoryId, fn ($query) => $query->where('document_category_id', $categoryId))
            ->when($year, fn ($query) => $query->where('year', $year))
            ->when($search, function ($query, $term) {
                $query->where(function ($q) use ($term) {
                    $q->where('name', 'like', "%{$term}%")
                        ->orWhere('code', 'like', "%{$term}%");
                });
            })
            ->latest('id')
            ->paginate($perPage)
            ->withQueryString();
    }

    /**
     * Get list of unique publication years.
     *
     * @return array<int>
     */
    public function getAvailableYears(): array
    {
        return Document::select('year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->toArray();
    }

    /**
     * Create a new document with sanitized filename.
     */
    public function create(array $data, UploadedFile $file): Document
    {
        $sanitizedName = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $extension = $file->getClientOriginalExtension();
        $finalFilename = time().'_'.$sanitizedName.'.'.$extension;

        $path = $file->storeAs('documents', $finalFilename, 'public');

        $data['file_path'] = $path;
        $data['file_size'] = $file->getSize();

        return Document::create($data);
    }

    /**
     * Update an existing document and file if provided.
     */
    public function update(Document $document, array $data, ?UploadedFile $file = null): Document
    {
        if ($file) {
            if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
                Storage::disk('public')->delete($document->file_path);
            }

            $sanitizedName = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
            $extension = $file->getClientOriginalExtension();
            $finalFilename = time().'_'.$sanitizedName.'.'.$extension;

            $path = $file->storeAs('documents', $finalFilename, 'public');

            $data['file_path'] = $path;
            $data['file_size'] = $file->getSize();
        }

        $document->update($data);

        return $document;
    }

    /**
     * Delete a document (soft delete).
     */
    public function delete(Document $document): bool
    {
        return (bool) $document->delete();
    }
}
