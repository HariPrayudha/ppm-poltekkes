<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DocumentRequest;
use App\Models\Document;
use App\Services\DocumentCategoryService;
use App\Services\DocumentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

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

        if ($request->ajax()) {
            return view('admin.documents._table', compact('documents'));
        }

        return view('admin.documents.index', compact('documents', 'categories', 'availableYears', 'categoryId', 'search', 'year'));
    }

    /**
     * Stream the PDF file inline for modal preview without triggering download prompts.
     */
    public function previewFile(Document $document): BinaryFileResponse
    {
        if (! $document->file_path || ! Storage::disk('public')->exists($document->file_path)) {
            abort(404, 'Berkas dokumen tidak ditemukan.');
        }

        $fullPath = Storage::disk('public')->path($document->file_path);

        $contentType = (request()->ajax() || request()->header('X-Preview-Request'))
            ? 'application/octet-stream'
            : 'application/pdf';

        return response()->file($fullPath, [
            'Content-Type' => $contentType,
            'Content-Disposition' => 'inline',
            'Cache-Control' => 'no-cache, private',
            'X-Frame-Options' => 'SAMEORIGIN',
        ]);
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
