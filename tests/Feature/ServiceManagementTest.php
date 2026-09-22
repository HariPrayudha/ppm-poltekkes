<?php

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ServiceManagementTest extends TestCase
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

    public function test_services_page_can_be_rendered(): void
    {
        Service::create([
            'name' => 'Audit Mutu Internal (AMI)',
            'description' => 'Pelaksanaan evaluasi berkala capaian standar prodi.',
            'order' => 1,
            'is_active' => true,
        ]);

        $response = $this->actingAs($this->admin)->get(route('admin.services.index'));

        $response->assertStatus(200);
        $response->assertSee('Audit Mutu Internal (AMI)');
    }

    public function test_service_can_be_created(): void
    {
        Storage::fake('public');

        $icon = UploadedFile::fake()->image('ami-icon.png', 100, 100);

        $response = $this->actingAs($this->admin)->post(route('admin.services.store'), [
            'name' => 'Konsultasi Kurikulum Berbasis OBE',
            'description' => 'Pendampingan implementasi Outcome-Based Education.',
            'is_active' => 1,
            'icon' => $icon,
        ]);

        $response->assertRedirect(route('admin.services.index'));
        $this->assertDatabaseHas('services', [
            'name' => 'Konsultasi Kurikulum Berbasis OBE',
        ]);

        $service = Service::where('name', 'Konsultasi Kurikulum Berbasis OBE')->first();
        $this->assertNotNull($service->icon_path);
        Storage::disk('public')->assertExists($service->icon_path);
    }

    public function test_service_status_can_be_toggled(): void
    {
        $service = Service::create([
            'name' => 'Layanan Akreditasi',
            'is_active' => true,
            'order' => 1,
        ]);

        $response = $this->actingAs($this->admin)->patch(route('admin.services.toggle', $service));

        $response->assertRedirect(route('admin.services.index'));
        $this->assertDatabaseHas('services', [
            'id' => $service->id,
            'is_active' => false,
        ]);
    }

    public function test_service_can_be_updated(): void
    {
        $service = Service::create([
            'name' => 'Layanan Lama',
            'description' => 'Deskripsi lama',
            'is_active' => true,
            'order' => 1,
        ]);

        $response = $this->actingAs($this->admin)->put(route('admin.services.update', $service), [
            'name' => 'Layanan Diperbarui',
            'description' => 'Deskripsi baru yang lebih lengkap.',
            'is_active' => 1,
        ]);

        $response->assertRedirect(route('admin.services.index'));
        $this->assertDatabaseHas('services', [
            'id' => $service->id,
            'name' => 'Layanan Diperbarui',
        ]);
    }

    public function test_service_can_be_deleted(): void
    {
        Storage::fake('public');

        $iconPath = 'services/sample_icon.png';
        Storage::disk('public')->put($iconPath, 'dummy-icon-data');

        $service = Service::create([
            'name' => 'Layanan Akan Dihapus',
            'icon_path' => $iconPath,
            'is_active' => true,
            'order' => 1,
        ]);

        $response = $this->actingAs($this->admin)->delete(route('admin.services.destroy', $service));

        $response->assertRedirect(route('admin.services.index'));
        $this->assertDatabaseMissing('services', [
            'id' => $service->id,
        ]);
        Storage::disk('public')->assertMissing($iconPath);
    }
}
