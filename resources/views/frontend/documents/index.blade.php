@extends('layouts.frontend')

@section('title', 'Repositori Dokumen Mutu & SPMI')

@section('content')
    <!-- Header Banner -->
    <div class="bg-linear-to-b from-slate-900 via-slate-900 to-slate-800 text-white py-16 sm:py-20 border-b border-slate-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-[#0BB5CB]/20 border border-[#0BB5CB]/40 text-[#0BB5CB] text-xs font-semibold uppercase tracking-wider mb-4">
                <i data-feather="file-text" class="w-3.5 h-3.5"></i>
                Repositori Publik
            </div>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight">
                Dokumen & SOP
            </h1>
            <p class="mt-4 text-slate-300 text-sm sm:text-base max-w-2xl mx-auto leading-relaxed">
                Pusat unduhan dan pratinjau instrumen SPMI Poltekkes Kemenkes Medan mencakup Kebijakan Mutu, Manual Mutu, Standar Mutu, Prosedur Operasional Standar (SOP), dan Formulir.
            </p>
        </div>
    </div>

    <!-- Repository Content Area -->
    <section class="py-12 sm:py-16 bg-slate-50 min-h-[600px] reveal-on-scroll">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Filter Bar Card -->
            <div class="bg-white rounded-2xl border border-slate-200/80 p-5 sm:p-6 shadow-xs mb-8 space-y-5">
                <!-- Search & Year Filters Row -->
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    <!-- Search Input -->
                    <div class="relative w-full sm:max-w-md">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i data-feather="search" class="w-4 h-4"></i>
                        </div>
                        <input type="text"
                            id="doc-search-input"
                            value="{{ request('search') }}"
                            placeholder="Cari kode atau nama dokumen mutu..."
                            class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 text-sm placeholder-slate-400 focus:outline-hidden focus:ring-2 focus:ring-[#0BB5CB] focus:border-transparent transition-all" />
                    </div>

                    <!-- Year Dropdown -->
                    <div class="flex items-center gap-2 w-full sm:w-auto">
                        <label for="doc-year-select" class="text-xs font-semibold text-slate-600 shrink-0">
                            Tahun Terbit:
                        </label>
                        <select id="doc-year-select"
                            class="w-full sm:w-36 px-3 py-2.5 rounded-xl border border-slate-200 bg-white text-sm text-slate-700 focus:outline-hidden focus:ring-2 focus:ring-[#0BB5CB] transition-all cursor-pointer">
                            <option value="">Semua Tahun</option>
                            @foreach($years as $yr)
                                <option value="{{ $yr }}" {{ request('year') == $yr ? 'selected' : '' }}>
                                    {{ $yr }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Category Pills Row -->
                <div class="pt-3 border-t border-slate-100 flex flex-wrap items-center gap-2">
                    <span class="text-xs font-semibold text-slate-500 mr-1 shrink-0">Kategori:</span>
                    <button type="button"
                        class="doc-category-pill px-3.5 py-1.5 rounded-xl text-xs font-semibold transition-all duration-200 cursor-pointer {{ !request('category_id') ? 'bg-[#0BB5CB] text-white shadow-2xs' : 'bg-slate-100 text-slate-600 hover:bg-slate-200/70' }}"
                        data-category-id="">
                        Semua Kategori
                    </button>
                    @foreach($categories as $category)
                        <button type="button"
                            class="doc-category-pill px-3.5 py-1.5 rounded-xl text-xs font-semibold transition-all duration-200 cursor-pointer {{ request('category_id') == $category->id ? 'bg-[#0BB5CB] text-white shadow-2xs' : 'bg-slate-100 text-slate-600 hover:bg-slate-200/70' }}"
                            data-category-id="{{ $category->id }}">
                            {{ $category->name }}
                            <span class="ml-1 px-1.5 py-0.5 rounded-full text-2xs {{ request('category_id') == $category->id ? 'bg-white/25 text-white' : 'bg-slate-200 text-slate-600' }}">
                                {{ $category->documents_count }}
                            </span>
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Documents Table Container (Loaded & Updated via AJAX) -->
            <div id="document-table-container"
                class="bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden relative"
                data-fetch-url="{{ route('frontend.documents.index') }}">

                <!-- Loading Overlay -->
                <div id="doc-table-loading" class="hidden absolute inset-0 bg-white/70 backdrop-blur-2xs z-10 flex items-center justify-center">
                    <div class="flex items-center gap-2 px-4 py-2 rounded-xl bg-white border border-slate-200 shadow-lg text-slate-700 text-xs font-semibold">
                        <div class="w-4 h-4 border-2 border-[#0BB5CB] border-t-transparent rounded-full animate-spin"></div>
                        <span>Memperbarui daftar dokumen...</span>
                    </div>
                </div>

                <!-- Table Partial Body -->
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
