@extends('layouts.frontend')

@section('title', 'Profil dan Struktur Organisasi')

@section('content')
    <!-- Header Banner -->
    <div class="bg-linear-to-b from-slate-900 via-slate-900 to-slate-800 text-white py-16 sm:py-20 border-b border-slate-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-[#0BB5CB]/20 border border-[#0BB5CB]/40 text-[#0BB5CB] text-xs font-semibold uppercase tracking-wider mb-4">
                <i data-feather="users" class="w-3.5 h-3.5"></i>
                Profil Organisasi
            </div>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight">
                Struktur Organisasi dan Tugas Pokok Fungsi
            </h1>
            <p class="mt-4 text-slate-300 text-sm sm:text-base max-w-2xl mx-auto leading-relaxed">
                Tata kelola penjaminan mutu internal Pusat Penjaminan Mutu Politeknik Kesehatan Kementerian Kesehatan Medan dalam mewujudkan tata pamong yang akuntabel dan kredibel.
            </p>
        </div>
    </div>

    <!-- Main Content Section -->
    <section class="py-14 sm:py-20 bg-slate-50 min-h-[500px]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Profile Navigation Tabs -->
            <div class="flex items-center justify-center mb-10">
                <div class="inline-flex p-1.5 rounded-2xl bg-white border border-slate-200/80 shadow-xs" role="tablist">
                    <button type="button"
                        id="tab-btn-structure"
                        role="tab"
                        aria-selected="true"
                        class="profile-tab-btn px-6 py-2.5 rounded-xl text-xs sm:text-sm font-bold transition-all duration-200 bg-[#0BB5CB] text-white shadow-xs cursor-pointer flex items-center gap-2"
                        data-tab-target="tab-structure">
                        <i data-feather="git-commit" class="w-4 h-4"></i>
                        <span>Struktur Organisasi</span>
                    </button>
                    <button type="button"
                        id="tab-btn-duties"
                        role="tab"
                        aria-selected="false"
                        class="profile-tab-btn px-6 py-2.5 rounded-xl text-xs sm:text-sm font-semibold text-slate-600 hover:text-slate-900 transition-all duration-200 cursor-pointer flex items-center gap-2"
                        data-tab-target="tab-duties">
                        <i data-feather="clipboard" class="w-4 h-4"></i>
                        <span>Tugas Pokok dan Fungsi</span>
                    </button>
                </div>
            </div>

            <!-- Tab 1: Struktur Organisasi -->
            <div id="tab-structure" class="profile-tab-content">
                <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-10 shadow-xs">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-100 mb-8">
                        <div>
                            <h3 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight">
                                Bagan Struktur Organisasi PPM
                            </h3>
                            <p class="text-xs sm:text-sm text-slate-500 mt-1">
                                Garis instruksi dan koordinasi penjaminan mutu di lingkungan Poltekkes Kemenkes Medan.
                            </p>
                        </div>

                        @if($profile && $profile->org_chart_path)
                            <button type="button"
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-100 hover:bg-[#0BB5CB] hover:text-white text-slate-700 text-xs font-semibold transition-all duration-200 cursor-pointer lightbox-trigger self-start sm:self-auto shadow-2xs"
                                data-image="{{ $profile->org_chart_url }}"
                                data-title="Bagan Struktur Organisasi PPM Poltekkes Kemenkes Medan">
                                <i data-feather="maximize-2" class="w-4 h-4"></i>
                                <span>Perbesar Gambar</span>
                            </button>
                        @endif
                    </div>

                    @if($profile && $profile->org_chart_path)
                        <div class="relative group rounded-2xl overflow-hidden border border-slate-200/70 bg-slate-50 flex items-center justify-center p-4 sm:p-8 cursor-pointer lightbox-trigger"
                            data-image="{{ $profile->org_chart_url }}"
                            data-title="Bagan Struktur Organisasi PPM Poltekkes Kemenkes Medan">
                            <img src="{{ $profile->org_chart_url }}"
                                alt="Bagan Struktur Organisasi PPM"
                                class="max-h-[600px] w-auto max-w-full object-contain transition-transform duration-300 group-hover:scale-101" />

                            <div class="absolute inset-0 bg-slate-950/20 opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex items-center justify-center">
                                <span class="px-4 py-2 rounded-xl bg-white/95 text-slate-900 text-xs font-bold shadow-lg flex items-center gap-1.5">
                                    <i data-feather="zoom-in" class="w-4 h-4 text-[#028DA9]"></i>
                                    Klik untuk memperbesar
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

            <!-- Tab 2: Tugas Pokok & Fungsi (Tupoksi) -->
            <div id="tab-duties" class="profile-tab-content hidden">
                <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-12 shadow-xs">
                    <div class="pb-6 border-b border-slate-100 mb-8">
                        <h3 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight">
                            Tugas Pokok dan Fungsi (Tupoksi)
                        </h3>
                        <p class="text-xs sm:text-sm text-slate-500 mt-1">
                            Uraian wewenang, tanggung jawab, dan ruang lingkup kerja Pusat Penjaminan Mutu.
                        </p>
                    </div>

                    @if($profile && $profile->duties_content)
                        <div class="prose prose-slate max-w-none text-slate-700 leading-relaxed space-y-4">
                            {!! $profile->duties_content !!}
                        </div>
                    @else
                        <div class="flex flex-col items-center justify-center py-20 text-slate-400 bg-slate-50/80 rounded-2xl border border-dashed border-slate-300">
                            <i data-feather="file-text" class="w-12 h-12 text-slate-300 mb-3"></i>
                            <p class="text-sm font-medium">Uraian tugas pokok dan fungsi belum diperbarui.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

@section('modals')
    <x-frontend.lightbox-modal />
@endsection
