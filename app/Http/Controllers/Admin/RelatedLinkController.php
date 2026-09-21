<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RelatedLinkRequest;
use App\Models\RelatedLink;
use App\Services\RelatedLinkService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RelatedLinkController extends Controller
{
    public function __construct(
        protected RelatedLinkService $relatedLinkService
    ) {}

    /**
     * Display a listing of related links.
     */
    public function index(): View
    {
        $links = $this->relatedLinkService->getAllPaginated(10);

        return view('admin.related-links.index', compact('links'));
    }

    /**
     * Store a newly created related link.
     */
    public function store(RelatedLinkRequest $request): RedirectResponse
    {
        $this->relatedLinkService->create(
            $request->validated(),
            $request->file('logo')
        );

        return redirect()->route('admin.related-links.index')
            ->with('success', 'Link terkait berhasil ditambahkan.');
    }

    /**
     * Update the specified related link.
     */
    public function update(RelatedLinkRequest $request, RelatedLink $relatedLink): RedirectResponse
    {
        $this->relatedLinkService->update(
            $relatedLink,
            $request->validated(),
            $request->file('logo')
        );

        return redirect()->route('admin.related-links.index')
            ->with('success', 'Link terkait berhasil diperbarui.');
    }

    /**
     * Remove the specified related link.
     */
    public function destroy(RelatedLink $relatedLink): RedirectResponse
    {
        $this->relatedLinkService->delete($relatedLink);

        return redirect()->route('admin.related-links.index')
            ->with('success', 'Link terkait berhasil dihapus.');
    }
}
