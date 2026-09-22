<?php

namespace Database\Seeders;

use App\Models\OrganizationProfile;
use Illuminate\Database\Seeder;

class OrganizationProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dutiesContent = <<<'HTML'
<h3>Dasar Hukum</h3>
<p>Pusat Penjaminan Mutu (PPM) Poltekkes Kemenkes Medan dibentuk dan beroperasi dengan landasan yuridis sebagai berikut:</p>
<ol>
    <li>Undang-Undang Republik Indonesia Nomor 12 Tahun 2012 tentang Pendidikan Tinggi.</li>
    <li>Peraturan Menteri Pendidikan, Kebudayaan, Riset, dan Teknologi Republik Indonesia Nomor 53 Tahun 2023 tentang Penjaminan Mutu Pendidikan Tinggi.</li>
    <li>Peraturan Menteri Kesehatan Republik Indonesia tentang Organisasi dan Tata Kerja Politeknik Kesehatan di Lingkungan Kementerian Kesehatan.</li>
    <li>Statuta Politeknik Kesehatan Kementerian Kesehatan Medan.</li>
</ol>

<h3>Tugas Pokok</h3>
<p>Pusat Penjaminan Mutu Poltekkes Kemenkes Medan mempunyai tugas pokok merencanakan, mengembangkan, mengoordinasikan, memonitor, mengevaluasi, dan mengendalikan pelaksanaan Sistem Penjaminan Mutu Internal (SPMI) secara menyeluruh pada seluruh unit kerja dan program studi di lingkungan Poltekkes Kemenkes Medan untuk mewujudkan budaya mutu yang berkelanjutan.</p>

<h3>Fungsi Utama</h3>
<p>Dalam menyelenggarakan tugas pokok tersebut, Pusat Penjaminan Mutu mengemban fungsi-fungsi strategis sebagai berikut:</p>
<ul>
    <li><strong>Pengembangan Kebijakan dan Dokumen Mutu:</strong> Merumuskan, meninjau ulang, dan memutakhirkan Kebijakan Mutu, Manual Mutu, Standar Mutu SPMI, Standar Operasional Prosedur (SOP), serta Formulir Mutu yang relevan dengan perkembangan regulasi nasional dan kebutuhan stakeholder.</li>
    <li><strong>Koordinasi dan Fasilitasi SPMI:</strong> Mengoordinasikan sosialisasi dan penerapan standar mutu pada bidang pendidikan, penelitian, pengabdian kepada masyarakat, kemahasiswaan, dan tata kelola di tingkat jurusan dan program studi.</li>
    <li><strong>Monitoring dan Evaluasi Berkala:</strong> Menjalankan pemantauan dan evaluasi terhadap implementasi standar mutu serta ketercapaian Indikator Kinerja Utama (IKU) institusi dan Indikator Kinerja Tambahan (IKT).</li>
    <li><strong>Penyelenggaraan Audit Mutu Internal (AMI):</strong> Merencanakan dan melaksanakan Audit Mutu Internal secara berkala pada bidang akademik dan non-akademik dengan melibatkan auditor internal yang tersertifikasi dan independen.</li>
    <li><strong>Pengendalian Mutu dan Rapat Tinjauan Manajemen (RTM):</strong> Mengompilasi laporan hasil temuan audit, memfasilitasi pelaksanaan Rapat Tinjauan Manajemen bersama pimpinan direktorat, serta merumuskan rencana tindakan korektif atas temuan audit.</li>
    <li><strong>Fasilitasi Akreditasi dan Peningkatan Berkelanjutan:</strong> Mendampingi persiapan, simulasi, dan pelaksanaan akreditasi program studi maupun akreditasi perguruan tinggi (APT) oleh LAM-PTKes dan BAN-PT guna menjamin pencapaian predikat Unggul.</li>
</ul>

<h3>Ruang Lingkup Penjaminan Mutu</h3>
<p>Sistem Penjaminan Mutu Internal di Poltekkes Kemenkes Medan mencakup empat pilar utama:</p>
<ul>
    <li><strong>Standar Pendidikan:</strong> Kompetensi lulusan, isi pembelajaran, proses perkuliahan dan praktik klinik/laboratorium, penilaian pembelajaran, dosen dan tenaga kependidikan, sarana prasarana pembelajaran, pengelolaan, serta pembiayaan pembelajaran.</li>
    <li><strong>Standar Penelitian:</strong> Hasil penelitian dosen dan mahasiswa bidang kesehatan, isi penelitian, proses penelitian, penilaian, peneliti, sarana prasarana penelitian, pengelolaan, serta pendanaan penelitian.</li>
    <li><strong>Standar Pengabdian kepada Masyarakat (PkM):</strong> Hasil PkM berbasis pemberdayaan kesehatan masyarakat, materi PkM, proses pelaksanaan, penilaian, pelaksana, sarana prasarana, pengelolaan, dan pembiayaan PkM.</li>
    <li><strong>Standar Layanan dan Tata Kelola Tambahan:</strong> Pelayanan kemahasiswaan, kerja sama institusional dalam dan luar negeri, tata kelola keuangan Badan Layanan Umum (BLU), manajemen risiko, dan sistem informasi terpadu.</li>
</ul>
HTML;

        OrganizationProfile::updateOrCreate(
            ['id' => 1],
            [
                'org_chart_path' => null,
                'duties_content' => $dutiesContent,
            ]
        );
    }
}
