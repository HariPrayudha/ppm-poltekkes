@extends('layouts.admin', ['title' => 'Kelola Hero Banner'])

@section('content')
    <x-admin.page-header
        title="Hero Banner Beranda"
        description="Kelola spanduk utama yang tampil pada halaman depan website (diurutkan otomatis dari yang terbaru)."
    >
        <x-slot:actions>
            <x-admin.btn-primary data-modal-open="modal-create-banner">
                <i data-feather="plus" class="h-4 w-4"></i>
                Tambah Banner
            </x-admin.btn-primary>
        </x-slot:actions>
    </x-admin.page-header>

    <x-admin.card>
        <div class="overflow-x-auto -mx-6 -my-6">
            <table class="min-w-full divide-y divide-slate-100">
                <thead class="bg-slate-50/75">
                    <tr>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Banner</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Judul & CTA</th>
                        <th class="px-6 py-3.5 text-center text-xs font-semibold uppercase tracking-wider text-slate-500">Status</th>
                        <th class="px-6 py-3.5 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse($banners as $banner)
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="px-6 py-4">
                                <div class="relative h-16 w-28 overflow-hidden rounded-xl border border-slate-200 bg-slate-100 shadow-xs">
                                    <img src="{{ $banner->image_url }}" alt="{{ $banner->title }}" class="h-full w-full object-cover">
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm font-bold text-slate-900 line-clamp-1">{{ $banner->title }}</p>
                                @if($banner->description)
                                    <p class="mt-0.5 text-xs text-slate-500 line-clamp-1">{{ $banner->description }}</p>
                                @endif
                                @if($banner->cta_label)
                                    <div class="mt-1.5 flex items-center gap-1.5 text-xs text-[#028DA9]">
                                        <i data-feather="link" class="h-3 w-3"></i>
                                        <span class="font-medium">{{ $banner->cta_label }}</span>
                                        @if($banner->cta_url)
                                            <span class="text-slate-400">({{ Str::limit($banner->cta_url, 30) }})</span>
                                        @endif
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <form method="POST" action="{{ route('admin.banners.toggle', $banner) }}" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" title="Klik untuk mengubah status" class="cursor-pointer transition-transform hover:scale-105">
                                        <x-admin.badge :active="$banner->is_active" />
                                    </button>
                                </form>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    <!-- Edit Button -->
                                    <button
                                        type="button"
                                        class="btn-icon btn-edit-banner text-amber-600 hover:bg-amber-50"
                                        title="Edit Banner"
                                        data-action="{{ route('admin.banners.update', $banner) }}"
                                        data-banner="{{ json_encode([
                                            'id' => $banner->id,
                                            'title' => $banner->title,
                                            'description' => $banner->description,
                                            'cta_label' => $banner->cta_label,
                                            'cta_url' => $banner->cta_url,
                                            'is_active' => $banner->is_active,
                                            'image_url' => $banner->image_url,
                                        ]) }}"
                                    >
                                        <i data-feather="edit-2" class="h-4 w-4"></i>
                                    </button>

                                    <!-- Delete Button -->
                                    <button
                                        type="button"
                                        class="btn-icon text-rose-600 hover:bg-rose-50"
                                        title="Hapus Banner"
                                        onclick="confirmDelete('delete-banner-{{ $banner->id }}', 'banner {{ addslashes($banner->title) }}')"
                                    >
                                        <i data-feather="trash-2" class="h-4 w-4"></i>
                                    </button>

                                    <form id="delete-banner-{{ $banner->id }}" method="POST" action="{{ route('admin.banners.destroy', $banner) }}" class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <x-admin.empty-state
                            colspan="4"
                            message="Belum ada hero banner."
                            description="Tambahkan banner pertama Anda untuk mempercantik beranda website."
                        />
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($banners->hasPages())
            <div class="border-t border-slate-100 px-6 py-4">
                {{ $banners->links() }}
            </div>
        @endif
    </x-admin.card>
@endsection

