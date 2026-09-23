@extends('layouts.frontend')

@section('title', 'Kontak Kami')

@section('content')
@php
$address = $contact?->address ?: 'Jl. Jamin Ginting KM 13,5, Kel. Lau Cih, Kec. Medan Tuntungan, Kota Medan, Sumatera Utara 20137';
$operatingHours = $contact?->operating_hours ?: 'Senin - Kamis: 07.30 - 16.00 WIB | Jumat: 07.30 - 16.30 WIB';
$email = $contact?->email ?: 'info@poltekkes-medan.ac.id';
$phone = $contact?->phone ?: '+62 811-6238-633';
$mapsUrl = $contact?->map_url ?: 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d31858.56293876502!2d98.6139837!3d3.5131805!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30312452458d243f%3A0xf9ebdd1dbf4f271a!2sPoltekkes%20Medan!5e0!3m2!1sid!2sid!4v1790091254878!5m2!1sid!2sid';
$instagram = $contact?->instagram_url ?: 'https://instagram.com/poltekkesmedan';
$youtube = $contact?->youtube_url ?: 'https://youtube.com/@poltekkeskemenkesmedanofficial';
$facebook = $contact?->facebook_url ?: 'https://facebook.com/poltekkesmedan';

$cleanPhone = preg_replace('/[^0-9]/', '', $phone);
$waUrl = 'https://wa.me/' . (str_starts_with($cleanPhone, '0') ? '62' . substr($cleanPhone, 1) : $cleanPhone);
@endphp

<!-- Luminous Institutional Page Header (Clean, Light Mode, Anti-Slop) -->
<div class="relative bg-linear-to-b from-slate-50 via-white to-slate-50/60 overflow-hidden">
    <!-- Top Signature Gradient Accent Line -->
    <div class="h-1 w-full bg-linear-to-r from-[#00A99D] via-[#0BB5CB] to-[#46B58B]"></div>

    <!-- Soft Ambient Radial Glow -->
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_60%_50%_at_50%_-10%,rgba(11,181,203,0.08),transparent)] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-7 pb-6 sm:pt-9 sm:pb-7 relative z-10">
        <!-- Breadcrumb Navigation -->
        <nav class="flex items-center gap-2 text-xs font-semibold text-slate-500 mb-3 select-none" aria-label="Breadcrumb">
            <a href="{{ route('frontend.home') }}" class="hover:text-[#028DA9] transition-colors flex items-center gap-1.5">
                <i data-feather="home" class="w-3.5 h-3.5"></i>
                <span>Beranda</span>
            </a>
            <i data-feather="chevron-right" class="w-3.5 h-3.5 text-slate-300"></i>
            <span class="text-[#028DA9] font-bold">Layanan Kontak</span>
        </nav>

        <div>
            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-black text-slate-900 tracking-tight">
                Kontak & Lokasi PPM
            </h1>
            <p class="mt-2 text-slate-600 text-xs sm:text-sm max-w-2xl leading-relaxed">
                Saluran komunikasi resmi Pusat Penjaminan Mutu Poltekkes Kemenkes Medan untuk layanan SPMI, koordinasi akreditasi program studi, dan informasi penjaminan mutu.
            </p>
        </div>
    </div>
</div>

