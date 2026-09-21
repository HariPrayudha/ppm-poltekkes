<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use App\Services\UserService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService
    ) {}

    /**
     * Display a listing of admin users.
     */
    public function index(): View
    {
        $users = $this->userService->getAllPaginated(10);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Store a newly created user.
     */
    public function store(UserRequest $request): RedirectResponse
    {
        $this->userService->create($request->validated());

        return redirect()->route('admin.users.index')
            ->with('success', 'Pengguna admin berhasil ditambahkan.');
    }

    /**
     * Update the specified user.
     */
    public function update(UserRequest $request, User $user): RedirectResponse
    {
        $this->userService->update($user, $request->validated());

        return redirect()->route('admin.users.index')
            ->with('success', 'Data pengguna berhasil diperbarui.');
    }

    /**
     * Remove the specified user.
     */
    public function destroy(User $user): RedirectResponse
    {
        try {
            $this->userService->delete($user, (int) Auth::id());

            return redirect()->route('admin.users.index')
                ->with('success', 'Pengguna berhasil dihapus.');
        } catch (Exception $e) {
            return redirect()->route('admin.users.index')
                ->with('error', $e->getMessage());
        }
    }
}
