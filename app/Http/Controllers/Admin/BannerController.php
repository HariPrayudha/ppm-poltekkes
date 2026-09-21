<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BannerRequest;
use App\Models\Banner;
use App\Services\BannerService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BannerController extends Controller
{
    public function __construct(
        protected BannerService $bannerService
    ) {}

    /**
     * Display a listing of the hero banners.
     */
    public function index(): View
    {
        $banners = $this->bannerService->getAllPaginated(10);

        return view('admin.banners.index', compact('banners'));
    }

    /**
     * Store a newly created banner.
     */
    public function store(BannerRequest $request): RedirectResponse
    {
        $this->bannerService->create(
            $request->validated(),
            $request->file('image')
        );

        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner berhasil ditambahkan.');
    }

    /**
     * Update the specified banner.
     */
    public function update(BannerRequest $request, Banner $banner): RedirectResponse
    {
        $this->bannerService->update(
            $banner,
            $request->validated(),
            $request->file('image')
        );

        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner berhasil diperbarui.');
    }

    /**
     * Remove the specified banner.
     */
    public function destroy(Banner $banner): RedirectResponse
    {
        $this->bannerService->delete($banner);

        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner berhasil dihapus.');
    }

    /**
     * Toggle banner active status.
     */
    public function toggle(Banner $banner): RedirectResponse
    {
        $updated = $this->bannerService->toggleActive($banner);
        $statusText = $updated->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()->route('admin.banners.index')
            ->with('info', "Status banner berhasil {$statusText}.");
    }
}
