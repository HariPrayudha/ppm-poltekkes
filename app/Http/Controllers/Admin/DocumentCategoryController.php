<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DocumentCategoryRequest;
use App\Models\DocumentCategory;
use App\Services\DocumentCategoryService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DocumentCategoryController extends Controller
{
    public function __construct(
        protected DocumentCategoryService $categoryService
    ) {}

    /**
     * Display category listing.
     */
    public function index(): View
    {
        $categories = $this->categoryService->getAllPaginated(10);

        return view('admin.documents.categories', compact('categories'));
    }

    /**
     * Store a newly created category.
     */
    public function store(DocumentCategoryRequest $request): RedirectResponse
    {
        $this->categoryService->create($request->validated());

        return redirect()->route('admin.document-categories.index')
            ->with('success', 'Kategori dokumen berhasil ditambahkan.');
    }

    /**
     * Update the specified category.
     */
    public function update(DocumentCategoryRequest $request, DocumentCategory $documentCategory): RedirectResponse
    {
        $this->categoryService->update($documentCategory, $request->validated());

        return redirect()->route('admin.document-categories.index')
            ->with('success', 'Kategori dokumen berhasil diperbarui.');
    }

    /**
     * Remove the specified category.
     */
    public function destroy(DocumentCategory $documentCategory): RedirectResponse
    {
        try {
            $this->categoryService->delete($documentCategory);

            return redirect()->route('admin.document-categories.index')
                ->with('success', 'Kategori dokumen berhasil dihapus.');
        } catch (Exception $e) {
            return redirect()->route('admin.document-categories.index')
                ->with('error', $e->getMessage());
        }
    }
}
