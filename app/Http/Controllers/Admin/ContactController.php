<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ContactRequest;
use App\Services\ContactService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function __construct(
        protected ContactService $contactService
    ) {}

    /**
     * Show the contact details editor.
     */
    public function index(): View
    {
        $contact = $this->contactService->getContact();

        return view('admin.contact.index', compact('contact'));
    }

    /**
     * Update the contact information.
     */
    public function update(ContactRequest $request): RedirectResponse
    {
        $contact = $this->contactService->getContact();

        $this->contactService->update(
            $contact,
            $request->validated()
        );

        return redirect()->route('admin.contact.index')
            ->with('success', 'Data kontak & informasi footer berhasil diperbarui.');
    }
}
