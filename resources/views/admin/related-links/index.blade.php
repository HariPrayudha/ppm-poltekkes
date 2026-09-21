@extends('layouts.admin', ['title' => 'Kelola Link Terkait'])

@section('content')
<x-admin.page-header
    title="Link & Aplikasi Terkait"
    description="Kelola tautan portal internal/eksternal dan institusi mitra yang tampil pada website.">
    <x-slot:actions>
        <x-admin.btn-primary data-modal-open="modal-create-link">
            <i data-feather="plus" class="h-4 w-4"></i>
            Tambah Link Terkait
        </x-admin.btn-primary>
    </x-slot:actions>
</x-admin.page-header>

<x-admin.card>
    <div class="overflow-x-auto -mx-6 -my-6">
        <table class="min-w-full divide-y divide-slate-100">
            <thead class="bg-slate-50/75">
                <tr>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Logo</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Nama Institusi</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">URL Tujuan</th>
                    <th class="px-6 py-3.5 text-center text-xs font-semibold uppercase tracking-wider text-slate-500">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 bg-white">
                @forelse($links as $link)
                <tr class="hover:bg-slate-50/60 transition-colors">
                    <td class="px-6 py-4">
                        @if($link->logo_url)
                        <div class="group relative h-12 w-24 overflow-hidden rounded-xl border border-slate-200 bg-slate-100 shadow-xs cursor-pointer"
                            data-preview-image="{{ $link->logo_url }}"
                            data-preview-title="Logo {{ $link->name }}"
                            title="Klik untuk memperbesar logo">
                            <img src="{{ $link->logo_url }}" alt="{{ $link->name }}" class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105">
                            <div class="absolute inset-0 bg-slate-950/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center pointer-events-none">
                                <i data-feather="zoom-in" class="h-4 w-4 text-white drop-shadow-md"></i>
                            </div>
                        </div>
                        @else
                        <div class="flex h-12 w-24 items-center justify-center rounded-xl border border-slate-200 bg-slate-50 shadow-xs text-slate-400">
                            <i data-feather="link-2" class="h-5 w-5"></i>
                        </div>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-sm font-bold text-slate-900">{{ $link->name }}</p>
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ $link->url }}" target="_blank" class="inline-flex items-center gap-1 text-xs text-[#028DA9] hover:underline">
                            <span class="truncate max-w-xs">{{ $link->url }}</span>
                            <i data-feather="external-link" class="h-3 w-3 shrink-0"></i>
                        </a>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <button
                                type="button"
                                class="btn-icon btn-icon-lime btn-edit-link rounded-xl p-2 transition-all duration-200 shadow-2xs hover:shadow-xs active:scale-95 cursor-pointer"
                                title="Edit Link"
                                data-action="{{ route('admin.related-links.update', $link) }}"
                                data-link="{{ json_encode([
                                            'id' => $link->id,
                                            'name' => $link->name,
                                            'url' => $link->url,
                                            'logo_url' => $link->logo_url,
                                        ]) }}">
                                <i data-feather="edit-2" class="h-4 w-4"></i>
                            </button>

                            <button
                                type="button"
                                class="btn-icon btn-icon-danger rounded-xl p-2 transition-all duration-200 shadow-2xs hover:shadow-xs active:scale-95 cursor-pointer"
                                title="Hapus Link"
                                onclick="confirmDelete('delete-link-{{ $link->id }}', 'link {{ addslashes($link->name) }}')">
                                <i data-feather="trash-2" class="h-4 w-4"></i>
                            </button>

                            <form id="delete-link-{{ $link->id }}" method="POST" action="{{ route('admin.related-links.destroy', $link) }}" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <x-admin.empty-state
                    colspan="4"
                    message="Belum ada link terkait."
                    description="Tambahkan link ke institusi atau aplikasi internal lain." />
                @endforelse
            </tbody>
        </table>
    </div>

    @if($links->hasPages())
    <div class="border-t border-slate-100 px-6 py-4">
        {{ $links->links() }}
    </div>
    @endif
</x-admin.card>
@endsection

@section('modals')
<!-- Modal Tambah Link -->
<x-admin.modal id="modal-create-link" title="Tambah Link Terkait">
    <form method="POST" action="{{ route('admin.related-links.store') }}" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label for="create-logo" class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-1.5">
                Logo Institusi / Aplikasi (Opsional)
            </label>
            <input
                type="file"
                name="logo"
                id="create-logo"
                accept="image/png,image/jpeg,image/webp,image/svg+xml"
                class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[rgba(11,181,203,0.1)] file:text-[#028DA9] hover:file:bg-[rgba(11,181,203,0.2)] file:cursor-pointer">
            <p class="mt-1 text-[11px] text-slate-400">Format: PNG, SVG, WEBP, atau JPG. Maks 2MB.</p>
            <div id="create-link-preview" class="hidden mt-2"></div>
        </div>

        <x-admin.form-input
            name="name"
            label="Nama Institusi / Aplikasi"
            placeholder="Contoh: Kemenkes RI atau SIPENMARU"
            required />

        <x-admin.form-input
            name="url"
            label="URL Tujuan"
            placeholder="https://..."
            required />

        <div class="flex flex-col-reverse sm:flex-row items-stretch sm:items-center justify-end gap-2.5 pt-4 border-t border-slate-100 [&>*]:w-full sm:[&>*]:w-auto">
            <x-admin.btn-secondary data-modal-close>Batal</x-admin.btn-secondary>
            <x-admin.btn-primary type="submit">Simpan Link</x-admin.btn-primary>
        </div>
    </form>
</x-admin.modal>

<!-- Modal Edit Link -->
<x-admin.modal id="modal-edit-link" title="Edit Link Terkait">
    <form id="form-edit-link" method="POST" action="" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div id="edit-link-preview" class="hidden"></div>

        <div>
            <label for="edit-logo" class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-1.5">
                Ganti Logo (Biarkan kosong jika tidak diubah)
            </label>
            <input
                type="file"
                name="logo"
                id="edit-logo"
                accept="image/png,image/jpeg,image/webp,image/svg+xml"
                class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[rgba(11,181,203,0.1)] file:text-[#028DA9] hover:file:bg-[rgba(11,181,203,0.2)] file:cursor-pointer">
        </div>

        <x-admin.form-input
            name="name"
            label="Nama Institusi / Aplikasi"
            required />

        <x-admin.form-input
            name="url"
            label="URL Tujuan"
            required />

        <div class="flex flex-col-reverse sm:flex-row items-stretch sm:items-center justify-end gap-2.5 pt-4 border-t border-slate-100 [&>*]:w-full sm:[&>*]:w-auto">
            <x-admin.btn-secondary data-modal-close>Batal</x-admin.btn-secondary>
            <x-admin.btn-primary type="submit">Perbarui Link</x-admin.btn-primary>
        </div>
    </form>
</x-admin.modal>
@endsection

@push('scripts')
<script src="{{ asset('dashboard/assets/js/related-links.js') }}"></script>
@endpush