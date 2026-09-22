@props([
    'badge' => null,
    'title' => '',
    'description' => null,
    'align' => 'center',
])

@php
    $isCenter = $align === 'center';
    $containerClass = $isCenter ? 'text-center mx-auto items-center' : 'text-left items-start';
@endphp

<div class="flex flex-col {{ $containerClass }} max-w-3xl mb-12 sm:mb-16">
    @if($badge)
        <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-[#0BB5CB]/10 border border-[#0BB5CB]/25 text-[#028DA9] text-xs font-semibold uppercase tracking-wider mb-3">
            <span class="w-1.5 h-1.5 rounded-full bg-[#00A99D]"></span>
            {{ $badge }}
        </div>
    @endif

    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight">
        {{ $title }}
    </h2>

    <div class="h-1 w-16 bg-linear-to-r from-[#0BB5CB] to-[#00A99D] rounded-full my-4"></div>

    @if($description)
        <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
            {{ $description }}
        </p>
    @endif
</div>
