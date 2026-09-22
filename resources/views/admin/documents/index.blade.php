@extends('layouts.admin', ['title' => 'Kelola Dokumen SPMI & SOP'])

@php
    $currentYear = (int) date('Y');
    $yearsRange = range($currentYear + 5, $currentYear - 5);
@endphp

@section('content')
    <x-admin.page-header
        title="Dokumen SPMI & SOP Mutu"
        description="Kelola dan publikasikan dokumen kebijakan, manual, standar, SOP, dan formulir penjaminan mutu."
    >
        <x-slot:actions>
            <x-admin.btn-secondary href="{{ route('admin.document-categories.index') }}">
                <i data-feather="folder" class="h-4 w-4"></i>
                Kelola Kategori
            </x-admin.btn-secondary>
            <x-admin.btn-primary data-modal-open="modal-create-document">
                <i data-feather="upload" class="h-4 w-4"></i>
                Unggah Dokumen
            </x-admin.btn-primary>
        </x-slot:actions>
    </x-admin.page-header>

    <!-- Filters & Search Bar (Auto-Update via jQuery) -->
    <x-admin.card class="mb-6 relative z-30" :overflow="true">
        <form id="filter-form" method="GET" action="{{ route('admin.documents.index') }}" class="grid grid-cols-1 sm:grid-cols-12 gap-3 items-center">
            <!-- Search Keyword with Debounce Auto-Submit -->
            <div class="{{ ($search || $categoryId || $year) ? 'sm:col-span-5' : 'sm:col-span-5' }}">
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                        <i data-feather="search" class="h-4 w-4"></i>
                    </div>
                    <input
                        type="text"
                        name="search"
                        id="filter-search-input"
                        value="{{ $search }}"
                        placeholder="Cari kode atau nama dokumen..."
                        class="w-full rounded-xl border border-slate-200 bg-white pl-10 pr-4 py-2.5 text-sm text-slate-900 placeholder:text-slate-400 shadow-2xs hover:border-slate-300 focus:border-[#0BB5CB] focus:bg-white focus:outline-none focus:ring-4 focus:ring-[#0BB5CB]/10 transition-all"
                    >
                </div>
            </div>

            <!-- Filter Kategori (Custom Select) -->
            <div class="sm:col-span-4">
                <x-admin.form-select name="category_id" id="filter-category">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $categoryId == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </x-admin.form-select>
            </div>

            <!-- Filter Tahun (Custom Select) -->
            <div class="{{ ($search || $categoryId || $year) ? 'sm:col-span-2' : 'sm:col-span-3' }}">
                <x-admin.form-select name="year" id="filter-year">
                    <option value="">Semua Tahun</option>
                    @foreach($availableYears as $yr)
                        <option value="{{ $yr }}" {{ $year == $yr ? 'selected' : '' }}>{{ $yr }}</option>
                    @endforeach
                </x-admin.form-select>
            </div>

            <!-- Reset Filter Action Button -->
            <div id="reset-filter-wrapper" class="sm:col-span-1 flex items-center justify-end {{ ($search || $categoryId || $year) ? '' : 'hidden' }}">
                <button type="button" id="btn-reset-filter" class="btn-icon p-2.5 border border-slate-200 bg-white text-slate-500 hover:text-slate-800 rounded-xl hover:bg-slate-50 transition-colors shadow-2xs cursor-pointer" title="Reset Filter">
                    <i data-feather="rotate-ccw" class="h-4 w-4"></i>
                </button>
            </div>
        </form>
    </x-admin.card>

    <!-- Documents Table Container (AJAX Target) -->
    <div id="documents-table-container" class="relative z-10 transition-opacity duration-200">
        @include('admin.documents._table')
    </div>
@endsection

