<?php

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactManagementTest extends TestCase
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

    public function test_contact_page_can_be_rendered(): void
    {
        Contact::create([
            'address' => 'Jl. Jamin Ginting KM. 13,5 Medan',
            'operating_hours' => 'Senin - Jumat: 08.00 - 16.00 WIB',
            'email' => 'ppm@poltekkes-medan.ac.id',
            'phone' => '(061) 8368633',
        ]);

        $response = $this->actingAs($this->admin)->get(route('admin.contact.index'));

        $response->assertStatus(200);
        $response->assertSee('ppm@poltekkes-medan.ac.id');
    }

    public function test_contact_can_be_updated(): void
    {
        $contact = Contact::create([
            'address' => 'Alamat Awal',
            'operating_hours' => '08:00 - 16:00',
            'email' => 'old@poltekkes-medan.ac.id',
            'phone' => '08123456789',
        ]);

        $response = $this->actingAs($this->admin)->put(route('admin.contact.update'), [
            'address' => 'Gedung Rektorat Lt. 2 Poltekkes Medan',
            'operating_hours' => 'Senin - Jumat: 08.00 - 16.00 WIB',
            'email' => 'info.ppm@poltekkes-medan.ac.id',
            'phone' => '(061) 8368633',
            'instagram_url' => 'https://instagram.com/ppm_poltekkesmedan',
            'youtube_url' => 'https://youtube.com/@ppmmedan',
            'facebook_url' => 'https://facebook.com/ppmmedan',
            'maps_embed' => '<iframe src="https://maps.google.com"></iframe>',
        ]);

        $response->assertRedirect(route('admin.contact.index'));
        $this->assertDatabaseHas('contacts', [
            'id' => $contact->id,
            'email' => 'info.ppm@poltekkes-medan.ac.id',
            'phone' => '(061) 8368633',
        ]);
    }

    public function test_contact_update_validation(): void
    {
        $response = $this->actingAs($this->admin)->put(route('admin.contact.update'), [
            'address' => '',
            'operating_hours' => '',
            'email' => 'invalid-email',
            'phone' => '',
        ]);

        $response->assertSessionHasErrors(['address', 'operating_hours', 'email', 'phone']);
    }
}
