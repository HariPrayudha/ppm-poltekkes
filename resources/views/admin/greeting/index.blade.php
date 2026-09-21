@extends('layouts.admin', ['title' => 'Sambutan Kepala PPM'])

@section('content')
    <x-admin.page-header
        title="Sambutan Kepala PPM"
        description="Atur foto pimpinan, biodata, dan pesan sambutan resmi untuk halaman depan."
    />

    <form method="POST" action="{{ route('admin.greeting.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left: Foto Pimpinan & Info (1 col) -->
            <div class="space-y-6">
                <x-admin.card title="Foto Pimpinan">
                    <div class="flex flex-col items-center text-center">
                        <div class="relative h-44 w-44 overflow-hidden rounded-2xl border-2 border-dashed border-slate-200 bg-slate-50 flex items-center justify-center mb-4">
                            <img
                                id="photo-preview-img"
                                src="{{ $greeting->photo_url ?: 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&q=80&w=400' }}"
                                alt="{{ $greeting->name }}"
                                class="h-full w-full object-cover"
                            >
                        </div>

                        <label for="photo-input" class="btn-secondary cursor-pointer text-xs mb-1">
                            <i data-feather="upload" class="h-3.5 w-3.5"></i>
                            Pilih Foto Pimpinan
                        </label>
                        <input
                            type="file"
                            name="photo"
                            id="photo-input"
                            accept="image/png,image/jpeg,image/webp"
                            class="hidden"
                        >
                        <p class="text-[11px] text-slate-400 mt-1">Rekomendasi rasio 1:1 atau 3:4. Maks 2MB.</p>
                        @error('photo')
                            <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="border-t border-slate-100 mt-6 pt-5 space-y-4">
                        <x-admin.form-input
                            name="name"
                            label="Nama Lengkap & Gelar"
                            :value="$greeting->name"
                            placeholder="Contoh: Dr. Hj. Siti Aminah, M.Kes"
                            required
                        />

                        <x-admin.form-input
                            name="position"
                            label="Jabatan / Identitas"
                            :value="$greeting->position"
                            placeholder="Contoh: Kepala Pusat Penjaminan Mutu"
                            required
                        />
                    </div>
                </x-admin.card>
            </div>

            <!-- Right: Rich Text Sambutan (2 cols) -->
            <div class="lg:col-span-2 space-y-6">
                <x-admin.card title="Teks Sambutan Resmi">
                    <div>
                        <label for="content" class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-2">
                            Isi Sambutan <span class="text-rose-500">*</span>
                        </label>
                        <textarea
                            name="content"
                            id="content"
                            rows="10"
                            class="w-full rounded-xl border border-slate-200"
                        >{{ old('content', $greeting->content) }}</textarea>
                        @error('content')
                            <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-6 flex items-center justify-end gap-3 pt-5 border-t border-slate-100">
                        <x-admin.btn-primary type="submit">
                            <i data-feather="check" class="h-4 w-4"></i>
                            Simpan Perubahan Sambutan
                        </x-admin.btn-primary>
                    </div>
                </x-admin.card>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <!-- TinyMCE CDN -->
    <script src="https://cdn.jsdelivr.net/npm/tinymce@6.8.3/tinymce.min.js"></script>
    <script src="{{ asset('dashboard/assets/js/greeting.js') }}"></script>
@endpush
