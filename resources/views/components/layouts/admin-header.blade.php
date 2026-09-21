@php
    $user = auth()->user();
@endphp

<header class="sticky top-0 z-30 flex h-18 w-full items-center justify-between border-b border-slate-200/80 bg-white/95 px-4 sm:px-6 lg:px-8 backdrop-blur-md shadow-2xs">
    <!-- Left: Hamburger Toggle, Mobile Brand Context & Desktop Breadcrumb -->
    <div class="flex items-center gap-3 sm:gap-4 min-w-0">
        <!-- Mobile Sidebar Toggle Button -->
        <button type="button" 
                id="btn-sidebar-toggle" 
                class="lg:hidden flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-slate-200/80 bg-slate-50 text-slate-600 hover:bg-[#0BB5CB]/10 hover:text-[#028DA9] hover:border-[#0BB5CB]/30 transition-all duration-200 active:scale-95 cursor-pointer shadow-2xs">
            <i data-feather="menu" class="h-5 w-5"></i>
        </button>

        <!-- Mobile Brand Identity & Page Context -->
        <div class="flex items-center gap-2.5 sm:hidden min-w-0">
            <img src="{{ asset('dashboard/assets/image/favicon-kemnaker.png') }}" alt="Logo Kemkes" class="h-7 w-7 shrink-0 object-contain">
            <div class="flex flex-col min-w-0">
                <span class="truncate text-xs font-bold text-slate-900 leading-tight">PPM Poltekkes</span>
                <div class="flex items-center gap-1 mt-0.5">
                    <span class="h-1.5 w-1.5 shrink-0 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span class="truncate text-[10px] font-semibold text-[#028DA9] capitalize leading-none">{{ request()->segment(2) ?? 'Dashboard' }}</span>
                </div>
            </div>
        </div>

        <!-- Desktop Breadcrumb (Clean & Modern) -->
        <div class="hidden sm:flex items-center gap-2 text-xs font-semibold text-slate-400">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-slate-700 transition-colors">PPM Poltekkes</a>
            <i data-feather="chevron-right" class="h-3.5 w-3.5 text-slate-300"></i>
            <span class="inline-flex items-center gap-1.5 rounded-xl bg-[rgba(11,181,203,0.08)] px-2.5 py-1 text-xs font-bold text-[#028DA9] border border-[#0BB5CB]/20 shadow-2xs">
                <span class="h-1.5 w-1.5 rounded-full bg-[#0BB5CB]"></span>
                <span class="capitalize">{{ request()->segment(2) ?? 'Dashboard' }}</span>
            </span>
        </div>
    </div>

    <!-- Right: Profile & Logout -->
    <div class="flex items-center">
        <!-- User Profile Dropdown Menu -->
        <div id="user-profile-menu" class="relative group">
            <!-- Trigger Button -->
            <button type="button"
                    id="user-profile-btn"
                    aria-expanded="false"
                    aria-haspopup="true"
                    class="flex items-center gap-2.5 sm:gap-3 rounded-2xl border border-slate-200/80 bg-slate-50/70 hover:bg-white hover:border-[#0BB5CB]/40 hover:shadow-xs p-1.5 pl-2 sm:pl-3 pr-2 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-[#0BB5CB]/30 cursor-pointer">
                <div class="hidden md:block text-right">
                    <p class="text-xs font-bold text-slate-900 leading-tight">{{ $user->name ?? 'Admin' }}</p>
                    <p class="text-[11px] font-medium text-slate-400">{{ $user?->role?->label() ?? 'Admin' }}</p>
                </div>
                <div class="relative shrink-0">
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-linear-to-tr from-[#00A99D] to-[#0BB5CB] text-white font-bold text-xs shadow-sm ring-2 ring-white">
                        {{ strtoupper(substr($user->name ?? 'A', 0, 2)) }}
                    </div>
                    <span class="absolute -bottom-0.5 -right-0.5 h-2.5 w-2.5 rounded-full bg-emerald-500 ring-2 ring-white"></span>
                </div>
                <i data-feather="chevron-down" class="h-3.5 w-3.5 text-slate-400 transition-transform duration-200 group-hover:rotate-180 group-[.open]:rotate-180"></i>
            </button>

            <!-- Dropdown Menu Box -->
            <div id="user-profile-dropdown"
                 class="absolute right-0 top-full pt-2 w-48 opacity-0 pointer-events-none translate-y-1 transition-all duration-200 ease-out 
                        lg:group-hover:opacity-100 lg:group-hover:pointer-events-auto lg:group-hover:translate-y-0
                        group-[.open]:opacity-100 group-[.open]:pointer-events-auto group-[.open]:translate-y-0 z-50">
                <div class="rounded-2xl bg-white p-1.5 shadow-xl ring-1 ring-slate-900/5 border border-slate-100">
                    <!-- Logout Button -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                data-loading-text="Keluar..."
                                class="flex w-full items-center gap-2.5 rounded-xl px-3 py-2 text-xs font-semibold text-rose-600 hover:bg-rose-50 transition-colors cursor-pointer">
                            <i data-feather="log-out" class="h-4 w-4 text-rose-500"></i>
                            <span>Keluar dari Panel</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
