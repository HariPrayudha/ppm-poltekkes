<?php

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Models\DocumentCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_login(): void
    {
        $response = $this->get('/admin/dashboard');

        $response->assertRedirect('/login');
    }

    public function test_operator_mutu_can_access_dashboard_and_modules(): void
    {
        $operator = User::factory()->create([
            'role' => UserRole::OperatorMutu,
            'is_active' => true,
        ]);

        $response = $this->actingAs($operator)->get('/admin/dashboard');
        $response->assertStatus(200);

        $response = $this->actingAs($operator)->get('/admin/banners');
        $response->assertStatus(200);

        $response = $this->actingAs($operator)->get('/admin/documents');
        $response->assertStatus(200);
    }

    public function test_operator_mutu_cannot_access_user_management(): void
    {
        $operator = User::factory()->create([
            'role' => UserRole::OperatorMutu,
            'is_active' => true,
        ]);

        $response = $this->actingAs($operator)->get('/admin/users');

        $response->assertStatus(403);
    }

    public function test_super_admin_can_access_user_management(): void
    {
        $superAdmin = User::factory()->create([
            'role' => UserRole::SuperAdmin,
            'is_active' => true,
        ]);

        $response = $this->actingAs($superAdmin)->get('/admin/users');

        $response->assertStatus(200);
    }

    public function test_document_can_be_uploaded(): void
    {
        Storage::fake('public');

        $operator = User::factory()->create([
            'role' => UserRole::OperatorMutu,
            'is_active' => true,
        ]);

        $category = DocumentCategory::create([
            'name' => 'Standar Mutu',
            'order' => 1,
        ]);

        $file = UploadedFile::fake()->create('sop_mutu_2026.pdf', 500, 'application/pdf');

        $response = $this->actingAs($operator)->post('/admin/documents', [
            'document_category_id' => $category->id,
            'code' => 'SPMI/STD/01/2026',
            'name' => 'Standar Kompetensi Lulusan',
            'year' => 2026,
            'file' => $file,
        ]);

        $response->assertRedirect('/admin/documents');
        $this->assertDatabaseHas('documents', [
            'code' => 'SPMI/STD/01/2026',
            'name' => 'Standar Kompetensi Lulusan',
            'year' => 2026,
        ]);
    }
}
