<?php

namespace App\Services;

use App\Models\User;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * Get paginated admin users.
     */
    public function getAllPaginated(int $perPage = 10): LengthAwarePaginator
    {
        return User::where('role', '!=', 'super_admin')->latest('id')->paginate($perPage);
    }

    /**
     * Create a new user.
     */
    public function create(array $data): User
    {
        $data['password'] = Hash::make($data['password']);
        $data['is_active'] = isset($data['is_active']) ? (bool) $data['is_active'] : false;

        return User::create($data);
    }

    /**
     * Update an existing user.
     */
    public function update(User $user, array $data): User
    {
        if (! empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $data['is_active'] = isset($data['is_active']) ? (bool) $data['is_active'] : false;

        $user->update($data);

        return $user;
    }

    /**
     * Delete a user with protection against deleting own account.
     *
     * @throws Exception
     */
    public function delete(User $user, int $currentUserId): bool
    {
        if ($user->id === $currentUserId) {
            throw new Exception('Anda tidak dapat menghapus akun Anda sendiri.');
        }

        return (bool) $user->delete();
    }
}
