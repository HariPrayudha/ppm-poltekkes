<?php

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Models\RelatedLink;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class RelatedLinkManagementTest extends TestCase
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

    public function test_related_links_page_can_be_rendered(): void
    {
        RelatedLink::create([
            'name' => 'Kementerian Kesehatan RI',
            'url' => 'https://kemkes.go.id',
            'order' => 1,
        ]);

        $response = $this->actingAs($this->admin)->get(route('admin.related-links.index'));

        $response->assertStatus(200);
        $response->assertSee('Kementerian Kesehatan RI');
    }

    public function test_related_link_can_be_created_with_logo(): void
    {
        Storage::fake('public');

        $logo = UploadedFile::fake()->image('kemenkes_logo.png', 200, 200);

        $response = $this->actingAs($this->admin)->post(route('admin.related-links.store'), [
            'name' => 'BAN-PT',
            'url' => 'https://banpt.or.id',
            'logo' => $logo,
        ]);

        $response->assertRedirect(route('admin.related-links.index'));
        $this->assertDatabaseHas('related_links', [
            'name' => 'BAN-PT',
            'url' => 'https://banpt.or.id',
        ]);

        $link = RelatedLink::where('name', 'BAN-PT')->first();
        $this->assertNotNull($link->logo_path);
        Storage::disk('public')->assertExists($link->logo_path);
    }

    public function test_related_link_can_be_updated(): void
    {
        $link = RelatedLink::create([
            'name' => 'Link Lama',
            'url' => 'https://old.link.id',
            'order' => 1,
        ]);

        $response = $this->actingAs($this->admin)->put(route('admin.related-links.update', $link), [
            'name' => 'Link Diperbarui',
            'url' => 'https://new.link.id',
        ]);

        $response->assertRedirect(route('admin.related-links.index'));
        $this->assertDatabaseHas('related_links', [
            'id' => $link->id,
            'name' => 'Link Diperbarui',
            'url' => 'https://new.link.id',
        ]);
    }

    public function test_related_link_can_be_deleted(): void
    {
        Storage::fake('public');

        $logoPath = 'related-links/logo.png';
        Storage::disk('public')->put($logoPath, 'dummy-logo-data');

        $link = RelatedLink::create([
            'name' => 'Tautan Dihapus',
            'url' => 'https://delete.me',
            'logo_path' => $logoPath,
            'order' => 1,
        ]);

        $response = $this->actingAs($this->admin)->delete(route('admin.related-links.destroy', $link));

        $response->assertRedirect(route('admin.related-links.index'));
        $this->assertDatabaseMissing('related_links', [
            'id' => $link->id,
        ]);
        Storage::disk('public')->assertMissing($logoPath);
    }
}
