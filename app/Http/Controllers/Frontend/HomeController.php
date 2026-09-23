<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Contact;
use App\Models\Greeting;
use App\Models\RelatedLink;
use App\Models\Service;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the public homepage.
     */
    public function index(): View
    {
        $banners = Banner::where('is_active', true)
            ->latest('id')
            ->get();

        $greeting = Greeting::first();

        $services = Service::where('is_active', true)
            ->latest('id')
            ->get();

        $relatedLinks = RelatedLink::all();

        $contact = Contact::first();

        return view('frontend.home.index', compact(
            'banners',
            'greeting',
            'services',
            'relatedLinks',
            'contact'
        ));
    }
}
