@props([
    'href',
    'icon',
    'active' => false,
])

<a href="{{ $href }}"
   @if($active) aria-current="page" data-sidebar-active="true" @endif
   {{ $attributes->merge([
       'class' => 'group flex items-center gap-3 rounded-2xl px-3 py-2 text-sm transition-all duration-200 ' . (
           $active
               ? 'bg-linear-to-r from-[#00A99D]/12 via-[#0BB5CB]/8 to-transparent text-slate-900 font-bold border border-[#0BB5CB]/25 shadow-xs'
               : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50/80 border border-transparent font-medium'
       )
   ]) }}>
    <!-- Icon Container -->
    <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-xl transition-all duration-200 {{
        $active
            ? 'bg-linear-to-tr from-[#00A99D] to-[#0BB5CB] text-white shadow-sm shadow-[#00A99D]/25'
            : 'bg-slate-100/80 text-slate-400 group-hover:bg-[#0BB5CB]/10 group-hover:text-[#028DA9] group-hover:scale-105'
    }}">
        <i data-feather="{{ $icon }}" class="h-4 w-4"></i>
    </div>

    <!-- Label -->
    <span class="truncate transition-colors {{ $active ? 'text-slate-900 font-bold' : 'group-hover:text-slate-900' }}">
        {{ $slot }}
    </span>
</a>
