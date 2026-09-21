<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Document;
use App\Models\Gallery;
use App\Models\Service;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index(): View
    {
        $stats = [
            'total_documents' => Document::count(),
            'total_gallery' => Gallery::count(),
            'active_banners' => Banner::where('is_active', true)->count(),
            'active_services' => Service::where('is_active', true)->count(),
        ];

        $latestDocuments = Document::with('category')->latest()->take(5)->get();
        $latestGallery = Gallery::latest('event_date')->take(4)->get();

        return view('admin.dashboard.index', compact('stats', 'latestDocuments', 'latestGallery'));
    }
}
