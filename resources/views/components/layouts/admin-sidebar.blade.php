@php
    $user = auth()->user();
    $isSuperAdmin = $user && $user->isSuperAdmin();
@endphp

<!-- Mobile Sidebar Backdrop Overlay -->
<div id="sidebar-overlay" class="fixed inset-0 z-40 bg-slate-950/40 backdrop-blur-sm hidden lg:hidden"></div>

<!-- Sidebar Container -->
<aside id="admin-sidebar" class="fixed inset-y-0 left-0 z-50 flex w-64 max-w-[85vw] flex-col border-r border-slate-200/80 bg-white shadow-xl lg:shadow-none transition-transform duration-300 -translate-x-full lg:translate-x-0">
    <!-- Fixed Sidebar Header / Brand Logo (Non-scrolling) -->
    <div class="shrink-0 h-18 flex items-center justify-between px-5 border-b border-slate-200/80 bg-white">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center">
            <img src="{{ asset('dashboard/assets/image/logo-text-kemnaker.png') }}" alt="PPM Poltekkes Kemenkes Medan" class="h-11 sm:h-12 w-auto max-w-[195px] object-contain">
        </a>
        <button type="button" id="btn-sidebar-close" class="lg:hidden rounded-xl p-2 text-slate-400 hover:bg-slate-100 hover:text-slate-600 transition-colors cursor-pointer">
            <i data-feather="x" class="h-5 w-5"></i>
        </button>
    </div>

    <!-- Navigation Menu Items (Scrollable Body) -->
    <div class="flex-1 overflow-y-auto">
        <nav class="space-y-6 px-3 py-5 pb-8">
            <!-- Group: Utama -->
            <div>
                <p class="px-3 text-[11px] font-bold uppercase tracking-widest text-slate-400 mb-2">Utama</p>
                <div class="space-y-1">
                    <x-layouts.sidebar-link :href="route('admin.dashboard')" icon="home" :active="request()->routeIs('admin.dashboard')">
                        Dashboard
                    </x-layouts.sidebar-link>
                </div>
            </div>

            <!-- Group: Konten Beranda -->
            <div>
                <p class="px-3 text-[11px] font-bold uppercase tracking-widest text-slate-400 mb-2">Konten Beranda</p>
                <div class="space-y-1">
                    <x-layouts.sidebar-link :href="route('admin.banners.index')" icon="image" :active="request()->routeIs('admin.banners.*')">
                        Hero Banner
                    </x-layouts.sidebar-link>
                    <x-layouts.sidebar-link :href="route('admin.greeting.index')" icon="user" :active="request()->routeIs('admin.greeting.*')">
                        Sambutan Pimpinan
                    </x-layouts.sidebar-link>
                    <x-layouts.sidebar-link :href="route('admin.services.index')" icon="grid" :active="request()->routeIs('admin.services.*')">
                        Layanan Mutu
                    </x-layouts.sidebar-link>
                    <x-layouts.sidebar-link :href="route('admin.related-links.index')" icon="link-2" :active="request()->routeIs('admin.related-links.*')">
                        Link Terkait
                    </x-layouts.sidebar-link>
                </div>
            </div>

            <!-- Group: Dokumen SPMI -->
            <div>
                <p class="px-3 text-[11px] font-bold uppercase tracking-widest text-slate-400 mb-2">Dokumen & SPMI</p>
                <div class="space-y-1">
                    <x-layouts.sidebar-link :href="route('admin.profile.index')" icon="users" :active="request()->routeIs('admin.profile.*')">
                        Struktur & Tupoksi
                    </x-layouts.sidebar-link>
                    <x-layouts.sidebar-link :href="route('admin.document-categories.index')" icon="folder" :active="request()->routeIs('admin.document-categories.*')">
                        Kategori Dokumen
                    </x-layouts.sidebar-link>
                    <x-layouts.sidebar-link :href="route('admin.documents.index')" icon="file-text" :active="request()->routeIs('admin.documents.*')">
                        Dokumen & SOP
                    </x-layouts.sidebar-link>
                </div>
            </div>

            <!-- Group: Media & Informasi -->
            <div>
                <p class="px-3 text-[11px] font-bold uppercase tracking-widest text-slate-400 mb-2">Media & Informasi</p>
                <div class="space-y-1">
                    <x-layouts.sidebar-link :href="route('admin.gallery.index')" icon="camera" :active="request()->routeIs('admin.gallery.*')">
                        Galeri Kegiatan
                    </x-layouts.sidebar-link>
                    <x-layouts.sidebar-link :href="route('admin.contact.index')" icon="phone" :active="request()->routeIs('admin.contact.*')">
                        Kontak & Footer
                    </x-layouts.sidebar-link>
                </div>
            </div>

            <!-- Group: Pengaturan (Super Admin only) -->
            @if($isSuperAdmin)
                <div>
                    <p class="px-3 text-[11px] font-bold uppercase tracking-widest text-slate-400 mb-2">Pengaturan</p>
                    <div class="space-y-1">
                        <x-layouts.sidebar-link :href="route('admin.users.index')" icon="user-check" :active="request()->routeIs('admin.users.*')">
                            Kelola Pengguna
                        </x-layouts.sidebar-link>
                    </div>
                </div>
            @endif
        </nav>
    </div>
</aside>
