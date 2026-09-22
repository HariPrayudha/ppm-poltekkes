<header id="main-navbar" class="sticky top-0 z-50 backdrop-blur-md bg-white/90 border-b border-slate-200/80 shadow-2xs transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <!-- Brand Logo & Identity -->
            <a href="{{ route('frontend.home') }}" class="flex items-center gap-3 group shrink-0">
                <img src="{{ asset('dashboard/assets/image/logo-text-kemnaker.png') }}"
                    alt="Poltekkes Kemenkes Medan"
                    class="h-12 w-auto object-contain transition-transform duration-300 group-hover:scale-105">
                <div class="hidden sm:flex flex-col border-l border-slate-200 pl-3">
                    <span class="text-xs font-semibold tracking-wider text-[#028DA9] uppercase">Pusat Penjaminan Mutu</span>
                    <span class="text-sm font-bold text-slate-800 tracking-tight">Poltekkes Kemenkes Medan</span>
                </div>
            </a>

            <!-- Desktop Navigation Links -->
            <nav class="hidden lg:flex items-center gap-1.5">
                <!-- 1. Beranda -->
                <a href="{{ route('frontend.home') }}"
                    class="px-4 py-2 rounded-xl text-sm transition-all duration-200 {{ request()->routeIs('frontend.home') ? 'bg-[#0BB5CB]/10 text-[#028DA9] font-bold shadow-2xs' : 'text-slate-600 hover:text-[#028DA9] hover:bg-slate-100/70 font-medium' }}">
                    Beranda
                </a>

                <!-- 2. Profil (Dropdown) -->
                <div class="relative group" id="desktop-profile-dropdown">
                    <button type="button"
                        class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 cursor-pointer {{ request()->routeIs('frontend.profile*') ? 'bg-[#0BB5CB]/10 text-[#028DA9] font-bold shadow-2xs' : 'text-slate-600 hover:text-[#028DA9] hover:bg-slate-100/70' }}"
                        aria-expanded="false"
                        aria-haspopup="true">
                        <span>Profil</span>
                        <i data-feather="chevron-down" class="w-4 h-4 transition-transform duration-200 group-hover:rotate-180"></i>
                    </button>

                    <!-- Dropdown Menu -->
                    <div class="nav-dropdown-menu absolute left-0 top-full pt-2 w-60 opacity-0 translate-y-2 pointer-events-none group-hover:opacity-100 group-hover:translate-y-0 group-hover:pointer-events-auto transition-all duration-200 z-50">
                        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xl p-2 space-y-1">
                            <a href="{{ route('frontend.profile.structure') }}"
                                class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl text-xs sm:text-sm font-medium transition-colors {{ request()->routeIs('frontend.profile.structure') ? 'bg-[#0BB5CB]/10 text-[#028DA9] font-bold' : 'text-slate-700 hover:bg-slate-100/80 hover:text-[#028DA9]' }}">
                                <i data-feather="git-commit" class="w-4 h-4 text-[#0BB5CB]"></i>
                                <span>Struktur Organisasi</span>
                            </a>
                            <a href="{{ route('frontend.profile.duties') }}"
                                class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl text-xs sm:text-sm font-medium transition-colors {{ request()->routeIs('frontend.profile.duties') ? 'bg-[#0BB5CB]/10 text-[#028DA9] font-bold' : 'text-slate-700 hover:bg-slate-100/80 hover:text-[#028DA9]' }}">
                                <i data-feather="clipboard" class="w-4 h-4 text-[#46B58B]"></i>
                                <span>Tugas & Fungsi</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- 3. Dokumen & SOP -->
                <a href="{{ route('frontend.documents.index') }}"
                    class="px-4 py-2 rounded-xl text-sm transition-all duration-200 {{ request()->routeIs('frontend.documents.*') ? 'bg-[#0BB5CB]/10 text-[#028DA9] font-bold shadow-2xs' : 'text-slate-600 hover:text-[#028DA9] hover:bg-slate-100/70 font-medium' }}">
                    Dokumen & SOP
                </a>

                <!-- 4. Galeri -->
                <a href="{{ route('frontend.gallery.index') }}"
                    class="px-4 py-2 rounded-xl text-sm transition-all duration-200 {{ request()->routeIs('frontend.gallery.*') ? 'bg-[#0BB5CB]/10 text-[#028DA9] font-bold shadow-2xs' : 'text-slate-600 hover:text-[#028DA9] hover:bg-slate-100/70 font-medium' }}">
                    Galeri
                </a>

                <!-- 5. Kontak -->
                <a href="{{ route('frontend.contact.index') }}"
                    class="px-4 py-2 rounded-xl text-sm transition-all duration-200 {{ request()->routeIs('frontend.contact.*') ? 'bg-[#0BB5CB]/10 text-[#028DA9] font-bold shadow-2xs' : 'text-slate-600 hover:text-[#028DA9] hover:bg-slate-100/70 font-medium' }}">
                    Kontak
                </a>
            </nav>

            <!-- Mobile Hamburger Button -->
            <div class="flex items-center lg:hidden">
                <button id="mobile-menu-btn"
                    type="button"
                    aria-label="Menu Navigasi"
                    class="p-2.5 rounded-xl border border-slate-200 text-slate-700 hover:text-[#028DA9] hover:bg-slate-100/80 transition-colors focus:outline-hidden cursor-pointer">
                    <i data-feather="menu" id="menu-icon-open" class="w-5 h-5"></i>
                    <i data-feather="x" id="menu-icon-close" class="w-5 h-5 hidden"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Drawer Navigation -->
    <div id="mobile-menu" class="hidden lg:hidden border-t border-slate-200/80 bg-white/95 backdrop-blur-md px-4 pt-3 pb-6 space-y-1 shadow-xl transition-all duration-300">
        <!-- 1. Beranda -->
        <a href="{{ route('frontend.home') }}"
            class="flex items-center justify-between px-4 py-2.5 rounded-xl text-sm transition-all duration-200 {{ request()->routeIs('frontend.home') ? 'bg-[#0BB5CB]/10 text-[#028DA9] font-bold' : 'text-slate-700 hover:text-[#028DA9] hover:bg-slate-100/70 font-medium' }}">
            <span>Beranda</span>
            @if(request()->routeIs('frontend.home'))
                <i data-feather="chevron-right" class="w-4 h-4 text-[#028DA9]"></i>
            @endif
        </a>

        <!-- 2. Profil (Accordion) -->
        <div class="space-y-1">
            <button type="button"
                id="mobile-profile-toggle"
                class="w-full flex items-center justify-between px-4 py-2.5 rounded-xl text-sm transition-all duration-200 cursor-pointer {{ request()->routeIs('frontend.profile*') ? 'bg-[#0BB5CB]/10 text-[#028DA9] font-bold' : 'text-slate-700 hover:text-[#028DA9] hover:bg-slate-100/70 font-medium' }}">
                <span>Profil</span>
                <i data-feather="chevron-down" id="mobile-profile-chevron" class="w-4 h-4 transition-transform duration-200"></i>
            </button>
            <div id="mobile-profile-submenu" class="hidden pl-4 pr-1 py-1 space-y-1 border-l-2 border-slate-200 ml-4">
                <a href="{{ route('frontend.profile.structure') }}"
                    class="flex items-center gap-2 px-3 py-2 rounded-lg text-xs font-medium {{ request()->routeIs('frontend.profile.structure') ? 'text-[#028DA9] font-bold bg-[#0BB5CB]/10' : 'text-slate-600 hover:text-[#028DA9]' }}">
                    <i data-feather="git-commit" class="w-3.5 h-3.5 text-[#0BB5CB]"></i>
                    <span>Struktur Organisasi</span>
                </a>
                <a href="{{ route('frontend.profile.duties') }}"
                    class="flex items-center gap-2 px-3 py-2 rounded-lg text-xs font-medium {{ request()->routeIs('frontend.profile.duties') ? 'text-[#028DA9] font-bold bg-[#0BB5CB]/10' : 'text-slate-600 hover:text-[#028DA9]' }}">
                    <i data-feather="clipboard" class="w-3.5 h-3.5 text-[#46B58B]"></i>
                    <span>Tugas & Fungsi</span>
                </a>
            </div>
        </div>

        <!-- 3. Dokumen & SOP -->
        <a href="{{ route('frontend.documents.index') }}"
            class="flex items-center justify-between px-4 py-2.5 rounded-xl text-sm transition-all duration-200 {{ request()->routeIs('frontend.documents.*') ? 'bg-[#0BB5CB]/10 text-[#028DA9] font-bold' : 'text-slate-700 hover:text-[#028DA9] hover:bg-slate-100/70 font-medium' }}">
            <span>Dokumen & SOP</span>
            @if(request()->routeIs('frontend.documents.*'))
                <i data-feather="chevron-right" class="w-4 h-4 text-[#028DA9]"></i>
            @endif
        </a>

        <!-- 4. Galeri -->
        <a href="{{ route('frontend.gallery.index') }}"
            class="flex items-center justify-between px-4 py-2.5 rounded-xl text-sm transition-all duration-200 {{ request()->routeIs('frontend.gallery.*') ? 'bg-[#0BB5CB]/10 text-[#028DA9] font-bold' : 'text-slate-700 hover:text-[#028DA9] hover:bg-slate-100/70 font-medium' }}">
            <span>Galeri</span>
            @if(request()->routeIs('frontend.gallery.*'))
                <i data-feather="chevron-right" class="w-4 h-4 text-[#028DA9]"></i>
            @endif
        </a>

        <!-- 5. Kontak -->
        <a href="{{ route('frontend.contact.index') }}"
            class="flex items-center justify-between px-4 py-2.5 rounded-xl text-sm transition-all duration-200 {{ request()->routeIs('frontend.contact.*') ? 'bg-[#0BB5CB]/10 text-[#028DA9] font-bold' : 'text-slate-700 hover:text-[#028DA9] hover:bg-slate-100/70 font-medium' }}">
            <span>Kontak</span>
            @if(request()->routeIs('frontend.contact.*'))
                <i data-feather="chevron-right" class="w-4 h-4 text-[#028DA9]"></i>
            @endif
        </a>
    </div>
</header>
