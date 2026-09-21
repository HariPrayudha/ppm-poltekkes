@extends('layouts.admin', ['title' => 'Kelola Layanan Mutu'])

@section('content')
    <x-admin.page-header
        title="Layanan Penjaminan Mutu"
        description="Kelola daftar layanan mutu yang disediakan PPM bagi civitas akademika."
    >
        <x-slot:actions>
            <x-admin.btn-primary data-modal-open="modal-create-service">
                <i data-feather="plus" class="h-4 w-4"></i>
                Tambah Layanan
            </x-admin.btn-primary>
        </x-slot:actions>
    </x-admin.page-header>

    <x-admin.card>
        <div class="overflow-x-auto -mx-6 -my-6">
            <table class="min-w-full divide-y divide-slate-100">
                <thead class="bg-slate-50/75">
                    <tr>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Ikon</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Nama Layanan & Deskripsi</th>
                        <th class="px-6 py-3.5 text-center text-xs font-semibold uppercase tracking-wider text-slate-500">Status</th>
                        <th class="px-6 py-3.5 text-center text-xs font-semibold uppercase tracking-wider text-slate-500">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse($services as $service)
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="px-6 py-4">
                                @if($service->icon_url)
                                    <div class="group relative h-12 w-12 overflow-hidden rounded-xl border border-slate-200 bg-slate-100 shadow-xs cursor-pointer"
                                         data-preview-image="{{ $service->icon_url }}"
                                         data-preview-title="Ikon {{ $service->name }}"
                                         title="Klik untuk memperbesar ikon">
                                        <img src="{{ $service->icon_url }}" alt="{{ $service->name }}" class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105">
                                        <div class="absolute inset-0 bg-slate-950/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center pointer-events-none">
                                            <i data-feather="zoom-in" class="h-4 w-4 text-white drop-shadow-md"></i>
                                        </div>
                                    </div>
                                @else
                                    <div class="flex h-12 w-12 items-center justify-center rounded-xl border border-slate-200 bg-slate-50 shadow-xs text-slate-400">
                                        <i data-feather="grid" class="h-5 w-5"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm font-bold text-slate-900">{{ $service->name }}</p>
                                @if($service->description)
                                    <p class="mt-0.5 text-xs text-slate-500 line-clamp-2 max-w-lg">{{ $service->description }}</p>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <form method="POST" action="{{ route('admin.services.toggle', $service) }}" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" title="Klik untuk mengubah status" class="cursor-pointer transition-transform hover:scale-105">
                                        <x-admin.badge :active="$service->is_active" />
                                    </button>
                                </form>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button
                                        type="button"
                                        class="btn-icon btn-icon-lime btn-edit-service rounded-xl p-2 transition-all duration-200 shadow-2xs hover:shadow-xs active:scale-95 cursor-pointer"
                                        title="Edit Layanan"
                                        data-action="{{ route('admin.services.update', $service) }}"
                                        data-service="{{ json_encode([
                                            'id' => $service->id,
                                            'name' => $service->name,
                                            'description' => $service->description,
                                            'is_active' => $service->is_active,
                                            'icon_url' => $service->icon_url,
                                        ]) }}"
                                    >
                                        <i data-feather="edit-2" class="h-4 w-4"></i>
                                    </button>

                                    <button
                                        type="button"
                                        class="btn-icon btn-icon-danger rounded-xl p-2 transition-all duration-200 shadow-2xs hover:shadow-xs active:scale-95 cursor-pointer"
                                        title="Hapus Layanan"
                                        onclick="confirmDelete('delete-service-{{ $service->id }}', 'layanan {{ addslashes($service->name) }}')"
                                    >
                                        <i data-feather="trash-2" class="h-4 w-4"></i>
                                    </button>

                                    <form id="delete-service-{{ $service->id }}" method="POST" action="{{ route('admin.services.destroy', $service) }}" class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <x-admin.empty-state
                            colspan="4"
                            message="Belum ada layanan penjaminan mutu."
                            description="Tambahkan layanan pertama Anda untuk ditampilkan di website."
                        />
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($services->hasPages())
            <div class="border-t border-slate-100 px-6 py-4">
                {{ $services->links() }}
            </div>
        @endif
    </x-admin.card>
@endsection

@section('modals')
    <!-- Modal Tambah Layanan -->
    <x-admin.modal id="modal-create-service" title="Tambah Layanan Mutu">
        <form method="POST" action="{{ route('admin.services.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label for="create-icon" class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-1.5">
                    Ikon / Ilustrasi Layanan (Opsional)
                </label>
                <input
                    type="file"
                    name="icon"
                    id="create-icon"
                    accept="image/png,image/jpeg,image/webp,image/svg+xml"
                    class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[rgba(11,181,203,0.1)] file:text-[#028DA9] hover:file:bg-[rgba(11,181,203,0.2)] file:cursor-pointer"
                >
                <p class="mt-1 text-[11px] text-slate-400">Format: PNG, SVG, WEBP, atau JPG. Maks 2MB.</p>
                <div id="create-service-preview" class="hidden mt-2"></div>
            </div>

            <x-admin.form-input
                name="name"
                label="Nama Layanan"
                placeholder="Contoh: Audit Mutu Internal (AMI)"
                required
            />

            <x-admin.form-textarea
                name="description"
                label="Deskripsi Layanan (Opsional)"
                rows="3"
                placeholder="Penjelasan ringkas mengenai lingkup layanan..."
            />

            <div class="pt-1">
                <x-admin.form-checkbox
                    name="is_active"
                    id="create_is_active"
                    label="Status Aktif"
                    description="Layanan akan langsung ditampilkan pada daftar layanan publik di website."
                    :checked="true"
                />
            </div>

            <div class="flex flex-col-reverse sm:flex-row items-stretch sm:items-center justify-end gap-2.5 pt-4 border-t border-slate-100 [&>*]:w-full sm:[&>*]:w-auto">
                <x-admin.btn-secondary data-modal-close>Batal</x-admin.btn-secondary>
                <x-admin.btn-primary type="submit">Simpan Layanan</x-admin.btn-primary>
            </div>
        </form>
    </x-admin.modal>

    <!-- Modal Edit Layanan -->
    <x-admin.modal id="modal-edit-service" title="Edit Layanan Mutu">
        <form id="form-edit-service" method="POST" action="" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div id="edit-service-preview" class="hidden"></div>

            <div>
                <label for="edit-icon" class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-1.5">
                    Ganti Ikon Layanan (Biarkan kosong jika tidak diubah)
                </label>
                <input
                    type="file"
                    name="icon"
                    id="edit-icon"
                    accept="image/png,image/jpeg,image/webp,image/svg+xml"
                    class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[rgba(11,181,203,0.1)] file:text-[#028DA9] hover:file:bg-[rgba(11,181,203,0.2)] file:cursor-pointer"
                >
            </div>

            <x-admin.form-input
                name="name"
                label="Nama Layanan"
                required
            />

            <x-admin.form-textarea
                name="description"
                label="Deskripsi Layanan (Opsional)"
                rows="3"
            />

            <div class="pt-1">
                <x-admin.form-checkbox
                    name="is_active"
                    id="edit_is_active"
                    label="Status Aktif"
                    description="Aktifkan agar layanan tetap dapat diakses publik di website."
                />
            </div>

            <div class="flex flex-col-reverse sm:flex-row items-stretch sm:items-center justify-end gap-2.5 pt-4 border-t border-slate-100 [&>*]:w-full sm:[&>*]:w-auto">
                <x-admin.btn-secondary data-modal-close>Batal</x-admin.btn-secondary>
                <x-admin.btn-primary type="submit">Perbarui Layanan</x-admin.btn-primary>
            </div>
        </form>
    </x-admin.modal>
@endsection

@push('scripts')
    <script src="{{ asset('dashboard/assets/js/services.js') }}"></script>
@endpush
