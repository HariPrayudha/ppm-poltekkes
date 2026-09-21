@extends('layouts.admin', ['title' => 'Kategori Dokumen Mutu'])

@section('content')
    <x-admin.page-header
        title="Kategori Dokumen SPMI"
        description="Kelola kelompok standar penjaminan mutu (contoh: Kebijakan, Manual, Standar, SOP, Formulir)."
    >
        <x-slot:actions>
            <x-admin.btn-secondary href="{{ route('admin.documents.index') }}">
                <i data-feather="arrow-left" class="h-4 w-4"></i>
                Kembali ke Dokumen
            </x-admin.btn-secondary>
            <x-admin.btn-primary data-modal-open="modal-create-category">
                <i data-feather="plus" class="h-4 w-4"></i>
                Tambah Kategori
            </x-admin.btn-primary>
        </x-slot:actions>
    </x-admin.page-header>

    <x-admin.card>
        <div class="overflow-x-auto -mx-6 -my-6">
            <table class="min-w-full divide-y divide-slate-100">
                <thead class="bg-slate-50/75">
                    <tr>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Nama Kategori</th>
                        <th class="px-6 py-3.5 text-center text-xs font-semibold uppercase tracking-wider text-slate-500">Jumlah Dokumen</th>
                        <th class="px-6 py-3.5 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse($categories as $cat)
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="px-6 py-4">
                                <span class="text-sm font-bold text-slate-900">{{ $cat->name }}</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center rounded-full bg-[rgba(11,181,203,0.1)] px-2.5 py-0.5 text-xs font-bold text-[#028DA9]">
                                    {{ $cat->documents_count }} Dokumen
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    <button
                                        type="button"
                                        class="btn-icon btn-edit-category text-amber-600 hover:bg-amber-50"
                                        title="Edit Kategori"
                                        data-action="{{ route('admin.document-categories.update', $cat) }}"
                                        data-category="{{ json_encode([
                                            'id' => $cat->id,
                                            'name' => $cat->name,
                                        ]) }}"
                                    >
                                        <i data-feather="edit-2" class="h-4 w-4"></i>
                                    </button>

                                    @if($cat->documents_count == 0)
                                        <button
                                            type="button"
                                            class="btn-icon text-rose-600 hover:bg-rose-50"
                                            title="Hapus Kategori"
                                            onclick="confirmDelete('delete-cat-{{ $cat->id }}', 'kategori {{ addslashes($cat->name) }}')"
                                        >
                                            <i data-feather="trash-2" class="h-4 w-4"></i>
                                        </button>

                                        <form id="delete-cat-{{ $cat->id }}" method="POST" action="{{ route('admin.document-categories.destroy', $cat) }}" class="hidden">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    @else
                                        <span class="btn-icon text-slate-300 cursor-not-allowed" title="Tidak dapat dihapus karena memiliki dokumen terkait">
                                            <i data-feather="trash-2" class="h-4 w-4"></i>
                                        </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <x-admin.empty-state
                            colspan="3"
                            message="Belum ada kategori dokumen."
                            description="Tambahkan kategori awal seperti Kebijakan, SOP, atau Formulir."
                        />
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($categories->hasPages())
            <div class="border-t border-slate-100 px-6 py-4">
                {{ $categories->links() }}
            </div>
        @endif
    </x-admin.card>
@endsection

@section('modals')
    <!-- Modal Tambah Kategori -->
    <x-admin.modal id="modal-create-category" title="Tambah Kategori Dokumen">
        <form method="POST" action="{{ route('admin.document-categories.store') }}" class="space-y-4">
            @csrf

            <x-admin.form-input
                name="name"
                label="Nama Kategori Dokumen"
                placeholder="Contoh: Prosedur Operasional Standar (SOP)"
                required
            />

            <div class="flex items-center justify-end gap-2.5 pt-4 border-t border-slate-100">
                <x-admin.btn-secondary data-modal-close>Batal</x-admin.btn-secondary>
                <x-admin.btn-primary type="submit">Simpan Kategori</x-admin.btn-primary>
            </div>
        </form>
    </x-admin.modal>

    <!-- Modal Edit Kategori -->
    <x-admin.modal id="modal-edit-category" title="Edit Kategori Dokumen">
        <form id="form-edit-category" method="POST" action="" class="space-y-4">
            @csrf
            @method('PUT')

            <x-admin.form-input
                name="name"
                label="Nama Kategori Dokumen"
                required
            />

            <div class="flex items-center justify-end gap-2.5 pt-4 border-t border-slate-100">
                <x-admin.btn-secondary data-modal-close>Batal</x-admin.btn-secondary>
                <x-admin.btn-primary type="submit">Perbarui Kategori</x-admin.btn-primary>
            </div>
        </form>
    </x-admin.modal>
@endsection

@push('scripts')
    <script src="{{ asset('dashboard/assets/js/document-categories.js') }}"></script>
@endpush
