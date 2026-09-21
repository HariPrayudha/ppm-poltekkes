@php
    $user = auth()->user();
    $isSuperAdmin = $user && $user->isSuperAdmin();
@endphp

<!-- Mobile Sidebar Backdrop Overlay -->
<div id="sidebar-overlay" class="fixed inset-0 z-40 bg-slate-950/40 backdrop-blur-sm hidden lg:hidden"></div>

<!-- Sidebar Container -->
<aside id="admin-sidebar" class="fixed inset-y-0 left-0 z-50 flex w-64 flex-col justify-between border-r border-slate-200/80 bg-white shadow-xl lg:shadow-none transition-transform duration-300 -translate-x-full lg:translate-x-0">
    <div class="flex flex-col flex-1 overflow-y-auto">
        <!-- Logo / Brand -->
        <div class="flex h-16 items-center justify-between px-6 border-b border-slate-100">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center">
                <img src="{{ asset('dashboard/assets/image/logo-text-kemnaker.png') }}" alt="PPM Poltekkes Kemenkes Medan" class="h-9 w-auto max-w-45 object-contain">
            </a>
            <button type="button" id="btn-sidebar-close" class="lg:hidden rounded-lg p-1.5 text-slate-400 hover:bg-slate-100 hover:text-slate-600">
                <i data-feather="x" class="h-5 w-5"></i>
            </button>
        </div>

        <!-- Navigation Menu Items -->
        <nav class="flex-1 space-y-6 px-3 py-5">
            <!-- Group: Utama -->
            <div>
                <p class="px-3 text-[11px] font-bold uppercase tracking-widest text-slate-400 mb-2">Utama</p>
                <div class="space-y-1">
                    <a href="{{ route('admin.dashboard') }}"
                       class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-[rgba(11,181,203,0.08)] text-[#028DA9] font-bold shadow-xs' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-medium' }}">
                        <i data-feather="home" class="h-4 w-4 shrink-0 {{ request()->routeIs('admin.dashboard') ? 'text-[#028DA9]' : 'text-slate-400' }}"></i>
                        <span>Dashboard</span>
                    </a>
                </div>
            </div>

            <!-- Group: Konten Beranda -->
            <div>
                <p class="px-3 text-[11px] font-bold uppercase tracking-widest text-slate-400 mb-2">Konten Beranda</p>
                <div class="space-y-1">
                    <a href="{{ route('admin.banners.index') }}"
                       class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition-all {{ request()->routeIs('admin.banners.*') ? 'bg-[rgba(11,181,203,0.08)] text-[#028DA9] font-bold shadow-xs' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-medium' }}">
                        <i data-feather="image" class="h-4 w-4 shrink-0 {{ request()->routeIs('admin.banners.*') ? 'text-[#028DA9]' : 'text-slate-400' }}"></i>
                        <span>Hero Banner</span>
                    </a>
                    <a href="{{ route('admin.greeting.index') }}"
                       class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition-all {{ request()->routeIs('admin.greeting.*') ? 'bg-[rgba(11,181,203,0.08)] text-[#028DA9] font-bold shadow-xs' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-medium' }}">
                        <i data-feather="user" class="h-4 w-4 shrink-0 {{ request()->routeIs('admin.greeting.*') ? 'text-[#028DA9]' : 'text-slate-400' }}"></i>
                        <span>Sambutan Pimpinan</span>
                    </a>
                    <a href="{{ route('admin.services.index') }}"
                       class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition-all {{ request()->routeIs('admin.services.*') ? 'bg-[rgba(11,181,203,0.08)] text-[#028DA9] font-bold shadow-xs' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-medium' }}">
                        <i data-feather="grid" class="h-4 w-4 shrink-0 {{ request()->routeIs('admin.services.*') ? 'text-[#028DA9]' : 'text-slate-400' }}"></i>
                        <span>Layanan Mutu</span>
                    </a>
                    <a href="{{ route('admin.related-links.index') }}"
                       class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition-all {{ request()->routeIs('admin.related-links.*') ? 'bg-[rgba(11,181,203,0.08)] text-[#028DA9] font-bold shadow-xs' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-medium' }}">
                        <i data-feather="link-2" class="h-4 w-4 shrink-0 {{ request()->routeIs('admin.related-links.*') ? 'text-[#028DA9]' : 'text-slate-400' }}"></i>
                        <span>Link Terkait</span>
                    </a>
                </div>
            </div>

            <!-- Group: Dokumen SPMI -->
            <div>
                <p class="px-3 text-[11px] font-bold uppercase tracking-widest text-slate-400 mb-2">Dokumen & SPMI</p>
                <div class="space-y-1">
                    <a href="{{ route('admin.profile.index') }}"
                       class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition-all {{ request()->routeIs('admin.profile.*') ? 'bg-[rgba(11,181,203,0.08)] text-[#028DA9] font-bold shadow-xs' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-medium' }}">
                        <i data-feather="users" class="h-4 w-4 shrink-0 {{ request()->routeIs('admin.profile.*') ? 'text-[#028DA9]' : 'text-slate-400' }}"></i>
                        <span>Struktur & Tupoksi</span>
                    </a>
                    <a href="{{ route('admin.document-categories.index') }}"
                       class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition-all {{ request()->routeIs('admin.document-categories.*') ? 'bg-[rgba(11,181,203,0.08)] text-[#028DA9] font-bold shadow-xs' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-medium' }}">
                        <i data-feather="folder" class="h-4 w-4 shrink-0 {{ request()->routeIs('admin.document-categories.*') ? 'text-[#028DA9]' : 'text-slate-400' }}"></i>
                        <span>Kategori Dokumen</span>
                    </a>
                    <a href="{{ route('admin.documents.index') }}"
                       class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition-all {{ request()->routeIs('admin.documents.*') ? 'bg-[rgba(11,181,203,0.08)] text-[#028DA9] font-bold shadow-xs' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-medium' }}">
                        <i data-feather="file-text" class="h-4 w-4 shrink-0 {{ request()->routeIs('admin.documents.*') ? 'text-[#028DA9]' : 'text-slate-400' }}"></i>
                        <span>Dokumen & SOP</span>
                    </a>
                </div>
            </div>

            <!-- Group: Media & Informasi -->
            <div>
                <p class="px-3 text-[11px] font-bold uppercase tracking-widest text-slate-400 mb-2">Media & Informasi</p>
                <div class="space-y-1">
                    <a href="{{ route('admin.gallery.index') }}"
                       class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition-all {{ request()->routeIs('admin.gallery.*') ? 'bg-[rgba(11,181,203,0.08)] text-[#028DA9] font-bold shadow-xs' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-medium' }}">
                        <i data-feather="camera" class="h-4 w-4 shrink-0 {{ request()->routeIs('admin.gallery.*') ? 'text-[#028DA9]' : 'text-slate-400' }}"></i>
                        <span>Galeri Kegiatan</span>
                    </a>
                    <a href="{{ route('admin.contact.index') }}"
                       class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition-all {{ request()->routeIs('admin.contact.*') ? 'bg-[rgba(11,181,203,0.08)] text-[#028DA9] font-bold shadow-xs' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-medium' }}">
                        <i data-feather="phone" class="h-4 w-4 shrink-0 {{ request()->routeIs('admin.contact.*') ? 'text-[#028DA9]' : 'text-slate-400' }}"></i>
                        <span>Kontak & Footer</span>
                    </a>
                </div>
            </div>

            <!-- Group: Pengaturan (Super Admin only) -->
            @if($isSuperAdmin)
                <div>
                    <p class="px-3 text-[11px] font-bold uppercase tracking-widest text-slate-400 mb-2">Pengaturan</p>
                    <div class="space-y-1">
                        <a href="{{ route('admin.users.index') }}"
                           class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition-all {{ request()->routeIs('admin.users.*') ? 'bg-[rgba(11,181,203,0.08)] text-[#028DA9] font-bold shadow-xs' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-medium' }}">
                            <i data-feather="user-check" class="h-4 w-4 shrink-0 {{ request()->routeIs('admin.users.*') ? 'text-[#028DA9]' : 'text-slate-400' }}"></i>
                            <span>Kelola Pengguna</span>
                        </a>
                    </div>
                </div>
            @endif
        </nav>
    </div>

    <!-- User Profile Footer & Logout -->
    <div class="border-t border-slate-100 p-4 bg-slate-50/50">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3 min-w-0">
                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-linear-to-tr from-[#00A99D] to-[#0BB5CB] text-white font-bold text-xs shadow-sm">
                    {{ strtoupper(substr($user->name ?? 'A', 0, 2)) }}
                </div>
                <div class="min-w-0 flex-1">
                    <p class="truncate text-xs font-bold text-slate-900">{{ $user->name ?? 'Pengguna' }}</p>
                    <span class="inline-block rounded-md px-1.5 py-0.5 text-[10px] font-semibold {{ $user?->role?->badgeClass() ?? 'bg-slate-100 text-slate-700' }}">
                        {{ $user?->role?->label() ?? 'Admin' }}
                    </span>
                </div>
            </div>

            <!-- Logout Form -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" title="Keluar" class="rounded-xl p-2 text-slate-400 hover:bg-rose-50 hover:text-rose-600 transition-colors">
                    <i data-feather="log-out" class="h-4 w-4"></i>
                </button>
            </form>
        </div>
    </div>
</aside>
