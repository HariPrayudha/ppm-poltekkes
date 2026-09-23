<?php

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Models\Gallery;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class GalleryManagementTest extends TestCase
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

    public function test_gallery_page_can_be_rendered(): void
    {
        Gallery::create([
            'title' => 'Rapat Tinjauan Manajemen 2026',
            'event_date' => '2026-05-15',
            'image_path' => 'gallery/sample.jpg',
            'description' => 'Evaluasi hasil AMI semester genap.',
        ]);

        $response = $this->actingAs($this->admin)->get(route('admin.gallery.index'));

        $response->assertStatus(200);
        $response->assertSee('Rapat Tinjauan Manajemen 2026');
    }

    public function test_gallery_can_be_created_with_image(): void
    {
        Storage::fake('public');

        $image = UploadedFile::fake()->image('kegiatan.jpg', 800, 600);

        $response = $this->actingAs($this->admin)->post(route('admin.gallery.store'), [
            'title' => 'Sosialisasi Instrumen Akreditasi LAM-PTKes',
            'event_date' => '2026-06-20',
            'description' => 'Dihadiri seluruh ketua jurusan dan prodi.',
            'image' => $image,
        ]);

        $response->assertRedirect(route('admin.gallery.index'));
        $this->assertDatabaseHas('gallery', [
            'title' => 'Sosialisasi Instrumen Akreditasi LAM-PTKes',
        ]);

        $item = Gallery::where('title', 'Sosialisasi Instrumen Akreditasi LAM-PTKes')->first();
        $this->assertNotNull($item->image_path);
        $this->assertStringStartsWith('2026-06-20', (string) $item->event_date);
        Storage::disk('public')->assertExists($item->image_path);
    }

    public function test_gallery_can_be_updated(): void
    {
        $gallery = Gallery::create([
            'title' => 'Judul Kegiatan Lama',
            'event_date' => '2026-01-10',
            'image_path' => 'gallery/old.jpg',
            'description' => 'Keterangan awal',
        ]);

        $response = $this->actingAs($this->admin)->put(route('admin.gallery.update', $gallery), [
            'title' => 'Judul Kegiatan Baru Diperbaiki',
            'event_date' => '2026-01-12',
            'description' => 'Keterangan baru',
        ]);

        $response->assertRedirect(route('admin.gallery.index'));
        $this->assertDatabaseHas('gallery', [
            'id' => $gallery->id,
            'title' => 'Judul Kegiatan Baru Diperbaiki',
        ]);
        $updated = Gallery::find($gallery->id);
        $this->assertStringStartsWith('2026-01-12', (string) $updated->event_date);
    }

    public function test_gallery_can_be_updated_with_new_image(): void
    {
        Storage::fake('public');

        $oldImage = 'gallery/old_photo.jpg';
        Storage::disk('public')->put($oldImage, 'old dummy content');

        $gallery = Gallery::create([
            'title' => 'Foto Kegiatan Sebelum Update',
            'event_date' => '2026-01-10',
            'image_path' => $oldImage,
            'description' => 'Keterangan awal',
        ]);

        $newImage = UploadedFile::fake()->image('new_photo.jpg', 1200, 800)->size(1500); // 1.5MB image (below 2MB)

        $response = $this->actingAs($this->admin)->put(route('admin.gallery.update', $gallery), [
            'title' => 'Foto Kegiatan Setelah Update',
            'event_date' => '2026-01-15',
            'description' => 'Keterangan diperbarui',
            'image' => $newImage,
        ]);

        $response->assertRedirect(route('admin.gallery.index'));
        $gallery->refresh();

        $this->assertNotEquals($oldImage, $gallery->image_path);
        Storage::disk('public')->assertExists($gallery->image_path);
        Storage::disk('public')->assertMissing($oldImage);
    }

    public function test_gallery_rejects_image_over_2mb(): void
    {
        Storage::fake('public');

        $oversizedImage = UploadedFile::fake()->image('huge.jpg')->size(2500); // 2.5MB (above 2048KB)

        $response = $this->actingAs($this->admin)->post(route('admin.gallery.store'), [
            'title' => 'Foto Terlalu Besar',
            'event_date' => '2026-01-10',
            'image' => $oversizedImage,
        ]);

        $response->assertSessionHasErrors(['image']);
    }

    public function test_gallery_can_be_deleted(): void
    {
        Storage::fake('public');

        $imagePath = 'gallery/kegiatan_hapus.jpg';
        Storage::disk('public')->put($imagePath, 'dummy-image');

        $gallery = Gallery::create([
            'title' => 'Kegiatan Dihapus',
            'event_date' => '2026-02-01',
            'image_path' => $imagePath,
        ]);

        $response = $this->actingAs($this->admin)->delete(route('admin.gallery.destroy', $gallery));

        $response->assertRedirect(route('admin.gallery.index'));
        $this->assertDatabaseMissing('gallery', [
            'id' => $gallery->id,
        ]);
        Storage::disk('public')->assertMissing($imagePath);
    }
}
