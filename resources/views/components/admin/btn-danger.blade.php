@props([
    'type' => 'button',
    'href' => null,
])

@php
    $baseClasses = 'inline-flex items-center justify-center gap-2 rounded-xl bg-rose-600 px-3.5 py-1.5 text-xs font-semibold text-white shadow-xs shadow-rose-600/20 transform transition-all duration-300 ease-out hover:-translate-y-1 hover:bg-rose-700 hover:shadow-xs active:translate-y-0 active:scale-[0.99] cursor-pointer disabled:opacity-60 disabled:pointer-events-none select-none';
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $baseClasses]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $baseClasses]) }}>
        {{ $slot }}
    </button>
@endif


