<header id="main-navbar" class="sticky top-0 z-50 backdrop-blur-md bg-white/95 border-b border-slate-200/80 shadow-xs transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <!-- Brand Logo & Identity (Static logo, no hover zoom) -->
            <a href="{{ route('frontend.home') }}" class="flex items-center gap-3 sm:gap-3.5 shrink-0 select-none">
                <img src="{{ asset('dashboard/assets/image/logo-text-kemnaker.png') }}"
                    alt="Poltekkes Kemenkes Medan"
                    class="h-10 sm:h-12 w-auto object-contain">
                <div class="hidden sm:flex flex-col border-l-2 border-slate-200/80 pl-3.5 py-0.5">
                    <span class="text-[11px] font-bold tracking-wider text-[#00A99D] uppercase">Pusat Penjaminan Mutu</span>
                    <span class="text-sm font-extrabold text-slate-800 tracking-tight">Poltekkes Kemenkes Medan</span>
                </div>
            </a>

            <!-- Desktop Navigation Links & Quick Action -->
            <div class="hidden lg:flex items-center gap-1.5">
                <nav class="flex items-center gap-1.5">
                    <!-- 1. Beranda -->
                    <a href="{{ route('frontend.home') }}"
                        class="px-4 py-2 rounded-xl text-sm transition-all duration-200 {{ request()->routeIs('frontend.home') ? 'bg-linear-to-r from-[#00A99D] to-[#0BB5CB] text-white font-semibold shadow-md shadow-[#0BB5CB]/25' : 'text-slate-600 hover:text-[#028DA9] hover:bg-slate-100/80 font-medium' }}">
                        Beranda
                    </a>

                    <!-- 2. Profil (Dropdown) -->
                    <div class="relative group" id="desktop-profile-dropdown">
                        <button type="button"
                            class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm transition-all duration-200 cursor-pointer {{ request()->routeIs('frontend.profile*') ? 'bg-linear-to-r from-[#00A99D] to-[#0BB5CB] text-white font-semibold shadow-md shadow-[#0BB5CB]/25' : 'text-slate-600 hover:text-[#028DA9] hover:bg-slate-100/80 font-medium' }}"
                            aria-expanded="false"
                            aria-haspopup="true">
                            <span>Profil</span>
                            <i data-feather="chevron-down" class="w-4 h-4 transition-transform duration-200 group-hover:rotate-180"></i>
                        </button>

                        <!-- Dropdown Menu -->
                        <div class="nav-dropdown-menu absolute left-0 top-full pt-2 w-64 opacity-0 translate-y-2 pointer-events-none group-hover:opacity-100 group-hover:translate-y-0 group-hover:pointer-events-auto transition-all duration-200 z-50">
                            <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xl shadow-slate-900/10 p-2 space-y-1 overflow-hidden relative">
                                <div class="h-0.5 w-full bg-linear-to-r from-[#00A99D] to-[#0BB5CB] absolute top-0 left-0"></div>
                                <a href="{{ route('frontend.profile.structure') }}"
                                    class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs sm:text-sm transition-all duration-200 {{ request()->routeIs('frontend.profile.structure') ? 'bg-linear-to-r from-[#00A99D]/12 to-[#0BB5CB]/12 text-[#028DA9] font-bold border-l-2 border-[#00A99D]' : 'text-slate-700 hover:bg-slate-50 hover:text-[#028DA9] font-medium' }}">
                                    <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0 {{ request()->routeIs('frontend.profile.structure') ? 'bg-[#00A99D] text-white' : 'bg-slate-100 text-[#00A99D]' }}">
                                        <i data-feather="git-commit" class="w-4 h-4"></i>
                                    </div>
                                    <div>
                                        <div class="leading-tight">Struktur Organisasi</div>
                                        <span class="text-[11px] text-slate-400 font-normal">Bagan struktur kepemimpinan</span>
                                    </div>
                                </a>
                                <a href="{{ route('frontend.profile.duties') }}"
                                    class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs sm:text-sm transition-all duration-200 {{ request()->routeIs('frontend.profile.duties') ? 'bg-linear-to-r from-[#00A99D]/12 to-[#0BB5CB]/12 text-[#028DA9] font-bold border-l-2 border-[#00A99D]' : 'text-slate-700 hover:bg-slate-50 hover:text-[#028DA9] font-medium' }}">
                                    <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0 {{ request()->routeIs('frontend.profile.duties') ? 'bg-[#0BB5CB] text-white' : 'bg-slate-100 text-[#0BB5CB]' }}">
                                        <i data-feather="clipboard" class="w-4 h-4"></i>
                                    </div>
                                    <div>
                                        <div class="leading-tight">Tugas & Fungsi</div>
                                        <span class="text-[11px] text-slate-400 font-normal">Tupoksi penjaminan mutu</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Dokumen & SOP -->
                    <a href="{{ route('frontend.documents.index') }}"
                        class="px-4 py-2 rounded-xl text-sm transition-all duration-200 {{ request()->routeIs('frontend.documents.*') ? 'bg-linear-to-r from-[#00A99D] to-[#0BB5CB] text-white font-semibold shadow-md shadow-[#0BB5CB]/25' : 'text-slate-600 hover:text-[#028DA9] hover:bg-slate-100/80 font-medium' }}">
                        Dokumen & SOP
                    </a>

                    <!-- 4. Galeri -->
                    <a href="{{ route('frontend.gallery.index') }}"
                        class="px-4 py-2 rounded-xl text-sm transition-all duration-200 {{ request()->routeIs('frontend.gallery.*') ? 'bg-linear-to-r from-[#00A99D] to-[#0BB5CB] text-white font-semibold shadow-md shadow-[#0BB5CB]/25' : 'text-slate-600 hover:text-[#028DA9] hover:bg-slate-100/80 font-medium' }}">
                        Galeri
                    </a>
                </nav>

                <!-- Dedicated Separated Contact Button -->
                <div class="hidden lg:flex items-center pl-3.5 ml-2 border-l border-slate-200">
                    <a href="{{ route('frontend.contact.index') }}"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold transition-all duration-300 group {{ request()->routeIs('frontend.contact.*') ? 'bg-linear-to-r from-[#00A99D] to-[#0BB5CB] text-white shadow-md shadow-[#0BB5CB]/25' : 'bg-linear-to-r from-[#00A99D]/10 to-[#0BB5CB]/10 text-[#028DA9] border border-[#0BB5CB]/30 hover:border-[#0BB5CB] hover:bg-linear-to-r hover:from-[#00A99D] hover:to-[#0BB5CB] hover:text-white hover:shadow-md hover:shadow-[#0BB5CB]/20' }}">
                        <i data-feather="headphones" class="w-4 h-4 {{ request()->routeIs('frontend.contact.*') ? 'text-white' : 'text-[#00A99D] group-hover:text-white' }} transition-colors"></i>
                        <span>Kontak</span>
                    </a>
                </div>
            </div>

            <!-- Mobile Hamburger Animated Button -->
            <div class="flex items-center lg:hidden">
                <button id="mobile-menu-btn"
                    type="button"
                    aria-label="Menu Navigasi"
                    aria-expanded="false"
                    class="relative w-11 h-11 flex flex-col items-center justify-center gap-1.5 rounded-2xl border border-slate-200/90 text-slate-700 hover:text-[#028DA9] hover:bg-slate-50 hover:border-[#0BB5CB]/40 transition-all duration-300 focus:outline-hidden cursor-pointer group shadow-2xs">
                    <span class="hamburger-bar block w-5 h-0.5 rounded-full bg-slate-700 transition-all duration-300 ease-out origin-center"></span>
                    <span class="hamburger-bar block w-5 h-0.5 rounded-full bg-slate-700 transition-all duration-300 ease-out origin-center"></span>
                    <span class="hamburger-bar block w-5 h-0.5 rounded-full bg-slate-700 transition-all duration-300 ease-out origin-center"></span>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Backdrop Overlay -->
    <div id="mobile-menu-backdrop"
        class="fixed inset-0 top-20 bg-slate-950/25 backdrop-blur-xs opacity-0 pointer-events-none transition-opacity duration-300 z-40 lg:hidden"></div>

    <!-- Mobile Floating Navigation Card with Smooth Animation -->
    <div id="mobile-menu"
        class="fixed left-4 right-4 top-[5.5rem] z-50 max-w-md mx-auto bg-white/98 backdrop-blur-2xl border border-slate-200/90 rounded-3xl p-4 sm:p-5 shadow-2xl shadow-slate-900/15 opacity-0 -translate-y-4 scale-[0.98] pointer-events-none lg:hidden space-y-1.5">
        <!-- 1. Beranda -->
        <a href="{{ route('frontend.home') }}"
            class="block px-4 py-3 rounded-2xl text-sm font-semibold transition-all duration-200 {{ request()->routeIs('frontend.home') ? 'bg-linear-to-r from-[#00A99D] to-[#0BB5CB] text-white shadow-md shadow-[#0BB5CB]/25' : 'text-slate-700 hover:text-[#028DA9] hover:bg-slate-50' }}">
            Beranda
        </a>

        <!-- 2. Profil (Accordion) -->
        <div class="space-y-1">
            <button type="button"
                id="mobile-profile-toggle"
                aria-expanded="{{ request()->routeIs('frontend.profile*') ? 'true' : 'false' }}"
                class="w-full flex items-center justify-between px-4 py-3 rounded-2xl text-sm font-semibold transition-all duration-200 cursor-pointer {{ request()->routeIs('frontend.profile*') ? 'bg-linear-to-r from-[#00A99D] to-[#0BB5CB] text-white shadow-md shadow-[#0BB5CB]/25' : 'text-slate-700 hover:text-[#028DA9] hover:bg-slate-50' }}">
                <span>Profil</span>
                <i data-feather="chevron-down" id="mobile-profile-chevron" class="w-4 h-4 transition-transform duration-300 {{ request()->routeIs('frontend.profile*') ? 'rotate-180' : '' }}"></i>
            </button>
            <div id="mobile-profile-submenu" class="accordion-content {{ request()->routeIs('frontend.profile*') ? 'is-open' : '' }}">
                <div class="accordion-inner pl-3 pr-1 py-1 space-y-1 border-l-2 border-[#00A99D]/30 ml-4">
                    <a href="{{ route('frontend.profile.structure') }}"
                        class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl text-xs font-medium transition-colors {{ request()->routeIs('frontend.profile.structure') ? 'text-[#028DA9] font-bold bg-[#0BB5CB]/10' : 'text-slate-600 hover:text-[#028DA9] hover:bg-slate-50' }}">
                        <i data-feather="git-commit" class="w-3.5 h-3.5 text-[#00A99D]"></i>
                        <span>Struktur Organisasi</span>
                    </a>
                    <a href="{{ route('frontend.profile.duties') }}"
                        class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl text-xs font-medium transition-colors {{ request()->routeIs('frontend.profile.duties') ? 'text-[#028DA9] font-bold bg-[#0BB5CB]/10' : 'text-slate-600 hover:text-[#028DA9] hover:bg-slate-50' }}">
                        <i data-feather="clipboard" class="w-3.5 h-3.5 text-[#0BB5CB]"></i>
                        <span>Tugas & Fungsi</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- 3. Dokumen & SOP -->
        <a href="{{ route('frontend.documents.index') }}"
            class="block px-4 py-3 rounded-2xl text-sm font-semibold transition-all duration-200 {{ request()->routeIs('frontend.documents.*') ? 'bg-linear-to-r from-[#00A99D] to-[#0BB5CB] text-white shadow-md shadow-[#0BB5CB]/25' : 'text-slate-700 hover:text-[#028DA9] hover:bg-slate-50' }}">
            Dokumen & SOP
        </a>

        <!-- 4. Galeri -->
        <a href="{{ route('frontend.gallery.index') }}"
            class="block px-4 py-3 rounded-2xl text-sm font-semibold transition-all duration-200 {{ request()->routeIs('frontend.gallery.*') ? 'bg-linear-to-r from-[#00A99D] to-[#0BB5CB] text-white shadow-md shadow-[#0BB5CB]/25' : 'text-slate-700 hover:text-[#028DA9] hover:bg-slate-50' }}">
            Galeri
        </a>

        <!-- 5. Kontak (Featured Card Action) -->
        <div class="pt-2 mt-1 border-t border-slate-100">
            <a href="{{ route('frontend.contact.index') }}"
                class="flex items-center justify-center gap-2 px-4 py-3 rounded-2xl text-sm font-semibold transition-all duration-300 {{ request()->routeIs('frontend.contact.*') ? 'bg-linear-to-r from-[#00A99D] to-[#0BB5CB] text-white shadow-md shadow-[#0BB5CB]/25' : 'bg-linear-to-r from-[#00A99D]/10 to-[#0BB5CB]/10 text-[#028DA9] border border-[#0BB5CB]/30 hover:border-[#0BB5CB] hover:bg-linear-to-r hover:from-[#00A99D] hover:to-[#0BB5CB] hover:text-white' }}">
                <i data-feather="headphones" class="w-4 h-4"></i>
                <span>Layanan Kontak</span>
            </a>
        </div>
    </div>
</header>
