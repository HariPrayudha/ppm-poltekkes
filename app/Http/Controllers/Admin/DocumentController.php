<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DocumentRequest;
use App\Models\Document;
use App\Services\DocumentCategoryService;
use App\Services\DocumentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DocumentController extends Controller
{
    public function __construct(
        protected DocumentService $documentService,
        protected DocumentCategoryService $categoryService
    ) {}

    /**
     * Display a listing of documents.
     */
    public function index(Request $request): View
    {
        $categoryId = $request->filled('category_id') ? (int) $request->input('category_id') : null;
        $search = $request->filled('search') ? trim($request->input('search')) : null;
        $year = $request->filled('year') ? (int) $request->input('year') : null;

        $documents = $this->documentService->getAllPaginated($categoryId, $search, $year, 10);
        $categories = $this->categoryService->getAll();
        $availableYears = $this->documentService->getAvailableYears();

        return view('admin.documents.index', compact('documents', 'categories', 'availableYears', 'categoryId', 'search', 'year'));
    }

    /**
     * Store a newly created document.
     */
    public function store(DocumentRequest $request): RedirectResponse
    {
        $this->documentService->create(
            $request->validated(),
            $request->file('file')
        );

        return redirect()->route('admin.documents.index')
            ->with('success', 'Dokumen mutu berhasil diunggah.');
    }

    /**
     * Update the specified document.
     */
    public function update(DocumentRequest $request, Document $document): RedirectResponse
    {
        $this->documentService->update(
            $document,
            $request->validated(),
            $request->file('file')
        );

        return redirect()->route('admin.documents.index')
            ->with('success', 'Dokumen mutu berhasil diperbarui.');
    }

    /**
     * Remove the specified document.
     */
    public function destroy(Document $document): RedirectResponse
    {
        $this->documentService->delete($document);

        return redirect()->route('admin.documents.index')
            ->with('success', 'Dokumen mutu berhasil dihapus.');
    }
}
