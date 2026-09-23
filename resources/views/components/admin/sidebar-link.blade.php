@props([
    'href',
    'icon',
    'active' => false,
])

<a href="{{ $href }}"
   @if($active) aria-current="page" data-sidebar-active="true" @endif
   {{ $attributes->merge([
       'class' => 'group relative flex items-center gap-3 rounded-2xl px-3 py-2 text-sm transition-all duration-300 ease-out transform hover:translate-x-1.5 ' . (
           $active
               ? 'bg-linear-to-r from-[#00A99D]/14 via-[#0BB5CB]/10 to-transparent text-slate-900 font-bold border border-[#0BB5CB]/35 shadow-xs shadow-[#0BB5CB]/10'
               : 'text-slate-600 hover:text-slate-900 hover:bg-linear-to-r hover:from-[#0BB5CB]/8 hover:to-transparent border border-transparent hover:border-[#0BB5CB]/20 font-medium'
       )
   ]) }}>
    <!-- Icon Container -->
    <div class="flex h-8.5 w-8.5 shrink-0 items-center justify-center rounded-xl transition-all duration-300 ease-out {{
        $active
            ? 'bg-linear-to-tr from-[#00A99D] to-[#0BB5CB] text-white shadow-sm shadow-[#00A99D]/30 scale-105'
            : 'bg-slate-100/80 text-slate-400 group-hover:bg-linear-to-tr group-hover:from-[#00A99D]/15 group-hover:to-[#0BB5CB]/20 group-hover:text-[#028DA9] group-hover:scale-110 group-hover:shadow-xs'
    }}">
        <i data-feather="{{ $icon }}" class="h-4 w-4 transition-transform duration-300"></i>
    </div>

    <!-- Label -->
    <span class="truncate transition-all duration-200 {{ $active ? 'text-slate-900 font-bold' : 'group-hover:text-slate-900 group-hover:font-semibold' }}">
        {{ $slot }}
    </span>

    <!-- Active / Hover Indicator Chevron -->
    <svg class="ml-auto h-3.5 w-3.5 shrink-0 transition-all duration-300 {{ $active ? 'text-[#028DA9] opacity-100 translate-x-0' : 'text-slate-300 opacity-0 -translate-x-1 group-hover:opacity-100 group-hover:translate-x-0 group-hover:text-[#028DA9]' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
    </svg>
</a>
