<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServiceRequest;
use App\Models\Service;
use App\Services\ServiceService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function __construct(
        protected ServiceService $serviceService
    ) {}

    /**
     * Display a listing of services.
     */
    public function index(): View
    {
        $services = $this->serviceService->getAllPaginated(10);

        return view('admin.services.index', compact('services'));
    }

    /**
     * Store a newly created service.
     */
    public function store(ServiceRequest $request): RedirectResponse
    {
        $this->serviceService->create(
            $request->validated(),
            $request->file('icon')
        );

        return redirect()->route('admin.services.index')
            ->with('success', 'Layanan mutu berhasil ditambahkan.');
    }

    /**
     * Update the specified service.
     */
    public function update(ServiceRequest $request, Service $service): RedirectResponse
    {
        $this->serviceService->update(
            $service,
            $request->validated(),
            $request->file('icon')
        );

        return redirect()->route('admin.services.index')
            ->with('success', 'Layanan mutu berhasil diperbarui.');
    }

    /**
     * Remove the specified service.
     */
    public function destroy(Service $service): RedirectResponse
    {
        $this->serviceService->delete($service);

        return redirect()->route('admin.services.index')
            ->with('success', 'Layanan mutu berhasil dihapus.');
    }

    /**
     * Toggle service active status.
     */
    public function toggle(Service $service): RedirectResponse
    {
        $updated = $this->serviceService->toggleActive($service);
        $statusText = $updated->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()->route('admin.services.index')
            ->with('info', "Status layanan berhasil {$statusText}.");
    }
}
