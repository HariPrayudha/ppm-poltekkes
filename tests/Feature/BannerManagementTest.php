<?php

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Models\Banner;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BannerManagementTest extends TestCase
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

    public function test_banners_page_can_be_rendered(): void
    {
        Banner::create([
            'title' => 'Banner SPMI 2026',
            'image_path' => 'banners/sample.webp',
            'is_active' => true,
        ]);

        $response = $this->actingAs($this->admin)->get(route('admin.banners.index'));

        $response->assertStatus(200);
        $response->assertSee('Banner SPMI 2026');
    }

    public function test_banner_can_be_created_with_image_upload(): void
    {
        Storage::fake('public');

        $image = UploadedFile::fake()->image('hero.jpg', 1200, 600);

        $response = $this->actingAs($this->admin)->post(route('admin.banners.store'), [
            'title' => 'Pusat Penjaminan Mutu Poltekkes',
            'description' => 'Mewujudkan tata kelola mutu yang unggul.',
            'cta_label' => 'Lihat Dokumen',
            'cta_url' => 'https://poltekkes-medan.ac.id',
            'is_active' => 1,
            'image' => $image,
        ]);

        $response->assertRedirect(route('admin.banners.index'));
        $this->assertDatabaseHas('banners', [
            'title' => 'Pusat Penjaminan Mutu Poltekkes',
            'cta_label' => 'Lihat Dokumen',
        ]);

        $banner = Banner::first();
        $this->assertNotNull($banner->image_path);
        Storage::disk('public')->assertExists($banner->image_path);
    }

    public function test_banner_can_be_updated_without_changing_image(): void
    {
        $banner = Banner::create([
            'title' => 'Old Title',
            'image_path' => 'banners/old.jpg',
            'is_active' => true,
        ]);

        $response = $this->actingAs($this->admin)->put(route('admin.banners.update', $banner), [
            'title' => 'Updated Banner Title',
            'description' => 'Updated Description',
            'is_active' => 1,
        ]);

        $response->assertRedirect(route('admin.banners.index'));
        $this->assertDatabaseHas('banners', [
            'id' => $banner->id,
            'title' => 'Updated Banner Title',
            'image_path' => 'banners/old.jpg',
        ]);
    }

    public function test_banner_status_can_be_toggled(): void
    {
        $banner = Banner::create([
            'title' => 'Active Banner',
            'image_path' => 'banners/sample.jpg',
            'is_active' => true,
        ]);

        $response = $this->actingAs($this->admin)->patch(route('admin.banners.toggle', $banner));

        $response->assertRedirect(route('admin.banners.index'));
        $this->assertDatabaseHas('banners', [
            'id' => $banner->id,
            'is_active' => false,
        ]);
    }

    public function test_banner_can_be_deleted(): void
    {
        Storage::fake('public');

        $imagePath = 'banners/to_delete.jpg';
        Storage::disk('public')->put($imagePath, 'fake-image-data');

        $banner = Banner::create([
            'title' => 'Banner To Delete',
            'image_path' => $imagePath,
            'is_active' => true,
        ]);

        $response = $this->actingAs($this->admin)->delete(route('admin.banners.destroy', $banner));

        $response->assertRedirect(route('admin.banners.index'));
        $this->assertDatabaseMissing('banners', [
            'id' => $banner->id,
        ]);
        Storage::disk('public')->assertMissing($imagePath);
    }
}
