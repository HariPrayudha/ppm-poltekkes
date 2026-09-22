<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\OrganizationProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Redirect default profile route to organizational structure.
     */
    public function index(): RedirectResponse
    {
        return redirect()->route('frontend.profile.structure');
    }

    /**
     * Display the organizational structure page (chart image + lightbox).
     */
    public function structure(): View
    {
        $profile = OrganizationProfile::first();

        return view('frontend.profile.structure', compact('profile'));
    }

    /**
     * Display the duties and functions page (Tupoksi rich text).
     */
    public function duties(): View
    {
        $profile = OrganizationProfile::first();

        return view('frontend.profile.duties', compact('profile'));
    }
}
