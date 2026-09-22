<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\View\View;

class GalleryController extends Controller
{
    /**
     * Display the photo gallery page.
     */
    public function index(): View
    {
        $galleries = Gallery::orderByDesc('event_date')->paginate(12);

        return view('frontend.gallery', compact('galleries'));
    }
}
