<?php

namespace Tests\Feature\Frontend;

use App\Models\Banner;
use App\Models\Contact;
use App\Models\Document;
use App\Models\DocumentCategory;
use App\Models\Gallery;
use App\Models\Greeting;
use App\Models\OrganizationProfile;
use App\Models\RelatedLink;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_is_accessible_and_renders_successfully(): void
    {
        Banner::create([
            'title' => 'Banner SPMI Nasional',
            'image_path' => 'banners/banner1.webp',
            'is_active' => true,
        ]);

        Greeting::create([
            'name' => 'Dr. Hj. Siti Mutu, M.Kes',
            'position' => 'Kepala Pusat Penjaminan Mutu',
            'content' => '<p>Selamat datang di portal penjaminan mutu resmi.</p>',
        ]);

        Service::create([
            'name' => 'Audit Mutu Internal',
            'description' => 'Layanan audit mutu berkala untuk seluruh program studi.',
            'is_active' => true,
        ]);

        RelatedLink::create([
            'name' => 'Kementerian Kesehatan RI',
            'url' => 'https://kemkes.go.id',
        ]);

        $response = $this->get(route('frontend.home'));

        $response->assertStatus(200);
        $response->assertViewIs('frontend.home');
        $response->assertSee('Banner SPMI Nasional');
        $response->assertSee('Dr. Hj. Siti Mutu, M.Kes');
        $response->assertSee('Audit Mutu Internal');
        $response->assertSee('Kementerian Kesehatan RI');
    }

    public function test_profile_structure_page_is_accessible(): void
    {
        OrganizationProfile::create([
            'org_chart_path' => 'profile/chart.webp',
            'duties_content' => '<p>Melaksanakan perencanaan, pelaksanaan, dan evaluasi SPMI.</p>',
        ]);

        $response = $this->get(route('frontend.profile.structure'));

        $response->assertStatus(200);
        $response->assertViewIs('frontend.profile.structure');
        $response->assertSee('Struktur Organisasi');
        $response->assertSee('Bagan Visual Struktur Organisasi');
    }

    public function test_profile_duties_page_is_accessible(): void
    {
        OrganizationProfile::create([
            'org_chart_path' => 'profile/chart.webp',
            'duties_content' => '<p>Melaksanakan perencanaan, pelaksanaan, dan evaluasi SPMI.</p>',
        ]);

        $response = $this->get(route('frontend.profile.duties'));

        $response->assertStatus(200);
        $response->assertViewIs('frontend.profile.duties');
        $response->assertSee('Tugas dan Fungsi');
        $response->assertSee('Melaksanakan perencanaan, pelaksanaan, dan evaluasi SPMI');
    }

    public function test_profile_index_redirects_to_structure(): void
    {
        $response = $this->get(route('frontend.profile'));

        $response->assertRedirect(route('frontend.profile.structure'));
    }

    public function test_document_repository_lists_documents(): void
    {
        $category = DocumentCategory::create(['name' => 'Kebijakan']);

        Document::create([
            'document_category_id' => $category->id,
            'code' => 'KBJ-2026-001',
            'name' => 'Kebijakan Mutu Poltekkes Medan',
            'year' => 2026,
            'file_path' => 'documents/kbj001.pdf',
            'file_size' => 204800,
        ]);

        $response = $this->get(route('frontend.documents.index'));

        $response->assertStatus(200);
        $response->assertViewIs('frontend.documents.index');
        $response->assertSee('Kebijakan Mutu Poltekkes Medan');
        $response->assertSee('KBJ-2026-001');
    }

    public function test_document_repository_filters_by_category(): void
    {
        $cat1 = DocumentCategory::create(['name' => 'SOP']);
        $cat2 = DocumentCategory::create(['name' => 'Manual Mutu']);

        Document::create([
            'document_category_id' => $cat1->id,
            'code' => 'SOP-001',
            'name' => 'SOP Pengendalian Dokumen',
            'year' => 2025,
            'file_path' => 'documents/sop01.pdf',
        ]);

        Document::create([
            'document_category_id' => $cat2->id,
            'code' => 'MNL-001',
            'name' => 'Manual Mutu SPMI',
            'year' => 2025,
            'file_path' => 'documents/mnl01.pdf',
        ]);

        $response = $this->get(route('frontend.documents.index', ['category_id' => $cat1->id]));

        $response->assertStatus(200);
        $response->assertSee('SOP Pengendalian Dokumen');
        $response->assertDontSee('Manual Mutu SPMI');
    }

    public function test_document_repository_filters_by_year_and_search(): void
    {
        $cat = DocumentCategory::create(['name' => 'Standar']);

        Document::create([
            'document_category_id' => $cat->id,
            'code' => 'STD-2024',
            'name' => 'Standar Sarana Prasarana',
            'year' => 2024,
            'file_path' => 'documents/std2024.pdf',
        ]);

        Document::create([
            'document_category_id' => $cat->id,
            'code' => 'STD-2026',
            'name' => 'Standar Kemahasiswaan Unggul',
            'year' => 2026,
            'file_path' => 'documents/std2026.pdf',
        ]);

        // Filter by Year
        $responseYear = $this->get(route('frontend.documents.index', ['year' => 2026]));
        $responseYear->assertStatus(200);
        $responseYear->assertSee('Standar Kemahasiswaan Unggul');
        $responseYear->assertDontSee('Standar Sarana Prasarana');

        // Filter by Search Keyword
        $responseSearch = $this->get(route('frontend.documents.index', ['search' => 'Sarana']));
        $responseSearch->assertStatus(200);
        $responseSearch->assertSee('Standar Sarana Prasarana');
        $responseSearch->assertDontSee('Standar Kemahasiswaan Unggul');
    }

    public function test_document_repository_ajax_request_returns_table_partial(): void
    {
        $cat = DocumentCategory::create(['name' => 'Formulir']);

        Document::create([
            'document_category_id' => $cat->id,
            'code' => 'FRM-01',
            'name' => 'Formulir Evaluasi Dosen',
            'year' => 2026,
            'file_path' => 'documents/frm01.pdf',
        ]);

        $response = $this->get(route('frontend.documents.index'), [
            'X-Requested-With' => 'XMLHttpRequest',
        ]);

        $response->assertStatus(200);
        $response->assertViewIs('frontend.documents._table');
        $response->assertSee('Formulir Evaluasi Dosen');
    }

    public function test_document_preview_stream_with_anti_idm_header(): void
    {
        Storage::fake('public');
        $file = UploadedFile::fake()->create('dokumen-uji.pdf', 300, 'application/pdf');
        $path = $file->store('documents', 'public');

        $cat = DocumentCategory::create(['name' => 'Standar']);
        $doc = Document::create([
            'document_category_id' => $cat->id,
            'code' => 'STD-TEST-01',
            'name' => 'Standar Uji Pratinjau',
            'year' => 2026,
            'file_path' => $path,
        ]);

        // Preview with anti-IDM header
        $response = $this->get(route('frontend.documents.preview', $doc), [
            'X-Preview-Request' => '1',
        ]);

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/octet-stream');
        $response->assertHeader('Content-Disposition', 'inline');
    }

    public function test_document_download_endpoint(): void
    {
        Storage::fake('public');
        $file = UploadedFile::fake()->create('dokumen-download.pdf', 300, 'application/pdf');
        $path = $file->store('documents', 'public');

        $cat = DocumentCategory::create(['name' => 'Standar']);
        $doc = Document::create([
            'document_category_id' => $cat->id,
            'code' => 'STD-DL-01',
            'name' => 'Standar Unduh Berkas',
            'year' => 2026,
            'file_path' => $path,
        ]);

        $response = $this->get(route('frontend.documents.download', $doc));

        $response->assertStatus(200);
        $response->assertDownload();
    }

    public function test_gallery_page_is_accessible_and_lists_photos(): void
    {
        Gallery::create([
            'title' => 'Workshop Audit Mutu 2026',
            'image_path' => 'gallery/workshop.webp',
            'event_date' => '2026-03-15',
            'description' => 'Kegiatan penyegaran auditor SPMI internal.',
        ]);

        $response = $this->get(route('frontend.gallery.index'));

        $response->assertStatus(200);
        $response->assertViewIs('frontend.gallery');
        $response->assertSee('Workshop Audit Mutu 2026');
        $response->assertSee('15 Maret 2026');
    }

    public function test_contact_page_is_accessible_and_shows_details_and_faq(): void
    {
        Contact::create([
            'address' => 'Jl. Jamin Ginting KM. 13,5 Lau Cih Medan',
            'email' => 'mutu@poltekkes-medan.ac.id',
            'phone' => '(061) 8368633',
            'operating_hours' => 'Senin - Jumat: 08.00 - 16.00 WIB',
        ]);

        $response = $this->get(route('frontend.contact.index'));

        $response->assertStatus(200);
        $response->assertViewIs('frontend.contact');
        $response->assertSee('Jl. Jamin Ginting KM. 13,5 Lau Cih Medan');
        $response->assertSee('mutu@poltekkes-medan.ac.id');
        $response->assertSee('Pertanyaan yang Sering Diajukan (FAQ)');
    }

    public function test_navbar_does_not_contain_admin_portal_button(): void
    {
        $response = $this->get(route('frontend.home'));

        $response->assertStatus(200);
        $response->assertDontSee('Portal Admin');
    }

    public function test_navbar_contains_profile_dropdown_items(): void
    {
        $response = $this->get(route('frontend.home'));

        $response->assertStatus(200);
        $response->assertSee(route('frontend.profile.structure'));
        $response->assertSee(route('frontend.profile.duties'));
        $response->assertSee('Struktur Organisasi');
        $response->assertSee('Tugas & Fungsi', false);
    }
}
