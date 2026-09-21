<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GalleryRequest;
use App\Models\Gallery;
use App\Services\GalleryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function __construct(
        protected GalleryService $galleryService
    ) {}

    /**
     * Display gallery items grid.
     */
    public function index(): View
    {
        $galleries = $this->galleryService->getAllPaginated(12);

        return view('admin.gallery.index', compact('galleries'));
    }

    /**
     * Store a newly created gallery photo.
     */
    public function store(GalleryRequest $request): RedirectResponse
    {
        $this->galleryService->create(
            $request->validated(),
            $request->file('image')
        );

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Foto kegiatan berhasil ditambahkan ke galeri.');
    }

    /**
     * Update the specified gallery photo.
     */
    public function update(GalleryRequest $request, Gallery $gallery): RedirectResponse
    {
        $this->galleryService->update(
            $gallery,
            $request->validated(),
            $request->file('image')
        );

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Data galeri berhasil diperbarui.');
    }

    /**
     * Remove the specified gallery photo.
     */
    public function destroy(Gallery $gallery): RedirectResponse
    {
        $this->galleryService->delete($gallery);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Foto kegiatan berhasil dihapus.');
    }
}
