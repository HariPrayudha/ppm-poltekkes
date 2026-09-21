@extends('layouts.admin', ['title' => 'Kelola Dokumen SPMI & SOP'])

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

    <!-- Filters & Search Bar -->
    <x-admin.card class="mb-6">
        <form method="GET" action="{{ route('admin.documents.index') }}" class="grid grid-cols-1 sm:grid-cols-12 gap-3 items-center">
            <!-- Search Keyword -->
            <div class="sm:col-span-5">
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                        <i data-feather="search" class="h-4 w-4"></i>
                    </div>
                    <input
                        type="text"
                        name="search"
                        value="{{ $search }}"
                        placeholder="Cari kode atau nama dokumen..."
                        class="w-full rounded-xl border border-slate-200 bg-slate-50/50 pl-9 pr-4 py-2 text-sm text-slate-900 placeholder:text-slate-400 focus:border-[#0BB5CB] focus:bg-white focus:outline-none focus:ring-4 focus:ring-[#0BB5CB]/10"
                    >
                </div>
            </div>

            <!-- Filter Kategori -->
            <div class="sm:col-span-3">
                <select
                    name="category_id"
                    class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3 py-2 text-sm text-slate-900 focus:border-[#0BB5CB] focus:bg-white focus:outline-none focus:ring-4 focus:ring-[#0BB5CB]/10"
                >
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $categoryId == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Filter Tahun -->
            <div class="sm:col-span-2">
                <select
                    name="year"
                    class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3 py-2 text-sm text-slate-900 focus:border-[#0BB5CB] focus:bg-white focus:outline-none focus:ring-4 focus:ring-[#0BB5CB]/10"
                >
                    <option value="">Semua Tahun</option>
                    @foreach($availableYears as $yr)
                        <option value="{{ $yr }}" {{ $year == $yr ? 'selected' : '' }}>{{ $yr }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Actions -->
            <div class="sm:col-span-2 flex items-center gap-2">
                <button type="submit" class="btn-primary w-full py-2 text-xs">
                    <i data-feather="filter" class="h-3.5 w-3.5"></i>
                    Filter
                </button>
                @if($search || $categoryId || $year)
                    <a href="{{ route('admin.documents.index') }}" class="btn-icon p-2 border border-slate-200 text-slate-500 hover:text-slate-800" title="Reset Filter">
                        <i data-feather="rotate-ccw" class="h-4 w-4"></i>
                    </a>
                @endif
            </div>
        </form>
    </x-admin.card>

    <!-- Documents Table -->
    <x-admin.card>
        <div class="overflow-x-auto -mx-6 -my-6">
            <table class="min-w-full divide-y divide-slate-100">
                <thead class="bg-slate-50/75">
                    <tr>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Kode & Nama Dokumen</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Kategori</th>
                        <th class="px-6 py-3.5 text-center text-xs font-semibold uppercase tracking-wider text-slate-500">Tahun</th>
                        <th class="px-6 py-3.5 text-center text-xs font-semibold uppercase tracking-wider text-slate-500">Ukuran</th>
                        <th class="px-6 py-3.5 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse($documents as $doc)
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="px-6 py-4">
                                <span class="inline-block font-mono text-xs font-bold text-[#028DA9] bg-[rgba(11,181,203,0.08)] px-2 py-0.5 rounded-md mb-1">
                                    {{ $doc->code }}
                                </span>
                                <p class="text-sm font-semibold text-slate-900 leading-snug line-clamp-2">{{ $doc->name }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-lg bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-700">
                                    {{ $doc->category?->name ?? 'Umum' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-xs font-bold text-slate-700 font-mono">{{ $doc->year }}</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-xs text-slate-500">{{ $doc->formatted_file_size }}</span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    <!-- PDF Preview Button -->
                                    <button
                                        type="button"
                                        class="btn-icon btn-preview-pdf text-[#028DA9] hover:bg-cyan-50"
                                        title="Pratinjau PDF"
                                        data-file-url="{{ $doc->file_url }}"
                                        data-doc-title="{{ $doc->code }} - {{ $doc->name }}"
                                    >
                                        <i data-feather="eye" class="h-4 w-4"></i>
                                    </button>

                                    <!-- Download Button -->
                                    <a
                                        href="{{ $doc->file_url }}"
                                        download
                                        target="_blank"
                                        class="btn-icon text-emerald-600 hover:bg-emerald-50"
                                        title="Unduh File"
                                    >
                                        <i data-feather="download" class="h-4 w-4"></i>
                                    </a>

                                    <!-- Edit Button -->
                                    <button
                                        type="button"
                                        class="btn-icon btn-edit-document text-amber-600 hover:bg-amber-50"
                                        title="Edit Dokumen"
                                        data-action="{{ route('admin.documents.update', $doc) }}"
                                        data-document="{{ json_encode([
                                            'id' => $doc->id,
                                            'document_category_id' => $doc->document_category_id,
                                            'code' => $doc->code,
                                            'name' => $doc->name,
                                            'year' => $doc->year,
                                        ]) }}"
                                    >
                                        <i data-feather="edit-2" class="h-4 w-4"></i>
                                    </button>

                                    <!-- Delete Button -->
                                    <button
                                        type="button"
                                        class="btn-icon text-rose-600 hover:bg-rose-50"
                                        title="Hapus Dokumen"
                                        onclick="confirmDelete('delete-doc-{{ $doc->id }}', 'dokumen {{ addslashes($doc->name) }}')"
                                    >
                                        <i data-feather="trash-2" class="h-4 w-4"></i>
                                    </button>

                                    <form id="delete-doc-{{ $doc->id }}" method="POST" action="{{ route('admin.documents.destroy', $doc) }}" class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <x-admin.empty-state
                            colspan="5"
                            message="Tidak ada dokumen mutu yang cocok."
                            description="Gunakan kata kunci lain atau unggah dokumen SPMI baru."
                        />
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($documents->hasPages())
            <div class="border-t border-slate-100 px-6 py-4">
                {{ $documents->links() }}
            </div>
        @endif
    </x-admin.card>
@endsection

@section('modals')
    <!-- Modal Tambah Dokumen -->
    <x-admin.modal id="modal-create-document" title="Unggah Dokumen Mutu Baru">
        <form method="POST" action="{{ route('admin.documents.store') }}" enctype="multipart/form-data" class="space-y-4">
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
            </div>

            <x-admin.form-select name="document_category_id" label="Kategori Dokumen" required>
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
                    <x-admin.form-input
                        name="year"
                        label="Tahun Terbit"
                        type="number"
                        value="{{ date('Y') }}"
                        required
                    />
                </div>
            </div>

            <x-admin.form-input
                name="name"
                label="Nama / Judul Dokumen"
                placeholder="Contoh: Prosedur Pelaksanaan Audit Mutu Internal"
                required
            />

            <div class="flex items-center justify-end gap-2.5 pt-4 border-t border-slate-100">
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
            </div>

            <x-admin.form-select name="document_category_id" label="Kategori Dokumen" required>
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
                    <x-admin.form-input
                        name="year"
                        label="Tahun Terbit"
                        type="number"
                        required
                    />
                </div>
            </div>

            <x-admin.form-input
                name="name"
                label="Nama / Judul Dokumen"
                required
            />

            <div class="flex items-center justify-end gap-2.5 pt-4 border-t border-slate-100">
                <x-admin.btn-secondary data-modal-close>Batal</x-admin.btn-secondary>
                <x-admin.btn-primary type="submit">Perbarui Dokumen</x-admin.btn-primary>
            </div>
        </form>
    </x-admin.modal>

    <!-- Modal Pratinjau PDF -->
    <x-admin.modal id="modal-preview-pdf" title="Pratinjau Dokumen PDF" maxWidth="max-w-4xl">
        <div class="space-y-3">
            <p id="pdf-preview-title" class="text-sm font-semibold text-slate-700"></p>
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-slate-100">
                <iframe id="pdf-preview-frame" src="" class="h-150 w-full border-0"></iframe>
            </div>
        </div>
        <x-slot:footer>
            <x-admin.btn-secondary data-modal-close>Tutup Pratinjau</x-admin.btn-secondary>
        </x-slot:footer>
    </x-admin.modal>
@endsection

@push('scripts')
    <script src="{{ asset('dashboard/assets/js/documents.js') }}"></script>
@endpush