<!-- Main Contact Details & Map Section (Equal Height Columns on Desktop) -->
<section class="pt-5 pb-12 sm:pt-7 sm:pb-16 bg-slate-50/60 reveal-on-scroll">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-stretch">
            <!-- Left Column: Secretariat Information & Social Media (5 cols) -->
            <div class="lg:col-span-5 flex flex-col gap-6">
                <!-- Card 1: Secretariat Details -->
                <div class="bg-white rounded-3xl border border-slate-200/80 p-4 sm:p-7 shadow-xs space-y-4 sm:space-y-5">
                    <div class="border-b border-slate-100 pb-3 sm:pb-3.5">
                        <h2 class="text-base sm:text-lg font-bold text-slate-900 tracking-tight">
                            Informasi Sekretariat
                        </h2>
                        <p class="text-xs text-slate-400 mt-0.5">Pusat Penjaminan Mutu Poltekkes Kemenkes Medan</p>
                    </div>

                    <!-- Alamat Fisik -->
                    <div class="flex items-start gap-3.5">
                        <div class="w-9 h-9 rounded-xl bg-linear-to-tr from-[#00A99D]/10 to-[#0BB5CB]/10 text-[#028DA9] flex items-center justify-center shrink-0 mt-0.5">
                            <i data-feather="map-pin" class="w-4.5 h-4.5"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="block text-[11px] font-bold uppercase tracking-wider text-slate-400">Alamat Kampus</span>
                            <p class="text-xs sm:text-sm font-semibold text-slate-800 leading-relaxed mt-0.5">
                                {{ $address }}
                            </p>
                        </div>
                    </div>

                    <!-- Jam Pelayanan -->
                    <div class="flex items-start gap-3.5">
                        <div class="w-9 h-9 rounded-xl bg-linear-to-tr from-[#00A99D]/10 to-[#0BB5CB]/10 text-[#028DA9] flex items-center justify-center shrink-0 mt-0.5">
                            <i data-feather="clock" class="w-4.5 h-4.5"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="block text-[11px] font-bold uppercase tracking-wider text-slate-400">Jam Operasional Layanan</span>
                            <p class="text-xs sm:text-sm font-semibold text-slate-800 leading-relaxed mt-0.5">
                                {{ $operatingHours }}
                            </p>
                        </div>
                    </div>

                    <!-- Surel Resmi -->
                    <div class="flex items-start gap-3.5">
                        <div class="w-9 h-9 rounded-xl bg-linear-to-tr from-[#00A99D]/10 to-[#0BB5CB]/10 text-[#028DA9] flex items-center justify-center shrink-0 mt-0.5">
                            <i data-feather="mail" class="w-4.5 h-4.5"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="block text-[11px] font-bold uppercase tracking-wider text-slate-400">Surel Resmi</span>
                            <a href="mailto:{{ $email }}" class="text-xs sm:text-sm font-bold text-[#028DA9] hover:text-[#00A99D] transition-colors block break-all mt-0.5">
                                {{ $email }}
                            </a>
                        </div>
                    </div>

                    <!-- Telepon / WhatsApp -->
                    <div class="flex items-start gap-3.5">
                        <div class="w-9 h-9 rounded-xl bg-linear-to-tr from-[#00A99D]/10 to-[#0BB5CB]/10 text-[#028DA9] flex items-center justify-center shrink-0 mt-0.5">
                            <i data-feather="phone" class="w-4.5 h-4.5"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="block text-[11px] font-bold uppercase tracking-wider text-slate-400">Telepon & WhatsApp</span>
                            <a href="tel:{{ $phone }}" class="text-xs sm:text-sm font-bold text-slate-800 hover:text-[#028DA9] transition-colors block mt-0.5">
                                {{ $phone }}
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Social Media (Font Awesome 6 Brands, Compact 2-Col on Mobile) -->
                <div class="bg-white rounded-3xl border border-slate-200/80 p-4 sm:p-7 shadow-xs">
                    <div class="border-b border-slate-100 pb-3 sm:pb-3.5 mb-3.5 sm:mb-4">
                        <h2 class="text-sm sm:text-lg font-bold text-slate-900 tracking-tight">
                            Media Sosial
                        </h2>
                        <p class="text-[11px] sm:text-xs text-slate-400 mt-0.5">Ikuti informasi dan pembaruan kegiatan mutu</p>
                    </div>

                    <div class="grid grid-cols-2 gap-2.5 sm:gap-3">
                        <!-- Instagram -->
                        <a href="{{ $instagram }}" target="_blank" rel="noopener noreferrer"
                            class="flex items-center gap-2 sm:gap-3 p-2.5 sm:p-3 rounded-2xl bg-slate-50/80 border border-slate-200/80 hover:border-[#0BB5CB]/60 hover:bg-linear-to-tr hover:from-[#00A99D]/10 hover:to-[#0BB5CB]/10 hover:-translate-y-0.5 hover:shadow-xs transition-all duration-200 group">
                            <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-xl bg-white border border-slate-200/90 shadow-2xs flex items-center justify-center text-slate-600 group-hover:text-pink-600 group-hover:border-pink-200 transition-colors shrink-0">
                                <i class="fa-brands fa-instagram text-sm sm:text-base"></i>
                            </div>
                            <div class="min-w-0">
                                <span class="block text-[9px] sm:text-[10px] font-bold text-slate-400 uppercase tracking-wider truncate">Instagram</span>
                                <span class="block text-[11px] sm:text-xs font-bold text-slate-800 truncate group-hover:text-[#028DA9] transition-colors">@polkesmedan</span>
                            </div>
                        </a>

                        <!-- YouTube -->
                        <a href="{{ $youtube }}" target="_blank" rel="noopener noreferrer"
                            class="flex items-center gap-2 sm:gap-3 p-2.5 sm:p-3 rounded-2xl bg-slate-50/80 border border-slate-200/80 hover:border-[#0BB5CB]/60 hover:bg-linear-to-tr hover:from-[#00A99D]/10 hover:to-[#0BB5CB]/10 hover:-translate-y-0.5 hover:shadow-xs transition-all duration-200 group">
                            <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-xl bg-white border border-slate-200/90 shadow-2xs flex items-center justify-center text-slate-600 group-hover:text-red-600 group-hover:border-red-200 transition-colors shrink-0">
                                <i class="fa-brands fa-youtube text-sm sm:text-base"></i>
                            </div>
                            <div class="min-w-0">
                                <span class="block text-[9px] sm:text-[10px] font-bold text-slate-400 uppercase tracking-wider truncate">YouTube</span>
                                <span class="block text-[11px] sm:text-xs font-bold text-slate-800 truncate group-hover:text-[#028DA9] transition-colors">Poltekkes Medan</span>
                            </div>
                        </a>

                        <!-- Facebook -->
                        <a href="{{ $facebook }}" target="_blank" rel="noopener noreferrer"
                            class="flex items-center gap-2 sm:gap-3 p-2.5 sm:p-3 rounded-2xl bg-slate-50/80 border border-slate-200/80 hover:border-[#0BB5CB]/60 hover:bg-linear-to-tr hover:from-[#00A99D]/10 hover:to-[#0BB5CB]/10 hover:-translate-y-0.5 hover:shadow-xs transition-all duration-200 group">
                            <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-xl bg-white border border-slate-200/90 shadow-2xs flex items-center justify-center text-slate-600 group-hover:text-blue-600 group-hover:border-blue-200 transition-colors shrink-0">
                                <i class="fa-brands fa-facebook-f text-xs sm:text-sm"></i>
                            </div>
                            <div class="min-w-0">
                                <span class="block text-[9px] sm:text-[10px] font-bold text-slate-400 uppercase tracking-wider truncate">Facebook</span>
                                <span class="block text-[11px] sm:text-xs font-bold text-slate-800 truncate group-hover:text-[#028DA9] transition-colors">Poltekkes Medan</span>
                            </div>
                        </a>

                        <!-- WhatsApp -->
                        <a href="{{ $waUrl }}" target="_blank" rel="noopener noreferrer"
                            class="flex items-center gap-2 sm:gap-3 p-2.5 sm:p-3 rounded-2xl bg-slate-50/80 border border-slate-200/80 hover:border-emerald-400/60 hover:bg-linear-to-tr hover:from-emerald-50/50 hover:to-[#0BB5CB]/10 hover:-translate-y-0.5 hover:shadow-xs transition-all duration-200 group">
                            <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-xl bg-white border border-slate-200/90 shadow-2xs flex items-center justify-center text-slate-600 group-hover:text-emerald-600 group-hover:border-emerald-200 transition-colors shrink-0">
                                <i class="fa-brands fa-whatsapp text-sm sm:text-base"></i>
                            </div>
                            <div class="min-w-0">
                                <span class="block text-[9px] sm:text-[10px] font-bold text-slate-400 uppercase tracking-wider truncate">WhatsApp</span>
                                <span class="block text-[11px] sm:text-xs font-bold text-slate-800 truncate group-hover:text-emerald-700 transition-colors">Layanan SPMI</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right Column: Interactive Google Maps Embed (7 cols, Full Height Match) -->
            <div class="lg:col-span-7 h-full">
                <div class="bg-white rounded-3xl border border-slate-200/80 p-4 sm:p-7 shadow-xs h-full flex flex-col justify-between">
                    <!-- Map Header -->
                    <div class="pb-3 sm:pb-3.5 border-b border-slate-100 mb-3.5 sm:mb-4 shrink-0">
                        <div class="flex items-center gap-2">
                            <h2 class="text-base sm:text-lg font-bold text-slate-900 tracking-tight">Lokasi Kampus Utama</h2>
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-bold bg-[#00A99D]/10 text-[#00A99D]">
                                Direktorat
                            </span>
                        </div>
                        <p class="text-xs text-slate-400 mt-0.5">Kelurahan Lau Cih, Kecamatan Medan Tuntungan, Kota Medan</p>
                    </div>

                    <!-- Map Embed Container (flex-1 fills the exact matching height) -->
                    <div class="relative w-full flex-1 min-h-[340px] sm:min-h-[380px] rounded-2xl overflow-hidden border border-slate-200/90 shadow-inner bg-slate-100">
                        <iframe src="{{ $mapsUrl }}"
                            width="100%"
                            height="100%"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="strict-origin-when-cross-origin"
                            class="w-full h-full absolute inset-0 border-0"
                            title="Peta Lokasi Kampus Poltekkes Kemenkes Medan">
                        </iframe>
                    </div>

                    <!-- Directions Note Footnote -->
                    <div class="mt-3.5 pt-3 border-t border-slate-100/80 flex items-center justify-between text-xs text-slate-400 shrink-0">
                        <span class="flex items-center gap-1.5 text-xs text-slate-500">
                            <i data-feather="info" class="w-3.5 h-3.5 text-[#00A99D] shrink-0"></i>
                            <span>Akses transportasi umum dan kendaraan pribadi mudah dijangkau dari Jl. Jamin Ginting.</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection