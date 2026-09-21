@extends('layouts.admin', ['title' => 'Kelola Pengguna'])

@section('content')
    <x-admin.page-header
        title="Kelola Pengguna & Akses"
        description="Kelola akun Super Admin dan Operator Mutu yang memiliki izin mengelola sistem PPM."
    >
        <x-slot:actions>
            <x-admin.btn-primary data-modal-open="modal-create-user">
                <i data-feather="user-plus" class="h-4 w-4"></i>
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
                        <th class="px-6 py-3.5 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">Aksi</th>
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
                                        @if($u->id === auth()->id())
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
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    <!-- Edit Button -->
                                    <button
                                        type="button"
                                        class="btn-icon btn-edit-user text-amber-600 hover:bg-amber-50"
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

                                    <!-- Delete Button (Disabled for self) -->
                                    @if($u->id !== auth()->id())
                                        <button
                                            type="button"
                                            class="btn-icon text-rose-600 hover:bg-rose-50"
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
                                        <span class="btn-icon text-slate-300 cursor-not-allowed" title="Tidak dapat menghapus akun Anda sendiri">
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
    <x-admin.modal id="modal-create-user" title="Tambah Pengguna Admin Baru">
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

            <x-admin.form-select name="role" label="Peran (Role Akses)" required>
                <option value="operator_mutu">Operator Mutu (Kelola Konten & Dokumen)</option>
                <option value="super_admin">Super Admin (Akses Penuh termasuk Pengguna)</option>
            </x-admin.form-select>

            <x-admin.form-input
                name="password"
                label="Kata Sandi Awal"
                type="password"
                placeholder="Minimal 6 karakter"
                required
            />

            <div class="pt-2">
                <label class="flex items-center gap-2.5 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" checked class="h-4 w-4 rounded border-slate-300 text-[#0BB5CB] focus:ring-[#0BB5CB]">
                    <span class="text-sm font-semibold text-slate-700">Akun Langsung Aktif</span>
                </label>
            </div>

            <div class="flex items-center justify-end gap-2.5 pt-4 border-t border-slate-100">
                <x-admin.btn-secondary data-modal-close>Batal</x-admin.btn-secondary>
                <x-admin.btn-primary type="submit">Simpan Pengguna</x-admin.btn-primary>
            </div>
        </form>
    </x-admin.modal>

    <!-- Modal Edit Pengguna -->
    <x-admin.modal id="modal-edit-user" title="Edit Data Pengguna Admin">
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

            <x-admin.form-select name="role" label="Peran (Role Akses)" required>
                <option value="operator_mutu">Operator Mutu (Kelola Konten & Dokumen)</option>
                <option value="super_admin">Super Admin (Akses Penuh)</option>
            </x-admin.form-select>

            <x-admin.form-input
                name="password"
                label="Ganti Kata Sandi (Kosongkan jika tidak ingin mengubah)"
                type="password"
                placeholder="Minimal 6 karakter baru"
            />

            <div class="pt-2">
                <label class="flex items-center gap-2.5 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" class="h-4 w-4 rounded border-slate-300 text-[#0BB5CB] focus:ring-[#0BB5CB]">
                    <span class="text-sm font-semibold text-slate-700">Status Akun Aktif</span>
                </label>
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
