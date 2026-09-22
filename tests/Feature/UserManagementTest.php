<?php

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    protected User $superAdmin;

    protected User $operator;

    protected function setUp(): void
    {
        parent::setUp();

        $this->superAdmin = User::factory()->create([
            'name' => 'Super Administrator',
            'email' => 'superadmin@ppm.ac.id',
            'role' => UserRole::SuperAdmin,
            'is_active' => true,
        ]);

        $this->operator = User::factory()->create([
            'name' => 'Operator Mutu',
            'email' => 'operator@ppm.ac.id',
            'role' => UserRole::OperatorMutu,
            'is_active' => true,
        ]);
    }

    public function test_super_admin_can_view_users_index(): void
    {
        $response = $this->actingAs($this->superAdmin)->get(route('admin.users.index'));

        $response->assertStatus(200);
        $response->assertSee('Kelola Pengguna');
        $response->assertSee('operator@ppm.ac.id');
    }

    public function test_operator_mutu_cannot_view_users_index(): void
    {
        $response = $this->actingAs($this->operator)->get(route('admin.users.index'));

        $response->assertStatus(403);
    }

    public function test_super_admin_can_create_user(): void
    {
        $response = $this->actingAs($this->superAdmin)->post(route('admin.users.store'), [
            'name' => 'Staf Baru Mutu',
            'email' => 'stafbaru@ppm.ac.id',
            'role' => 'operator_mutu',
            'password' => 'secret123',
            'is_active' => 1,
        ]);

        $response->assertRedirect(route('admin.users.index'));
        $this->assertDatabaseHas('users', [
            'name' => 'Staf Baru Mutu',
            'email' => 'stafbaru@ppm.ac.id',
            'role' => UserRole::OperatorMutu->value,
        ]);

        $user = User::where('email', 'stafbaru@ppm.ac.id')->first();
        $this->assertTrue(Hash::check('secret123', $user->password));
    }

    public function test_super_admin_can_update_user(): void
    {
        $user = User::factory()->create([
            'name' => 'Nama Lama',
            'email' => 'userlama@ppm.ac.id',
            'role' => UserRole::OperatorMutu,
        ]);

        $response = $this->actingAs($this->superAdmin)->put(route('admin.users.update', $user), [
            'name' => 'Nama Diperbarui',
            'email' => 'userlama@ppm.ac.id',
            'role' => 'super_admin',
            'is_active' => 1,
        ]);

        $response->assertRedirect(route('admin.users.index'));
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Nama Diperbarui',
            'role' => UserRole::SuperAdmin->value,
        ]);
    }

    public function test_super_admin_can_delete_user(): void
    {
        $user = User::factory()->create([
            'name' => 'User To Delete',
            'email' => 'todelete@ppm.ac.id',
            'role' => UserRole::OperatorMutu,
        ]);

        $response = $this->actingAs($this->superAdmin)->delete(route('admin.users.destroy', $user));

        $response->assertRedirect(route('admin.users.index'));
        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
        ]);
    }
}
