<?php

namespace Database\Seeders;

use App\Models\Document;
use App\Models\DocumentCategory;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kebijakan = DocumentCategory::where('name', 'Kebijakan Mutu')->first();
        $manual = DocumentCategory::where('name', 'Manual Mutu')->first();
        $standar = DocumentCategory::where('name', 'Standar Mutu')->first();
        $sop = DocumentCategory::where('name', 'Prosedur Operasional Standar (SOP)')->first();
        $formulir = DocumentCategory::where('name', 'Formulir Mutu')->first();

        $documents = [
            // Kebijakan Mutu
            [
                'document_category_id' => $kebijakan?->id,
                'code' => 'SPMI-PKM-KBM-01',
                'name' => 'Kebijakan Sistem Penjaminan Mutu Internal Poltekkes Kemenkes Medan',
                'year' => 2024,
                'file_path' => 'documents/sample-spmi-doc.pdf',
                'file_size' => 85944,
            ],
            [
                'document_category_id' => $kebijakan?->id,
                'code' => 'SPMI-PKM-KBM-02',
                'name' => 'Kebijakan Mutu Tata Kelola Tri Dharma dan Pelayanan BLU',
                'year' => 2023,
                'file_path' => 'documents/sample-spmi-doc.pdf',
                'file_size' => 85944,
            ],

            // Manual Mutu
            [
                'document_category_id' => $manual?->id,
                'code' => 'SPMI-PKM-MNL-01',
                'name' => 'Manual Penetapan Standar Mutu Pendidikan dan Pengajaran',
                'year' => 2024,
                'file_path' => 'documents/sample-spmi-doc.pdf',
                'file_size' => 85944,
            ],
            [
                'document_category_id' => $manual?->id,
                'code' => 'SPMI-PKM-MNL-02',
                'name' => 'Manual Pelaksanaan dan Pengendalian Audit Mutu Internal (AMI)',
                'year' => 2024,
                'file_path' => 'documents/sample-spmi-doc.pdf',
                'file_size' => 85944,
            ],
            [
                'document_category_id' => $manual?->id,
                'code' => 'SPMI-PKM-MNL-03',
                'name' => 'Manual Peningkatan Mutu Berkelanjutan Berbasis Evaluasi Kinerja',
                'year' => 2025,
                'file_path' => 'documents/sample-spmi-doc.pdf',
                'file_size' => 85944,
            ],

            // Standar Mutu
            [
                'document_category_id' => $standar?->id,
                'code' => 'SPMI-PKM-STD-01',
                'name' => 'Standar Kompetensi Lulusan Tenaga Kesehatan Vokasi',
                'year' => 2024,
                'file_path' => 'documents/sample-spmi-doc.pdf',
                'file_size' => 85944,
            ],
            [
                'document_category_id' => $standar?->id,
                'code' => 'SPMI-PKM-STD-02',
                'name' => 'Standar Proses Pembelajaran Klinik, Komunitas, dan Laboratorium',
                'year' => 2024,
                'file_path' => 'documents/sample-spmi-doc.pdf',
                'file_size' => 85944,
            ],
            [
                'document_category_id' => $standar?->id,
                'code' => 'SPMI-PKM-STD-03',
                'name' => 'Standar Penilaian Pembelajaran dan Praktik Kerja Lapangan Terpadu',
                'year' => 2023,
                'file_path' => 'documents/sample-spmi-doc.pdf',
                'file_size' => 85944,
            ],
            [
                'document_category_id' => $standar?->id,
                'code' => 'SPMI-PKM-STD-04',
                'name' => 'Standar Kualifikasi Dosen dan Tenaga Kependidikan Poltekkes Medan',
                'year' => 2023,
                'file_path' => 'documents/sample-spmi-doc.pdf',
                'file_size' => 85944,
            ],

            // Prosedur Operasional Standar (SOP)
            [
                'document_category_id' => $sop?->id,
                'code' => 'SPMI-PKM-SOP-01',
                'name' => 'SOP Pelaksanaan Audit Mutu Internal (AMI) Program Studi',
                'year' => 2024,
                'file_path' => 'documents/sample-spmi-doc.pdf',
                'file_size' => 85944,
            ],
            [
                'document_category_id' => $sop?->id,
                'code' => 'SPMI-PKM-SOP-02',
                'name' => 'SOP Penyusunan, Pengesahan, dan Pemutakhiran Dokumen SPMI',
                'year' => 2024,
                'file_path' => 'documents/sample-spmi-doc.pdf',
                'file_size' => 85944,
            ],
            [
                'document_category_id' => $sop?->id,
                'code' => 'SPMI-PKM-SOP-03',
                'name' => 'SOP Rapat Tinjauan Manajemen (RTM) Penjaminan Mutu Institusi',
                'year' => 2025,
                'file_path' => 'documents/sample-spmi-doc.pdf',
                'file_size' => 85944,
            ],
            [
                'document_category_id' => $sop?->id,
                'code' => 'SPMI-PKM-SOP-04',
                'name' => 'SOP Pengelolaan Umpan Balik dan Survei Kepuasan Sivitas Akademika',
                'year' => 2024,
                'file_path' => 'documents/sample-spmi-doc.pdf',
                'file_size' => 85944,
            ],

            // Formulir Mutu
            [
                'document_category_id' => $formulir?->id,
                'code' => 'SPMI-PKM-FRM-01',
                'name' => 'Formulir Instrumen Evaluasi Diri dan Kertas Kerja Auditor AMI',
                'year' => 2025,
                'file_path' => 'documents/sample-spmi-doc.pdf',
                'file_size' => 85944,
            ],
            [
                'document_category_id' => $formulir?->id,
                'code' => 'SPMI-PKM-FRM-02',
                'name' => 'Formulir Laporan Temuan Audit Mutu dan Rencana Tindak Korektif (RTK)',
                'year' => 2024,
                'file_path' => 'documents/sample-spmi-doc.pdf',
                'file_size' => 85944,
            ],
        ];

        foreach ($documents as $doc) {
            if (! $doc['document_category_id']) {
                continue;
            }

            Document::updateOrCreate(
                ['code' => $doc['code']],
                $doc
            );
        }
    }
}
