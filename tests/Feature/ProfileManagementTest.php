<?php

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Models\OrganizationProfile;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProfileManagementTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'role' => UserRole::OperatorMutu,
            'is_active' => true,
        ]);
    }

    public function test_profile_page_can_be_rendered(): void
    {
        OrganizationProfile::create([
            'duties_content' => '<p>Melaksanakan penjaminan mutu pendidikan secara berkelanjutan.</p>',
        ]);

        $response = $this->actingAs($this->admin)->get(route('admin.profile.index'));

        $response->assertStatus(200);
        $response->assertSee('Bagan Struktur Organisasi');
    }

    public function test_profile_can_be_updated_with_org_chart(): void
    {
        Storage::fake('public');

        $profile = OrganizationProfile::create([
            'duties_content' => '<p>Konten awal tugas fungsi</p>',
        ]);

        $chart = UploadedFile::fake()->image('bagan_ppm.png', 1000, 800);

        $response = $this->actingAs($this->admin)->put(route('admin.profile.update'), [
            'duties_content' => '<p>Tugas dan wewenang diperbarui secara formal.</p>',
            'org_chart' => $chart,
        ]);

        $response->assertRedirect(route('admin.profile.index'));
        $this->assertDatabaseHas('organization_profiles', [
            'id' => $profile->id,
            'duties_content' => '<p>Tugas dan wewenang diperbarui secara formal.</p>',
        ]);

        $updated = OrganizationProfile::find($profile->id);
        $this->assertNotNull($updated->org_chart_path);
        Storage::disk('public')->assertExists($updated->org_chart_path);
    }
}
