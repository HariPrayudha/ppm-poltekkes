<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GreetingRequest;
use App\Services\GreetingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class GreetingController extends Controller
{
    public function __construct(
        protected GreetingService $greetingService
    ) {}

    /**
     * Show the greeting editor.
     */
    public function index(): View
    {
        $greeting = $this->greetingService->getGreeting();

        return view('admin.greeting.index', compact('greeting'));
    }

    /**
     * Update the greeting details.
     */
    public function update(GreetingRequest $request): RedirectResponse
    {
        $greeting = $this->greetingService->getGreeting();

        $this->greetingService->update(
            $greeting,
            $request->validated(),
            $request->file('photo')
        );

        return redirect()->route('admin.greeting.index')
            ->with('success', 'Sambutan Kepala PPM berhasil diperbarui.');
    }
}
