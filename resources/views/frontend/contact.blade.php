@extends('layouts.frontend')

@section('title', 'Kontak & FAQ')

@section('content')
    @php
        $address = $contact?->address ?: 'Jl. Jamin Ginting KM. 13,5 Kel. Lau Cih, Kec. Medan Tuntungan, Kota Medan, Sumatera Utara 20137';
        $operatingHours = $contact?->operating_hours ?: 'Senin - Jumat: 08.00 - 16.00 WIB';
        $email = $contact?->email ?: 'mutu@poltekkes-medan.ac.id';
        $phone = $contact?->phone ?: '(061) 8368633';
        $mapsEmbed = $contact?->maps_embed ?: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3982.2858882585257!2d98.59960257579606!3d3.5212386964530064!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3031252d672808c1%3A0x8e5f1b1fa1da8ea4!2sPoltekkes%20Kemenkes%20Medan!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid';
        $instagram = $contact?->instagram_url ?: 'https://instagram.com';
        $youtube = $contact?->youtube_url ?: 'https://youtube.com';
        $facebook = $contact?->facebook_url ?: 'https://facebook.com';
    @endphp

    <!-- Header Banner -->
    <div class="bg-linear-to-b from-slate-900 via-slate-900 to-slate-800 text-white py-16 sm:py-20 border-b border-slate-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-[#0BB5CB]/20 border border-[#0BB5CB]/40 text-[#0BB5CB] text-xs font-semibold uppercase tracking-wider mb-4">
                <i data-feather="mail" class="w-3.5 h-3.5"></i>
                Layanan Informasi
            </div>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight">
                Kontak Resmi & Sekretariat PPM
            </h1>
            <p class="mt-4 text-slate-300 text-sm sm:text-base max-w-2xl mx-auto leading-relaxed">
                Hubungi Pusat Penjaminan Mutu Poltekkes Kemenkes Medan untuk koordinasi SPMI, informasi instrumen akreditasi, dan layanan mutu pendidikan.
            </p>
        </div>
    </div>

    <!-- Contact Info & Map Section -->
    <section class="py-14 sm:py-20 bg-slate-50 reveal-on-scroll">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">
                <!-- Contact Details Cards (5 cols) -->
                <div class="lg:col-span-5 space-y-6">
                    <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs space-y-6">
                        <h2 class="text-xl font-bold text-slate-900 tracking-tight border-b border-slate-100 pb-4">
                            Informasi Kontak Sekretariat
                        </h2>

                        <!-- Alamat -->
                        <div class="flex items-start gap-4">
                            <div class="w-11 h-11 rounded-xl bg-[#0BB5CB]/10 text-[#028DA9] flex items-center justify-center shrink-0">
                                <i data-feather="map-pin" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400">Alamat Kantor</h3>
                                <p class="text-sm font-semibold text-slate-800 mt-1 leading-relaxed">
                                    {{ $address }}
                                </p>
                            </div>
                        </div>

                        <!-- Jam Operasional -->
                        <div class="flex items-start gap-4">
                            <div class="w-11 h-11 rounded-xl bg-[#0BB5CB]/10 text-[#028DA9] flex items-center justify-center shrink-0">
                                <i data-feather="clock" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400">Jam Layanan</h3>
                                <p class="text-sm font-semibold text-slate-800 mt-1">
                                    {{ $operatingHours }}
                                </p>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="flex items-start gap-4">
                            <div class="w-11 h-11 rounded-xl bg-[#0BB5CB]/10 text-[#028DA9] flex items-center justify-center shrink-0">
                                <i data-feather="mail" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400">Email Resmi</h3>
                                <a href="mailto:{{ $email }}" class="text-sm font-semibold text-[#028DA9] hover:underline mt-1 inline-block">
                                    {{ $email }}
                                </a>
                            </div>
                        </div>

                        <!-- Telepon -->
                        <div class="flex items-start gap-4">
                            <div class="w-11 h-11 rounded-xl bg-[#0BB5CB]/10 text-[#028DA9] flex items-center justify-center shrink-0">
                                <i data-feather="phone" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400">Telepon / Fax</h3>
                                <a href="tel:{{ $phone }}" class="text-sm font-semibold text-slate-800 hover:text-[#028DA9] mt-1 inline-block">
                                    {{ $phone }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Social Media Card -->
                    <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs">
                        <h2 class="text-base font-bold text-slate-900 tracking-tight mb-4">
                            Kanal Media Sosial
                        </h2>
                        <div class="flex items-center gap-3">
                            <a href="{{ $instagram }}" target="_blank" rel="noopener noreferrer"
                                class="flex-1 p-3 rounded-xl bg-slate-50 border border-slate-200/80 hover:bg-[#0BB5CB] hover:text-white hover:border-[#0BB5CB] transition-all text-center flex flex-col items-center gap-1.5 group">
                                <i data-feather="instagram" class="w-5 h-5 text-slate-600 group-hover:text-white"></i>
                                <span class="text-2xs font-bold text-slate-700 group-hover:text-white">Instagram</span>
                            </a>
                            <a href="{{ $youtube }}" target="_blank" rel="noopener noreferrer"
                                class="flex-1 p-3 rounded-xl bg-slate-50 border border-slate-200/80 hover:bg-[#0BB5CB] hover:text-white hover:border-[#0BB5CB] transition-all text-center flex flex-col items-center gap-1.5 group">
                                <i data-feather="youtube" class="w-5 h-5 text-slate-600 group-hover:text-white"></i>
                                <span class="text-2xs font-bold text-slate-700 group-hover:text-white">YouTube</span>
                            </a>
                            <a href="{{ $facebook }}" target="_blank" rel="noopener noreferrer"
                                class="flex-1 p-3 rounded-xl bg-slate-50 border border-slate-200/80 hover:bg-[#0BB5CB] hover:text-white hover:border-[#0BB5CB] transition-all text-center flex flex-col items-center gap-1.5 group">
                                <i data-feather="facebook" class="w-5 h-5 text-slate-600 group-hover:text-white"></i>
                                <span class="text-2xs font-bold text-slate-700 group-hover:text-white">Facebook</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Google Maps Embed Container (7 cols) -->
                <div class="lg:col-span-7">
                    <div class="bg-white rounded-3xl border border-slate-200/80 p-4 sm:p-6 shadow-xs h-full flex flex-col">
                        <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-4">
                            <div>
                                <h2 class="text-lg font-bold text-slate-900 tracking-tight">Lokasi Kampus</h2>
                                <p class="text-xs text-slate-500">Direktorat Poltekkes Kemenkes Medan</p>
                            </div>
                            <span class="px-3 py-1 rounded-full bg-slate-100 text-slate-600 text-xs font-semibold">
                                Medan Tuntungan
                            </span>
                        </div>

                        <div class="relative w-full flex-1 min-h-[380px] rounded-2xl overflow-hidden border border-slate-200">
                            @if(str_contains($mapsEmbed, '<iframe'))
                                {!! $mapsEmbed !!}
                            @else
                                <iframe src="{{ $mapsEmbed }}"
                                    width="100%"
                                    height="100%"
                                    style="border:0; min-height: 380px;"
                                    allowfullscreen=""
                                    loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"
                                    class="w-full h-full rounded-xl">
                                </iframe>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Accordion Section -->
    <section class="py-16 sm:py-20 bg-white border-t border-slate-200/80 reveal-on-scroll">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-frontend.section-heading
                badge="Informasi Umum"
                title="Pertanyaan yang Sering Diajukan (FAQ)"
                description="Jawaban atas pertanyaan umum seputar siklus SPMI, dokumen mutu, audit internal, dan tata kelola penjaminan mutu di Poltekkes Kemenkes Medan."
                align="center" />

            <div class="space-y-4" id="faq-accordion">
                <!-- FAQ Item 1 -->
                <div class="faq-item rounded-2xl border border-slate-200/80 overflow-hidden transition-all duration-200">
                    <button type="button"
                        class="faq-trigger w-full px-6 py-4 text-left font-bold text-slate-900 bg-slate-50/60 hover:bg-slate-100/70 flex items-center justify-between gap-4 transition-colors cursor-pointer">
                        <span class="text-sm sm:text-base">Apa itu siklus PPEPP dalam penjaminan mutu Poltekkes Kemenkes Medan?</span>
                        <i data-feather="chevron-down" class="w-5 h-5 text-slate-400 shrink-0 transition-transform duration-200"></i>
                    </button>
                    <div class="faq-content hidden px-6 py-4 text-sm text-slate-600 leading-relaxed bg-white border-t border-slate-100">
                        Siklus PPEPP adalah prinsip tata kelola SPMI nasional yang terdiri dari 5 tahapan utama: <strong>Penetapan</strong> standar mutu, <strong>Pelaksanaan</strong> standar, <strong>Evaluasi</strong> pelaksanaan standar (melalui Audit Mutu Internal), <strong>Pengendalian</strong> deviasi standar (melalui Rapat Tinjauan Manajemen), dan <strong>Peningkatan</strong> standar mutu secara berkelanjutan (Continuous Quality Improvement).
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="faq-item rounded-2xl border border-slate-200/80 overflow-hidden transition-all duration-200">
                    <button type="button"
                        class="faq-trigger w-full px-6 py-4 text-left font-bold text-slate-900 bg-slate-50/60 hover:bg-slate-100/70 flex items-center justify-between gap-4 transition-colors cursor-pointer">
                        <span class="text-sm sm:text-base">Bagaimana cara mengunduh berkas Kebijakan, Manual, Standar, dan SOP?</span>
                        <i data-feather="chevron-down" class="w-5 h-5 text-slate-400 shrink-0 transition-transform duration-200"></i>
                    </button>
                    <div class="faq-content hidden px-6 py-4 text-sm text-slate-600 leading-relaxed bg-white border-t border-slate-100">
                        Seluruh civitas akademika dapat mengakses menu <strong>Dokumen & SOP</strong> pada bilah navigasi atas. Anda dapat memfilter berkas berdasarkan kategori dan tahun, atau melakukan pencarian langsung berdasarkan nama atau kode dokumen. Setiap dokumen dilengkapi tombol pratinjau langsung dan tombol unduh PDF resmi.
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="faq-item rounded-2xl border border-slate-200/80 overflow-hidden transition-all duration-200">
                    <button type="button"
                        class="faq-trigger w-full px-6 py-4 text-left font-bold text-slate-900 bg-slate-50/60 hover:bg-slate-100/70 flex items-center justify-between gap-4 transition-colors cursor-pointer">
                        <span class="text-sm sm:text-base">Kapan Audit Mutu Internal (AMI) dilaksanakan?</span>
                        <i data-feather="chevron-down" class="w-5 h-5 text-slate-400 shrink-0 transition-transform duration-200"></i>
                    </button>
                    <div class="faq-content hidden px-6 py-4 text-sm text-slate-600 leading-relaxed bg-white border-t border-slate-100">
                        Audit Mutu Internal (AMI) akademik dan non-akademik di Poltekkes Kemenkes Medan diselenggarakan secara berkala setiap tahun (biasanya per semester atau tahunan) oleh auditor mutu internal bersertifikat untuk memastikan kepatuhan program studi dan unit kerja terhadap Standar Nasional Pendidikan Tinggi (SN-Dikti) dan standar institusi.
                    </div>
                </div>

                <!-- FAQ Item 4 -->
                <div class="faq-item rounded-2xl border border-slate-200/80 overflow-hidden transition-all duration-200">
                    <button type="button"
                        class="faq-trigger w-full px-6 py-4 text-left font-bold text-slate-900 bg-slate-50/60 hover:bg-slate-100/70 flex items-center justify-between gap-4 transition-colors cursor-pointer">
                        <span class="text-sm sm:text-base">Bagaimana unit kerja dapat berkonsultasi mengenai akreditasi LAM-PTKes atau BAN-PT?</span>
                        <i data-feather="chevron-down" class="w-5 h-5 text-slate-400 shrink-0 transition-transform duration-200"></i>
                    </button>
                    <div class="faq-content hidden px-6 py-4 text-sm text-slate-600 leading-relaxed bg-white border-t border-slate-100">
                        Unit pengelola program studi dapat berkoordinasi langsung dengan Sekretariat PPM melalui kontak email resmi di <code>mutu@poltekkes-medan.ac.id</code> atau mengunjungi kantor PPM pada jam kerja operasional. PPM menyediakan pendampingan penyusunan Laporan Evaluasi Diri (LED) dan instrumen akreditasi.
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
