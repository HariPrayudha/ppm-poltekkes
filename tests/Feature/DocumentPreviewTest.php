<?php

namespace Tests\Feature;

use App\Models\Document;
use App\Models\DocumentCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DocumentPreviewTest extends TestCase
{
    use RefreshDatabase;

    public function test_preview_file_returns_pdf_inline(): void
    {
        Storage::fake('public');

        $user = User::factory()->create(['role' => 'super_admin', 'is_active' => true]);
        $category = DocumentCategory::create(['name' => 'SOP']);

        $pdfContent = "%PDF-1.4\n1 0 obj\n<<>>\nendobj\ntrailer\n<<>>\n%%EOF";
        $filePath = 'documents/test.pdf';
        Storage::disk('public')->put($filePath, $pdfContent);

        $document = Document::create([
            'document_category_id' => $category->id,
            'code' => 'SOP-001',
            'name' => 'Test SOP Document',
            'year' => 2026,
            'file_path' => $filePath,
            'file_size' => strlen($pdfContent),
        ]);

        $response = $this->actingAs($user)->get(route('admin.documents.preview-file', $document));

        $response->assertStatus(200);
        $this->assertEquals('application/pdf', $response->headers->get('Content-Type'));
        $this->assertStringContainsString('inline', $response->headers->get('Content-Disposition'));
        $this->assertEquals('SAMEORIGIN', $response->headers->get('X-Frame-Options'));

        // Preview with AJAX X-Preview-Request header (to prevent IDM hijacking)
        $ajaxResponse = $this->actingAs($user)->get(
            route('admin.documents.preview-file', $document),
            ['X-Preview-Request' => '1']
        );
        $ajaxResponse->assertStatus(200);
        $this->assertEquals('application/octet-stream', $ajaxResponse->headers->get('Content-Type'));
    }
}
