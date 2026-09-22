<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\DocumentCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DocumentController extends Controller
{
    /**
     * Display the public document repository.
     */
    public function index(Request $request): View
    {
        $query = Document::with('category');

        if ($request->filled('category_id')) {
            $query->where('document_category_id', $request->category_id);
        }

        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%");
            });
        }

        $documents = $query->latest()->paginate(10)->withQueryString();

        if ($request->ajax()) {
            return view('frontend.documents._table', compact('documents'));
        }

        $categories = DocumentCategory::withCount('documents')->get();
        $years = Document::select('year')
            ->distinct()
            ->whereNotNull('year')
            ->orderByDesc('year')
            ->pluck('year');

        return view('frontend.documents.index', compact('documents', 'categories', 'years'));
    }

    /**
     * Stream document file for inline preview with anti-IDM protection.
     */
    public function preview(Document $document): BinaryFileResponse
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
     * Download the document file.
     */
    public function download(Document $document): BinaryFileResponse
    {
        if (! $document->file_path || ! Storage::disk('public')->exists($document->file_path)) {
            abort(404, 'Berkas dokumen tidak ditemukan.');
        }

        $fullPath = Storage::disk('public')->path($document->file_path);
        $fileName = preg_replace('/[^a-zA-Z0-9_\-\.]/', '_', $document->name).'.pdf';

        return response()->download($fullPath, $fileName);
    }
}
