<?php

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Models\Document;
use App\Models\DocumentCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DocumentManagementTest extends TestCase
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

    public function test_document_categories_crud(): void
    {
        // 1. Create category
        $response = $this->actingAs($this->admin)->post(route('admin.document-categories.store'), [
            'name' => 'SOP Layanan Akademik',
        ]);
        $response->assertRedirect(route('admin.document-categories.index'));
        $this->assertDatabaseHas('document_categories', ['name' => 'SOP Layanan Akademik']);

        $category = DocumentCategory::where('name', 'SOP Layanan Akademik')->first();

        // 2. Update category
        $response = $this->actingAs($this->admin)->put(route('admin.document-categories.update', $category), [
            'name' => 'SOP Layanan Kemahasiswaan',
        ]);
        $response->assertRedirect(route('admin.document-categories.index'));
        $this->assertDatabaseHas('document_categories', ['id' => $category->id, 'name' => 'SOP Layanan Kemahasiswaan']);

        // 3. Delete category
        $response = $this->actingAs($this->admin)->delete(route('admin.document-categories.destroy', $category));
        $response->assertRedirect(route('admin.document-categories.index'));
        $this->assertDatabaseMissing('document_categories', ['id' => $category->id]);
    }

    public function test_document_crud_and_ajax_search_filter(): void
    {
        Storage::fake('public');

        $category = DocumentCategory::create(['name' => 'Manual Mutu']);
        $pdfFile = UploadedFile::fake()->create('manual_spmi.pdf', 300, 'application/pdf');

        // 1. Store document
        $response = $this->actingAs($this->admin)->post(route('admin.documents.store'), [
            'document_category_id' => $category->id,
            'code' => 'PPM/MM/01/2026',
            'name' => 'Manual Mutu SPMI Poltekkes',
            'year' => 2026,
            'file' => $pdfFile,
        ]);

        $response->assertRedirect(route('admin.documents.index'));
        $this->assertDatabaseHas('documents', [
            'code' => 'PPM/MM/01/2026',
            'name' => 'Manual Mutu SPMI Poltekkes',
            'year' => 2026,
        ]);

        $document = Document::where('code', 'PPM/MM/01/2026')->first();
        $this->assertNotNull($document->file_path);
        Storage::disk('public')->assertExists($document->file_path);

        // 2. Update document data without changing file
        $response = $this->actingAs($this->admin)->put(route('admin.documents.update', $document), [
            'document_category_id' => $category->id,
            'code' => 'PPM/MM/01/2026-REV',
            'name' => 'Manual Mutu SPMI Poltekkes Revisi 1',
            'year' => 2026,
        ]);

        $response->assertRedirect(route('admin.documents.index'));
        $this->assertDatabaseHas('documents', [
            'id' => $document->id,
            'code' => 'PPM/MM/01/2026-REV',
            'name' => 'Manual Mutu SPMI Poltekkes Revisi 1',
        ]);

        // 3. Test AJAX table response for search
        $ajaxResponse = $this->actingAs($this->admin)->get(
            route('admin.documents.index', ['search' => 'Manual Mutu']),
            ['X-Requested-With' => 'XMLHttpRequest']
        );
        $ajaxResponse->assertStatus(200);
        $ajaxResponse->assertSee('PPM/MM/01/2026-REV');

        // 4. Delete document
        $response = $this->actingAs($this->admin)->delete(route('admin.documents.destroy', $document));
        $response->assertRedirect(route('admin.documents.index'));
        $this->assertSoftDeleted('documents', ['id' => $document->id]);
    }
}
