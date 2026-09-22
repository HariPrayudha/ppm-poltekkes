@props([
    'type' => 'button',
    'href' => null,
])

@php
    $baseClasses = 'group relative inline-flex items-center justify-center gap-2 overflow-hidden rounded-xl bg-linear-to-r from-[#00A99D] to-[#0BB5CB] px-4 py-2 text-sm font-semibold text-white shadow-xs shadow-[#00A99D]/20 transform transition-all duration-300 ease-out hover:-translate-y-1 hover:shadow-md hover:shadow-[#00A99D]/25 active:translate-y-0 active:scale-[0.99] cursor-pointer disabled:opacity-60 disabled:pointer-events-none select-none';
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $baseClasses]) }}>
        <span class="absolute inset-0 bg-linear-to-r from-[#028DA9] to-[#00A99D] opacity-0 transition-opacity duration-300 ease-out group-hover:opacity-100 pointer-events-none"></span>
        <span class="relative z-10 flex items-center justify-center gap-2">
            {{ $slot }}
        </span>
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $baseClasses]) }}>
        <span class="absolute inset-0 bg-linear-to-r from-[#028DA9] to-[#00A99D] opacity-0 transition-opacity duration-300 ease-out group-hover:opacity-100 pointer-events-none"></span>
        <span class="relative z-10 flex items-center justify-center gap-2">
            {{ $slot }}
        </span>
    </button>
@endif



