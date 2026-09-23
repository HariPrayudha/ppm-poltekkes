<?php

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_page_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertSee('PPM Poltekkes Medan');
    }

    public function test_login_page_renders_autofill_credential_buttons(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertSee('btn-autofill-superadmin');
        $response->assertSee('btn-autofill-operator');
        $response->assertSee('Super Admin');
        $response->assertSee('Operator Mutu');
    }

    public function test_user_can_login_with_valid_credentials(): void
    {
        $user = User::factory()->create([
            'email' => 'admin@ppm.ac.id',
            'password' => bcrypt('password'),
            'role' => UserRole::SuperAdmin,
            'is_active' => true,
        ]);

        $response = $this->post('/login', [
            'email' => 'admin@ppm.ac.id',
            'password' => 'password',
        ]);

        $response->assertRedirect('/admin/dashboard');
        $this->assertAuthenticatedAs($user);
    }

    public function test_inactive_user_cannot_login(): void
    {
        User::factory()->create([
            'email' => 'inactive@ppm.ac.id',
            'password' => bcrypt('password'),
            'role' => UserRole::OperatorMutu,
            'is_active' => false,
        ]);

        $response = $this->post('/login', [
            'email' => 'inactive@ppm.ac.id',
            'password' => 'password',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_user_can_logout(): void
    {
        $user = User::factory()->create([
            'role' => UserRole::SuperAdmin,
            'is_active' => true,
        ]);

        $this->actingAs($user);

        $response = $this->post('/logout');

        $response->assertRedirect('/login');
        $this->assertGuest();
    }
}