@section('modals')
    <!-- Modal Tambah Banner -->
    <x-admin.modal id="modal-create-banner" title="Tambah Hero Banner Baru">
        <form method="POST" action="{{ route('admin.banners.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label for="create-image" class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-1.5">
                    File Gambar Banner <span class="text-rose-500">*</span>
                </label>
                <input
                    type="file"
                    name="image"
                    id="create-image"
                    required
                    accept="image/png,image/jpeg,image/webp"
                    class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[rgba(11,181,203,0.1)] file:text-[#028DA9] hover:file:bg-[rgba(11,181,203,0.2)] file:cursor-pointer"
                >
                <p class="mt-1 text-[11px] text-slate-400">Rekomendasi rasio 16:9 atau lebar minimal 1400px. Maks 2MB.</p>
            </div>

            <x-admin.form-input
                name="title"
                label="Judul Banner"
                placeholder="Contoh: Pusat Penjaminan Mutu Terpercaya"
                required
            />

            <x-admin.form-textarea
                name="description"
                label="Deskripsi / Subjudul (Opsional)"
                rows="2"
                placeholder="Deskripsi singkat yang menjelaskan banner..."
            />

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <x-admin.form-input
                    name="cta_label"
                    label="Teks Tombol CTA (Opsional)"
                    placeholder="Contoh: Lihat Dokumen SPMI"
                />

                <x-admin.form-input
                    name="cta_url"
                    label="URL Tombol CTA (Opsional)"
                    placeholder="https://..."
                />
            </div>

            <div class="pt-2">
                <label class="flex items-center gap-2.5 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" checked class="h-4 w-4 rounded border-slate-300 text-[#0BB5CB] focus:ring-[#0BB5CB]">
                    <span class="text-sm font-semibold text-slate-700">Tayangkan langsung</span>
                </label>
            </div>

            <div class="flex items-center justify-end gap-2.5 pt-4 border-t border-slate-100">
                <x-admin.btn-secondary data-modal-close>Batal</x-admin.btn-secondary>
                <x-admin.btn-primary type="submit">Simpan Banner</x-admin.btn-primary>
            </div>
        </form>
    </x-admin.modal>

    <!-- Modal Edit Banner -->
    <x-admin.modal id="modal-edit-banner" title="Edit Hero Banner">
        <form id="form-edit-banner" method="POST" action="" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div id="edit-banner-preview" class="hidden"></div>

            <div>
                <label for="edit-image" class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-1.5">
                    Ganti Gambar Banner (Biarkan kosong jika tidak diubah)
                </label>
                <input
                    type="file"
                    name="image"
                    id="edit-image"
                    accept="image/png,image/jpeg,image/webp"
                    class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[rgba(11,181,203,0.1)] file:text-[#028DA9] hover:file:bg-[rgba(11,181,203,0.2)] file:cursor-pointer"
                >
                <p class="mt-1 text-[11px] text-slate-400">Format: JPG, PNG, WEBP. Maks 2MB.</p>
            </div>

            <x-admin.form-input
                name="title"
                label="Judul Banner"
                required
            />

            <x-admin.form-textarea
                name="description"
                label="Deskripsi / Subjudul (Opsional)"
                rows="2"
            />

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <x-admin.form-input
                    name="cta_label"
                    label="Teks Tombol CTA (Opsional)"
                />

                <x-admin.form-input
                    name="cta_url"
                    label="URL Tombol CTA (Opsional)"
                />
            </div>

            <div class="pt-2">
                <label class="flex items-center gap-2.5 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" class="h-4 w-4 rounded border-slate-300 text-[#0BB5CB] focus:ring-[#0BB5CB]">
                    <span class="text-sm font-semibold text-slate-700">Status Tayang Aktif</span>
                </label>
            </div>

            <div class="flex items-center justify-end gap-2.5 pt-4 border-t border-slate-100">
                <x-admin.btn-secondary data-modal-close>Batal</x-admin.btn-secondary>
                <x-admin.btn-primary type="submit">Perbarui Banner</x-admin.btn-primary>
            </div>
        </form>
    </x-admin.modal>
@endsection

@push('scripts')
    <script src="{{ asset('dashboard/assets/js/banners.js') }}"></script>
@endpush
