@extends('layouts.frontend')

@section('title', 'Dokumen & Standar Mutu SPMI')

@section('content')
    <!-- Institutional Header Banner (Light & Professional, Aligned with Gallery and Contact) -->
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
                <span class="text-[#028DA9] font-bold">Dokumen & SOP</span>
            </nav>

            <div>
                <h1 class="text-xl sm:text-3xl lg:text-4xl font-black text-slate-900 tracking-tight">
                    Repositori Dokumen Mutu & SOP
                </h1>
                <p class="mt-2 text-xs sm:text-sm text-slate-600 max-w-2xl leading-relaxed">
                    Pusat unduhan dan pratinjau resmi instrumen Sistem Penjaminan Mutu Internal (SPMI) Poltekkes Kemenkes Medan mencakup Kebijakan Mutu, Manual Mutu, Standar Mutu, Prosedur Operasional Standar (SOP), dan Formulir.
                </p>
            </div>
        </div>
    </div>

    <!-- Repository Content Area -->
    <section class="pt-4 pb-10 sm:pt-7 sm:pb-16 bg-slate-50/60 min-h-[600px] reveal-on-scroll">
        <div class="max-w-7xl mx-auto px-3.5 sm:px-6 lg:px-8">
            <!-- Modern Filter Bar Card -->
            <div class="bg-white rounded-2xl sm:rounded-3xl border border-slate-200/80 p-4 sm:p-6 shadow-xs mb-5 sm:mb-8 transition-shadow duration-200">
                <!-- Grid Filters: Search (5 cols), Category (4 cols), Year (3 cols) -->
                <div class="grid grid-cols-1 sm:grid-cols-12 gap-3 sm:gap-4 items-center">
                    <!-- 1. Search Input (sm:col-span-12 lg:col-span-5) -->
                    <div class="sm:col-span-12 lg:col-span-5">
                        <label for="doc-search-input" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5 select-none">
                            Pencarian Dokumen
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <i data-feather="search" class="w-4 h-4"></i>
                            </div>
                            <input type="text"
                                id="doc-search-input"
                                value="{{ request('search') }}"
                                placeholder="Cari kode atau nama dokumen mutu..."
                                class="w-full pl-10 pr-9 py-2.5 sm:py-3 rounded-2xl border border-slate-200/90 text-xs sm:text-sm placeholder-slate-400 text-slate-900 bg-white focus:outline-hidden focus:border-[#0BB5CB] focus:ring-4 focus:ring-[#0BB5CB]/10 transition-all shadow-2xs hover:border-slate-300" />
                            <button type="button"
                                id="doc-search-clear"
                                class="hidden absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600 transition-colors cursor-pointer"
                                title="Hapus pencarian">
                                <i data-feather="x" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </div>

                    <!-- 2. Category Custom Dropdown (sm:col-span-6 lg:col-span-4) -->
                    <div class="sm:col-span-6 lg:col-span-4">
                        <x-frontend.form-select
                            id="doc-category-select"
                            name="category_id"
                            label="Kategori SPMI"
                            icon="folder"
                            placeholder="Semua Kategori">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </x-frontend.form-select>
                    </div>

                    <!-- 3. Year Custom Dropdown (sm:col-span-6 lg:col-span-3) -->
                    <div class="sm:col-span-6 lg:col-span-3">
                        <x-frontend.form-select
                            id="doc-year-select"
                            name="year"
                            label="Tahun Terbit"
                            icon="calendar"
                            placeholder="Semua Tahun">
                            <option value="">Semua Tahun</option>
                            @foreach($years as $yr)
                                <option value="{{ $yr }}" {{ request('year') == $yr ? 'selected' : '' }}>
                                    Tahun {{ $yr }}
                                </option>
                            @endforeach
                        </x-frontend.form-select>
                    </div>
                </div>

                <!-- Active Filters Row (Appears dynamically when filters are active) -->
                <div id="active-filters-row" class="hidden pt-3.5 mt-3.5 border-t border-slate-100 flex flex-wrap items-center justify-between gap-3">
                    <div class="flex flex-wrap items-center gap-2" id="active-filter-tags">
                        <span class="text-xs font-semibold text-slate-400">Filter Aktif:</span>
                        <!-- Dynamically populated tags via JS -->
                    </div>
                    <button type="button"
                        id="btn-reset-filters"
                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-bold text-rose-600 hover:bg-rose-50 border border-rose-200/80 transition-all duration-200 cursor-pointer shadow-2xs">
                        <i data-feather="rotate-ccw" class="w-3.5 h-3.5"></i>
                        <span>Reset Semua Filter</span>
                    </button>
                </div>
            </div>

            <!-- Documents Table & Cards Container (Loaded & Updated via AJAX) -->
            <div id="document-table-container"
                class="bg-white rounded-2xl sm:rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden relative"
                data-fetch-url="{{ route('frontend.documents.index') }}">

                <!-- Loading Overlay -->
                <div id="doc-table-loading" class="hidden absolute inset-0 bg-white/75 backdrop-blur-2xs z-20 flex items-center justify-center">
                    <div class="flex items-center gap-3 px-5 py-3 rounded-2xl bg-white border border-slate-200/90 shadow-xl text-slate-700 text-xs sm:text-sm font-bold">
                        <div class="w-4 h-4 border-2 border-[#0BB5CB] border-t-transparent rounded-full animate-spin"></div>
                        <span>Memuat data dokumen...</span>
                    </div>
                </div>

                <!-- Table & Card Partial Body -->
                <div id="doc-table-body">
                    @include('frontend.documents._table', ['documents' => $documents])
                </div>
            </div>
        </div>
    </section>
@endsection

@section('modals')
    <x-frontend.pdf-modal />
@endsection

@push('scripts')
    <script src="{{ asset('frontend/assets/js/documents.js') }}?v={{ file_exists(public_path('frontend/assets/js/documents.js')) ? filemtime(public_path('frontend/assets/js/documents.js')) : time() }}" defer></script>
@endpush
