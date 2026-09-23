<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\View\View;

class ContactController extends Controller
{
    /**
     * Display the contact and FAQ page.
     */
    public function index(): View
    {
        $contact = Contact::first();

        return view('frontend.contact.index', compact('contact'));
    }
}
