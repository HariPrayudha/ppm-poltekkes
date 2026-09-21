@extends('layouts.admin', ['title' => 'Struktur & Tugas Fungsi'])

@section('content')
    <x-admin.page-header
        title="Profil SPMI: Struktur & Tugas Fungsi"
        description="Kelola bagan struktur organisasi penjaminan mutu dan rincian tugas pokok serta fungsi (Tupoksi)."
    />

    <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="space-y-8">
            <!-- Section 1: Bagan Struktur Organisasi -->
            <x-admin.card
                title="Bagan Struktur Organisasi"
                description="Unggah diagram bagan struktur tata kelola Pusat Penjaminan Mutu."
            >
                <div class="space-y-4">
                    <div id="chart-preview-container" class="{{ $profile->org_chart_url ? '' : 'hidden' }} mb-4">
                        <p class="text-xs font-semibold text-slate-500 mb-2">Bagan Saat Ini:</p>
                        <div class="relative overflow-hidden rounded-2xl border border-slate-200 bg-slate-50 p-2 max-w-2xl">
                            <img
                                id="chart-preview-img"
                                src="{{ $profile->org_chart_url ?: '' }}"
                                alt="Bagan Organisasi PPM"
                                class="w-full max-h-96 object-contain rounded-xl"
                            >
                        </div>
                    </div>

                    <div>
                        <label for="chart-input" class="btn-secondary cursor-pointer text-xs mb-1">
                            <i data-feather="upload" class="h-3.5 w-3.5"></i>
                            Pilih File Gambar Bagan
                        </label>
                        <input
                            type="file"
                            name="org_chart"
                            id="chart-input"
                            accept="image/png,image/jpeg,image/webp"
                            class="hidden"
                        >
                        <p class="text-[11px] text-slate-400 mt-1">Format gambar: JPG, PNG, WEBP. Maksimal 4MB (disarankan resolusi tinggi agar bagan terbaca jelas).</p>
                        @error('org_chart')
                            <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </x-admin.card>

            <!-- Section 2: Tugas Pokok & Fungsi (Tupoksi) -->
            <x-admin.card
                title="Tugas Pokok & Fungsi (Tupoksi)"
                description="Deskripsikan rincian tugas pokok, kewenangan, dan fungsi SPMI."
            >
                <div>
                    <label for="duties_content" class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-2">
                        Rincian Tupoksi
                    </label>
                    <textarea
                        name="duties_content"
                        id="duties_content"
                        rows="12"
                        class="w-full rounded-xl border border-slate-200"
                    >{{ old('duties_content', $profile->duties_content) }}</textarea>
                    @error('duties_content')
                        <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6 flex items-center justify-end gap-3 pt-5 border-t border-slate-100">
                    <x-admin.btn-primary type="submit">
                        <i data-feather="check" class="h-4 w-4"></i>
                        Simpan Perubahan Profil & Tupoksi
                    </x-admin.btn-primary>
                </div>
            </x-admin.card>
        </div>
    </form>
@endsection

@push('scripts')
    <!-- TinyMCE CDN -->
    <script src="https://cdn.jsdelivr.net/npm/tinymce@6.8.3/tinymce.min.js"></script>
    <script src="{{ asset('dashboard/assets/js/profile.js') }}"></script>
@endpush