@section('modals')
    <!-- Modal Tambah Dokumen -->
    <x-admin.modal id="modal-create-document" title="Unggah Dokumen Mutu Baru">
        <form id="form-create-document" method="POST" action="{{ route('admin.documents.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label for="create-doc-file" class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-1.5">
                    File PDF Dokumen <span class="text-rose-500">*</span>
                </label>
                <input
                    type="file"
                    name="file"
                    id="create-doc-file"
                    required
                    accept="application/pdf"
                    class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[rgba(11,181,203,0.1)] file:text-[#028DA9] hover:file:bg-[rgba(11,181,203,0.2)] file:cursor-pointer"
                >
                <p class="mt-1 text-[11px] text-slate-400">Format: Dokumen PDF resmi. Maksimal 5MB.</p>
                <div id="create-pdf-preview" class="hidden mt-2.5"></div>
            </div>

            <x-admin.form-select name="document_category_id" id="create-category-id" label="Kategori Dokumen" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </x-admin.form-select>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="sm:col-span-2">
                    <x-admin.form-input
                        name="code"
                        label="Kode Dokumen"
                        placeholder="Contoh: SOP/PPM/01/2026"
                        required
                    />
                </div>
                <div>
                    <x-admin.form-select name="year" id="create-year" label="Tahun Terbit" required>
                        @foreach($yearsRange as $yr)
                            <option value="{{ $yr }}" {{ $yr == $currentYear ? 'selected' : '' }}>
                                {{ $yr }}
                            </option>
                        @endforeach
                    </x-admin.form-select>
                </div>
            </div>

            <x-admin.form-input
                name="name"
                label="Nama / Judul Dokumen"
                placeholder="Contoh: Prosedur Pelaksanaan Audit Mutu Internal"
                required
            />

            <div class="flex flex-col-reverse sm:flex-row items-stretch sm:items-center justify-end gap-2.5 pt-4 border-t border-slate-100 [&>*]:w-full sm:[&>*]:w-auto">
                <x-admin.btn-secondary data-modal-close>Batal</x-admin.btn-secondary>
                <x-admin.btn-primary type="submit">Unggah & Simpan</x-admin.btn-primary>
            </div>
        </form>
    </x-admin.modal>

    <!-- Modal Edit Dokumen -->
    <x-admin.modal id="modal-edit-document" title="Edit Data Dokumen Mutu">
        <form id="form-edit-document" method="POST" action="" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Existing File Preview Container -->
            <div id="edit-existing-pdf-preview" class="hidden"></div>

            <div>
                <label for="edit-doc-file" class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-1.5">
                    Ganti File PDF (Biarkan kosong jika tidak ingin mengubah file)
                </label>
                <input
                    type="file"
                    name="file"
                    id="edit-doc-file"
                    accept="application/pdf"
                    class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[rgba(11,181,203,0.1)] file:text-[#028DA9] hover:file:bg-[rgba(11,181,203,0.2)] file:cursor-pointer"
                >
                <div id="edit-new-pdf-preview" class="hidden mt-2.5"></div>
            </div>

            <x-admin.form-select name="document_category_id" id="edit-category-id" label="Kategori Dokumen" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </x-admin.form-select>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="sm:col-span-2">
                    <x-admin.form-input
                        name="code"
                        label="Kode Dokumen"
                        required
                    />
                </div>
                <div>
                    <x-admin.form-select name="year" id="edit-year" label="Tahun Terbit" required>
                        @foreach($yearsRange as $yr)
                            <option value="{{ $yr }}">
                                {{ $yr }}
                            </option>
                        @endforeach
                    </x-admin.form-select>
                </div>
            </div>

            <x-admin.form-input
                name="name"
                label="Nama / Judul Dokumen"
                required
            />

            <div class="flex flex-col-reverse sm:flex-row items-stretch sm:items-center justify-end gap-2.5 pt-4 border-t border-slate-100 [&>*]:w-full sm:[&>*]:w-auto">
                <x-admin.btn-secondary data-modal-close>Batal</x-admin.btn-secondary>
                <x-admin.btn-primary type="submit">Perbarui Dokumen</x-admin.btn-primary>
            </div>
        </form>
    </x-admin.modal>
@endsection

@push('scripts')
    <script src="{{ asset('dashboard/assets/js/documents.js') }}?v={{ file_exists(public_path('dashboard/assets/js/documents.js')) ? filemtime(public_path('dashboard/assets/js/documents.js')) : time() }}"></script>
@endpush
