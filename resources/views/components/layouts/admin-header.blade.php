@php
    $user = auth()->user();
@endphp

<header class="sticky top-0 z-30 flex h-16 w-full items-center justify-between border-b border-slate-200/80 bg-white/90 px-4 sm:px-6 lg:px-8 backdrop-blur-md">
    <!-- Left: Hamburger Toggle & Breadcrumb -->
    <div class="flex items-center gap-4">
        <button type="button" id="btn-sidebar-toggle" class="lg:hidden rounded-xl p-2 text-slate-500 hover:bg-slate-100 hover:text-slate-800 transition-colors">
            <i data-feather="menu" class="h-5 w-5"></i>
        </button>

        <div class="hidden sm:flex items-center gap-2 text-xs font-semibold text-slate-400">
            <span>PPM Poltekkes</span>
            <span>/</span>
            <span class="text-slate-700 capitalize">{{ request()->segment(2) ?? 'Dashboard' }}</span>
        </div>
    </div>

    <!-- Right: Quick Links & Profile -->
    <div class="flex items-center gap-3">
        <!-- View Public Site Link -->
        <a href="{{ url('/') }}" target="_blank" class="hidden sm:inline-flex items-center gap-1.5 rounded-xl border border-slate-200 bg-white px-3 py-1.5 text-xs font-semibold text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition-all">
            <i data-feather="external-link" class="h-3.5 w-3.5 text-slate-400"></i>
            <span>Lihat Website</span>
        </a>

        <!-- User Greeting -->
        <div class="flex items-center gap-3 pl-2 border-l border-slate-200/80">
            <div class="hidden md:block text-right">
                <p class="text-xs font-bold text-slate-900 leading-tight">{{ $user->name ?? 'Admin' }}</p>
                <p class="text-[11px] font-medium text-slate-400">{{ $user?->role?->label() ?? 'Admin' }}</p>
            </div>
            <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-linear-to-tr from-[#00A99D] to-[#0BB5CB] text-white font-bold text-xs shadow-sm">
                {{ strtoupper(substr($user->name ?? 'A', 0, 2)) }}
            </div>
        </div>
    </div>
</header>
