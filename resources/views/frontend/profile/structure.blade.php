@extends('layouts.frontend')

@section('title', 'Struktur Organisasi')

@section('content')
    <!-- Institutional Header Banner (Light & Professional, Aligned with Dokumen, Galeri, and Kontak) -->
    <div class="relative bg-linear-to-b from-slate-50 via-white to-slate-50/60 overflow-hidden">
        <!-- Top Signature Gradient Accent Line -->
        <div class="h-1 w-full bg-linear-to-r from-[#00A99D] via-[#0BB5CB] to-[#46B58B]"></div>

        <!-- Soft Ambient Radial Glow -->
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_60%_50%_at_50%_-10%,rgba(11,181,203,0.08),transparent)] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-7 pb-6 sm:pt-9 sm:pb-7 relative z-10">
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-2 text-xs font-semibold text-slate-500 mb-3 select-none" aria-label="Breadcrumb">
                <a href="{{ route('frontend.home') }}" class="hover:text-[#028DA9] transition-colors flex items-center gap-1.5">
                    <i data-feather="home" class="w-3.5 h-3.5"></i>
                    <span>Beranda</span>
                </a>
                <i data-feather="chevron-right" class="w-3.5 h-3.5 text-slate-300"></i>
                <span class="text-slate-500">Profil</span>
                <i data-feather="chevron-right" class="w-3.5 h-3.5 text-slate-300"></i>
                <span class="text-[#028DA9] font-bold">Struktur Organisasi</span>
            </nav>

            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-black text-slate-900 tracking-tight">
                Struktur Organisasi Pusat Penjaminan Mutu
            </h1>
            <p class="mt-2 text-xs sm:text-sm text-slate-600 max-w-2xl leading-relaxed">
                Bagan garis instruksi, koordinasi, dan tata kelola penjaminan mutu pendidikan di lingkungan Poltekkes Kemenkes Medan.
            </p>
        </div>
    </div>

    <!-- Main Content: Bagan Struktur Organisasi (2-Layer Clean Structure) -->
    <section class="pt-5 pb-12 sm:pt-7 sm:pb-16 bg-slate-50/60 min-h-[600px] reveal-on-scroll">
        <div class="max-w-7xl mx-auto px-3.5 sm:px-6 lg:px-8">
            @if($profile && $profile->org_chart_path)
                <!-- Layer 2: Clean Card directly housing the image without extra inner containers -->
                <div class="relative group bg-white rounded-2xl sm:rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden flex items-center justify-center p-2.5 sm:p-5 cursor-pointer hover:border-[#0BB5CB]/50 transition-colors duration-200"
                    data-preview-image="{{ $profile->org_chart_url }}"
                    data-preview-title="Bagan Struktur Organisasi PPM Poltekkes Kemenkes Medan"
                    title="Klik untuk memperbesar bagan">

                    <img src="{{ $profile->org_chart_url }}"
                        alt="Bagan Struktur Organisasi PPM Poltekkes Kemenkes Medan"
                        class="w-full h-auto max-h-[800px] object-contain rounded-xl transition-transform duration-300 group-hover:scale-[1.004]" />

                    <!-- Floating Action Button (Top Right) -->
                    <div class="absolute top-3 right-3 sm:top-5 sm:right-5 z-10">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 sm:px-3.5 sm:py-2 rounded-xl bg-white/95 backdrop-blur-md border border-slate-200/90 text-slate-700 text-xs font-bold shadow-xs group-hover:border-[#0BB5CB]/40 group-hover:text-[#028DA9] transition-all">
                            <i data-feather="maximize-2" class="w-3.5 h-3.5 text-[#0BB5CB]"></i>
                            <span>Perbesar</span>
                        </span>
                    </div>

                    <!-- Floating Hover Zoom Overlay -->
                    <div class="absolute inset-0 bg-slate-950/15 backdrop-blur-[1px] opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex items-center justify-center pointer-events-none">
                        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white/95 text-slate-900 text-xs font-bold shadow-xl border border-slate-200/80">
                            <i data-feather="zoom-in" class="w-4 h-4 text-[#028DA9]"></i>
                            <span>Klik untuk Memperbesar (Zoom & Pan)</span>
                        </span>
                    </div>
                </div>
            @else
                <div class="bg-white rounded-2xl sm:rounded-3xl border border-slate-200/80 shadow-xs p-8 sm:p-16 flex flex-col items-center justify-center text-center">
                    <div class="w-14 h-14 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center border border-slate-200/80 mb-3 shadow-2xs">
                        <i data-feather="image" class="w-7 h-7 text-slate-400"></i>
                    </div>
                    <p class="text-sm font-bold text-slate-800">Bagan Struktur Belum Tersedia</p>
                    <p class="text-xs text-slate-500 max-w-sm mt-1 leading-relaxed">
                        Bagan visual struktur organisasi PPM Poltekkes Kemenkes Medan saat ini sedang dalam proses pembaruan administrasi.
                    </p>
                </div>
            @endif
        </div>
    </section>
@endsection
