@extends('layouts.admin', ['title' => 'Galeri Kegiatan'])

@section('content')
    <x-admin.page-header
        title="Galeri Kegiatan PPM"
        description="Kelola dokumentasi visual agenda kerja, pelatihan, workshop, dan audit mutu internal."
    >
        <x-slot:actions>
            <x-admin.btn-primary data-modal-open="modal-create-gallery">
                <i data-feather="plus" class="h-4 w-4"></i>
                Tambah Foto Kegiatan
            </x-admin.btn-primary>
        </x-slot:actions>
    </x-admin.page-header>

    @if($galleries->isEmpty())
        <x-admin.card>
            <x-admin.empty-state
                message="Belum ada foto kegiatan di galeri."
                description="Unggah foto kegiatan atau agenda SPMI pertama Anda."
            />
        </x-admin.card>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($galleries as $item)
                <div class="group flex flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition-all hover:shadow-md hover:border-slate-300">
                    <!-- Photo Image -->
                    <div class="relative aspect-video w-full overflow-hidden bg-slate-100 cursor-pointer group/photo"
                         data-preview-image="{{ $item->image_url }}"
                         data-preview-title="{{ $item->title }}"
                         title="Klik untuk memperbesar foto">
                        <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="h-full w-full object-cover transition-transform duration-300 group-hover/photo:scale-105">
                        <div class="absolute inset-0 bg-slate-950/20 opacity-0 group-hover/photo:opacity-100 transition-opacity flex items-center justify-center pointer-events-none">
                            <i data-feather="zoom-in" class="h-6 w-6 text-white drop-shadow-md"></i>
                        </div>
                        <div class="absolute bottom-2 left-2 rounded-lg bg-black/60 backdrop-blur-xs px-2.5 py-1 text-[11px] font-semibold text-white pointer-events-none">
                            {{ $item->event_date ? $item->event_date->isoFormat('D MMMM Y') : '' }}
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="flex flex-1 flex-col p-4">
                        <h4 class="text-sm font-bold text-slate-900 line-clamp-1 group-hover:text-[#028DA9] transition-colors">
                            {{ $item->title }}
                        </h4>
                        @if($item->description)
                            <p class="mt-1 text-xs text-slate-500 line-clamp-2 leading-relaxed flex-1">
                                {{ $item->description }}
                            </p>
                        @endif

                        <!-- Action Buttons -->
                        <div class="mt-4 flex items-center justify-end gap-1.5 border-t border-slate-100 pt-3">
                            <button
                                type="button"
                                class="btn-icon btn-icon-lime btn-edit-gallery rounded-xl p-2 transition-all duration-200 shadow-2xs hover:shadow-xs active:scale-95 cursor-pointer"
                                title="Edit Foto"
                                data-action="{{ route('admin.gallery.update', $item) }}"
                                data-gallery="{{ json_encode([
                                    'id' => $item->id,
                                    'title' => $item->title,
                                    'event_date' => $item->event_date ? $item->event_date->format('Y-m-d') : '',
                                    'description' => $item->description,
                                    'image_url' => $item->image_url,
                                ]) }}"
                            >
                                <i data-feather="edit-2" class="h-4 w-4"></i>
                            </button>

                            <button
                                type="button"
                                class="btn-icon btn-icon-danger rounded-xl p-2 transition-all duration-200 shadow-2xs hover:shadow-xs active:scale-95 cursor-pointer"
                                title="Hapus Foto"
                                onclick="confirmDelete('delete-gallery-{{ $item->id }}', 'kegiatan {{ addslashes($item->title) }}')"
                            >
                                <i data-feather="trash-2" class="h-4 w-4"></i>
                            </button>

                            <form id="delete-gallery-{{ $item->id }}" method="POST" action="{{ route('admin.gallery.destroy', $item) }}" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if($galleries->hasPages())
            <div class="mt-8">
                {{ $galleries->links() }}
            </div>
        @endif
    @endif
@endsection

@section('modals')
    <!-- Modal Tambah Galeri -->
    <x-admin.modal id="modal-create-gallery" title="Unggah Foto Kegiatan">
        <form method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label for="create-gallery-img" class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-1.5">
                    File Foto Kegiatan <span class="text-rose-500">*</span>
                </label>
                <input
                    type="file"
                    name="image"
                    id="create-gallery-img"
                    required
                    accept="image/png,image/jpeg,image/webp"
                    class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[rgba(11,181,203,0.1)] file:text-[#028DA9] hover:file:bg-[rgba(11,181,203,0.2)] file:cursor-pointer"
                >
                <p class="mt-1 text-[11px] text-slate-400">Format: JPG, JPEG, PNG, WEBP. Maks 2MB.</p>
            </div>

            <x-admin.form-input
                name="title"
                label="Judul Agenda / Kegiatan"
                placeholder="Contoh: Rapat Tinjauan Manajemen (RTM) Tahun 2026"
                required
            />

            <x-admin.form-input
                name="event_date"
                label="Tanggal Pelaksanaan"
                type="date"
                value="{{ date('Y-m-d') }}"
                required
            />

            <x-admin.form-textarea
                name="description"
                label="Deskripsi Singkat Kegiatan (Opsional)"
                rows="3"
                placeholder="Penjelasan ringkas mengenai agenda kegiatan..."
            />

            <div class="flex items-center justify-end gap-2.5 pt-4 border-t border-slate-100">
                <x-admin.btn-secondary data-modal-close>Batal</x-admin.btn-secondary>
                <x-admin.btn-primary type="submit">Simpan Foto</x-admin.btn-primary>
            </div>
        </form>
    </x-admin.modal>

    <!-- Modal Edit Galeri -->
    <x-admin.modal id="modal-edit-gallery" title="Edit Data Foto Kegiatan">
        <form id="form-edit-gallery" method="POST" action="" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div id="edit-gallery-preview" class="hidden"></div>

            <div>
                <label for="edit-gallery-img" class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-1.5">
                    Ganti Foto (Biarkan kosong jika tidak diubah)
                </label>
                <input
                    type="file"
                    name="image"
                    id="edit-gallery-img"
                    accept="image/png,image/jpeg,image/webp"
                    class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[rgba(11,181,203,0.1)] file:text-[#028DA9] hover:file:bg-[rgba(11,181,203,0.2)] file:cursor-pointer"
                >
            </div>

            <x-admin.form-input
                name="title"
                label="Judul Agenda / Kegiatan"
                required
            />

            <x-admin.form-input
                name="event_date"
                label="Tanggal Pelaksanaan"
                type="date"
                required
            />

            <x-admin.form-textarea
                name="description"
                label="Deskripsi Singkat Kegiatan (Opsional)"
                rows="3"
            />

            <div class="flex items-center justify-end gap-2.5 pt-4 border-t border-slate-100">
                <x-admin.btn-secondary data-modal-close>Batal</x-admin.btn-secondary>
                <x-admin.btn-primary type="submit">Perbarui Foto</x-admin.btn-primary>
            </div>
        </form>
    </x-admin.modal>
@endsection

@push('scripts')
    <script src="{{ asset('dashboard/assets/js/gallery.js') }}"></script>
@endpush
