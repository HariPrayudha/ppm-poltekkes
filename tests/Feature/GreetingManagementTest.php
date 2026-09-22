<?php

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Models\Greeting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class GreetingManagementTest extends TestCase
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

    public function test_greeting_page_can_be_rendered(): void
    {
        Greeting::create([
            'name' => 'Dr. H. Nama Kepala, M.Kes',
            'position' => 'Kepala Pusat Penjaminan Mutu',
            'content' => '<p>Selamat datang di portal penjaminan mutu.</p>',
        ]);

        $response = $this->actingAs($this->admin)->get(route('admin.greeting.index'));

        $response->assertStatus(200);
        $response->assertSee('Dr. H. Nama Kepala, M.Kes');
    }

    public function test_greeting_can_be_updated_with_photo_upload(): void
    {
        Storage::fake('public');

        $greeting = Greeting::create([
            'name' => 'Nama Awal',
            'position' => 'Jabatan Awal',
            'content' => '<p>Sambutan awal</p>',
        ]);

        $photo = UploadedFile::fake()->image('kepala_ppm.png', 400, 400);

        $response = $this->actingAs($this->admin)->put(route('admin.greeting.update'), [
            'name' => 'Prof. Dr. Kepala Baru, M.Kes',
            'position' => 'Ketua PPM Periode 2026-2030',
            'content' => '<p>Sambutan baru dengan visi terdepan.</p>',
            'photo' => $photo,
        ]);

        $response->assertRedirect(route('admin.greeting.index'));
        $this->assertDatabaseHas('greeting', [
            'id' => $greeting->id,
            'name' => 'Prof. Dr. Kepala Baru, M.Kes',
            'position' => 'Ketua PPM Periode 2026-2030',
        ]);

        $updated = Greeting::find($greeting->id);
        $this->assertNotNull($updated->photo_path);
        Storage::disk('public')->assertExists($updated->photo_path);
    }

    public function test_greeting_update_validates_required_fields(): void
    {
        $response = $this->actingAs($this->admin)->put(route('admin.greeting.update'), [
            'name' => '',
            'position' => '',
            'content' => '',
        ]);

        $response->assertSessionHasErrors(['name', 'position', 'content']);
    }
}
