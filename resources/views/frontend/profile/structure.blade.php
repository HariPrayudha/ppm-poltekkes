@extends('layouts.frontend')

@section('title', 'Struktur Organisasi')

@section('content')
    <!-- Header Banner Institusi -->
    <div class="bg-linear-to-b from-slate-900 via-slate-900 to-slate-800 text-white py-14 sm:py-18 border-b border-slate-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-[#0BB5CB]/20 border border-[#0BB5CB]/40 text-[#0BB5CB] text-xs font-semibold uppercase tracking-wider mb-4">
                <i data-feather="users" class="w-3.5 h-3.5"></i>
                Profil Institusi
            </div>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight">
                Struktur Organisasi Pusat Penjaminan Mutu
            </h1>
            <p class="mt-4 text-slate-300 text-sm sm:text-base max-w-2xl mx-auto leading-relaxed">
                Bagan garis instruksi, koordinasi, dan tata kelola penjaminan mutu pendidikan di lingkungan Poltekkes Kemenkes Medan.
            </p>
        </div>
    </div>

    <!-- Main Content: Bagan Struktur Organisasi -->
    <section class="py-12 sm:py-16 bg-slate-50 min-h-[500px] reveal-on-scroll">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-10 shadow-xs">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-100 mb-8">
                    <div>
                        <h2 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight">
                            Bagan Visual Struktur Organisasi
                        </h2>
                        <p class="text-xs sm:text-sm text-slate-500 mt-1">
                            Klik pada gambar atau gunakan tombol perbesar untuk melihat bagan dalam resolusi tinggi.
                        </p>
                    </div>

                    @if($profile && $profile->org_chart_path)
                        <button type="button"
                            class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-[#0BB5CB]/10 text-[#028DA9] hover:bg-[#0BB5CB] hover:text-white text-xs font-semibold transition-all duration-200 cursor-pointer lightbox-trigger self-start sm:self-auto shadow-2xs"
                            data-image="{{ $profile->org_chart_url }}"
                            data-title="Bagan Struktur Organisasi PPM Poltekkes Kemenkes Medan">
                            <i data-feather="maximize-2" class="w-4 h-4"></i>
                            <span>Perbesar Gambar</span>
                        </button>
                    @endif
                </div>

                @if($profile && $profile->org_chart_path)
                    <div class="relative group rounded-2xl overflow-hidden border border-slate-200/80 bg-slate-50 flex items-center justify-center p-4 sm:p-8 cursor-pointer lightbox-trigger"
                        data-image="{{ $profile->org_chart_url }}"
                        data-title="Bagan Struktur Organisasi PPM Poltekkes Kemenkes Medan">
                        <img src="{{ $profile->org_chart_url }}"
                            alt="Bagan Struktur Organisasi PPM Poltekkes Kemenkes Medan"
                            class="max-h-[650px] w-auto max-w-full object-contain transition-transform duration-300 group-hover:scale-101" />

                        <div class="absolute inset-0 bg-slate-950/20 opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex items-center justify-center">
                            <span class="px-4 py-2 rounded-xl bg-white/95 text-slate-900 text-xs font-bold shadow-lg flex items-center gap-1.5">
                                <i data-feather="zoom-in" class="w-4 h-4 text-[#028DA9]"></i>
                                Klik untuk memperbesar bagan
                            </span>
                        </div>
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center py-20 text-slate-400 bg-slate-50/80 rounded-2xl border border-dashed border-slate-300">
                        <i data-feather="image" class="w-12 h-12 text-slate-300 mb-3"></i>
                        <p class="text-sm font-medium">Bagan struktur organisasi belum diunggah.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection

@section('modals')
    <x-frontend.lightbox-modal />
@endsection
