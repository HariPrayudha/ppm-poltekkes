<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfileRequest;
use App\Services\ProfileService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function __construct(
        protected ProfileService $profileService
    ) {}

    /**
     * Show the organization profile editor.
     */
    public function index(): View
    {
        $profile = $this->profileService->getProfile();

        return view('admin.profile.index', compact('profile'));
    }

    /**
     * Update the organization profile.
     */
    public function update(ProfileRequest $request): RedirectResponse
    {
        $profile = $this->profileService->getProfile();

        $this->profileService->update(
            $profile,
            $request->validated(),
            $request->file('org_chart')
        );

        return redirect()->route('admin.profile.index')
            ->with('success', 'Profil dan struktur organisasi berhasil diperbarui.');
    }
}
