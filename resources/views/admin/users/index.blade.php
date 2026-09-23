@extends('layouts.admin', ['title' => 'Kelola Pengguna'])

@section('content')
    <x-admin.page-header
        title="Kelola Pengguna"
        description="Kelola akun Super Admin dan Operator Mutu yang memiliki izin mengelola sistem PPM."
    >
        <x-slot:actions>
            <x-admin.btn-primary data-modal-open="modal-create-user">
                <i data-feather="plus" class="h-4 w-4"></i>
                Tambah Pengguna
            </x-admin.btn-primary>
        </x-slot:actions>
    </x-admin.page-header>

    <x-admin.card>
        <div class="overflow-x-auto -mx-6 -my-6">
            <table class="min-w-full divide-y divide-slate-100">
                <thead class="bg-slate-50/75">
                    <tr>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Nama Pengguna</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Alamat Email</th>
                        <th class="px-6 py-3.5 text-center text-xs font-semibold uppercase tracking-wider text-slate-500">Peran (Role)</th>
                        <th class="px-6 py-3.5 text-center text-xs font-semibold uppercase tracking-wider text-slate-500">Status</th>
                        <th class="px-6 py-3.5 text-center text-xs font-semibold uppercase tracking-wider text-slate-500">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse($users as $u)
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-linear-to-tr from-[#00A99D] to-[#0BB5CB] text-white font-bold text-xs shadow-xs">
                                        {{ strtoupper(substr($u->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-slate-900 leading-tight">{{ $u->name }}</p>
                                        @if($u->id === \Illuminate\Support\Facades\Auth::id())
                                            <span class="text-[10px] font-semibold text-emerald-600 bg-emerald-50 px-1.5 py-0.5 rounded">Akun Anda</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm text-slate-600 font-mono">{{ $u->email }}</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center rounded-lg px-2.5 py-1 text-xs font-semibold {{ $u->role->badgeClass() }}">
                                    {{ $u->role->label() }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <x-admin.badge :active="$u->is_active" />
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <!-- Edit Button (Lime) -->
                                    <button
                                        type="button"
                                        class="btn-icon btn-icon-lime btn-edit-user rounded-xl p-2 transition-all duration-200 shadow-2xs hover:shadow-xs active:scale-95 cursor-pointer"
                                        title="Edit Pengguna"
                                        data-action="{{ route('admin.users.update', $u) }}"
                                        data-user="{{ json_encode([
                                            'id' => $u->id,
                                            'name' => $u->name,
                                            'email' => $u->email,
                                            'role' => $u->role->value,
                                            'is_active' => $u->is_active,
                                        ]) }}"
                                    >
                                        <i data-feather="edit-2" class="h-4 w-4"></i>
                                    </button>

                                    <!-- Delete Button (Rose / Disabled for self) -->
                                    @if($u->id !== \Illuminate\Support\Facades\Auth::id())
                                        <button
                                            type="button"
                                            class="btn-icon btn-icon-danger rounded-xl p-2 transition-all duration-200 shadow-2xs hover:shadow-xs active:scale-95 cursor-pointer"
                                            title="Hapus Pengguna"
                                            onclick="confirmDelete('delete-user-{{ $u->id }}', 'pengguna {{ addslashes($u->name) }}')"
                                        >
                                            <i data-feather="trash-2" class="h-4 w-4"></i>
                                        </button>

                                        <form id="delete-user-{{ $u->id }}" method="POST" action="{{ route('admin.users.destroy', $u) }}" class="hidden">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    @else
                                        <span class="btn-icon rounded-xl p-2 text-slate-300 cursor-not-allowed opacity-50" title="Tidak dapat menghapus akun Anda sendiri">
                                            <i data-feather="trash-2" class="h-4 w-4"></i>
                                        </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <x-admin.empty-state
                            colspan="5"
                            message="Belum ada pengguna admin."
                        />
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
            <div class="border-t border-slate-100 px-6 py-4">
                {{ $users->links() }}
            </div>
        @endif
    </x-admin.card>
@endsection

@section('modals')
    <!-- Modal Tambah Pengguna -->
    <x-admin.modal id="modal-create-user" title="Tambah Pengguna Operator Mutu">
        <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-4">
            @csrf

            <x-admin.form-input
                name="name"
                label="Nama Lengkap"
                placeholder="Contoh: Budi Santoso, M.Kom"
                required
            />

            <x-admin.form-input
                name="email"
                label="Alamat Email"
                type="email"
                placeholder="budi@ppm.ac.id"
                required
            />

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-1.5">Peran (Role Akses)</label>
                <div class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl bg-slate-50 border border-slate-200/80 text-sm">
                    <span class="inline-flex items-center rounded-lg px-2.5 py-0.5 text-xs font-bold bg-sky-50 text-[#028DA9] border border-sky-200">
                        Operator Mutu
                    </span>
                    <span class="text-xs text-slate-500 font-normal">Hak akses mengelola konten & dokumen portal PPM</span>
                </div>
                <input type="hidden" name="role" value="operator_mutu">
            </div>

            <x-admin.form-input
                name="password"
                label="Kata Sandi Awal"
                type="password"
                placeholder="Minimal 6 karakter"
                required
            />

            <div class="pt-1">
                <x-admin.form-checkbox
                    name="is_active"
                    id="create_user_is_active"
                    label="Akun Langsung Aktif"
                    description="Pengguna dapat langsung masuk menggunakan email dan kata sandi yang dibuat."
                    :checked="true"
                />
            </div>

            <div class="flex items-center justify-end gap-2.5 pt-4 border-t border-slate-100">
                <x-admin.btn-secondary data-modal-close>Batal</x-admin.btn-secondary>
                <x-admin.btn-primary type="submit">Simpan Pengguna</x-admin.btn-primary>
            </div>
        </form>
    </x-admin.modal>

    <!-- Modal Edit Pengguna -->
    <x-admin.modal id="modal-edit-user" title="Edit Data Pengguna">
        <form id="form-edit-user" method="POST" action="" class="space-y-4">
            @csrf
            @method('PUT')

            <x-admin.form-input
                name="name"
                label="Nama Lengkap"
                required
            />

            <x-admin.form-input
                name="email"
                label="Alamat Email"
                type="email"
                required
            />

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-1.5">Peran (Role Akses)</label>
                <div class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl bg-slate-50 border border-slate-200/80 text-sm">
                    <span id="edit-user-role-badge" class="inline-flex items-center rounded-lg px-2.5 py-0.5 text-xs font-bold bg-sky-50 text-[#028DA9] border border-sky-200">
                        Operator Mutu
                    </span>
                    <span id="edit-user-role-desc" class="text-xs text-slate-500 font-normal">Hak akses mengelola konten & dokumen portal PPM</span>
                </div>
                <input type="hidden" name="role" id="edit-user-role" value="operator_mutu">
            </div>

            <x-admin.form-input
                name="password"
                label="Ganti Kata Sandi (Kosongkan jika tidak ingin mengubah)"
                type="password"
                placeholder="Minimal 6 karakter baru"
            />

            <div class="pt-1">
                <x-admin.form-checkbox
                    name="is_active"
                    id="edit_user_is_active"
                    label="Status Akun Aktif"
                    description="Beri centang untuk mengaktifkan akses atau hilangkan untuk menonaktifkan."
                    :checked="false"
                />
            </div>

            <div class="flex items-center justify-end gap-2.5 pt-4 border-t border-slate-100">
                <x-admin.btn-secondary data-modal-close>Batal</x-admin.btn-secondary>
                <x-admin.btn-primary type="submit">Perbarui Pengguna</x-admin.btn-primary>
            </div>
        </form>
    </x-admin.modal>
@endsection

@push('scripts')
    <script src="{{ asset('dashboard/assets/js/users.js') }}"></script>
@endpush
