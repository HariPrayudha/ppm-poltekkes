@props([
    'label',
    'value',
    'icon' => 'activity',
    'color' => 'primary',
    'subtext' => null,
])

@php
$colorStyles = match($color) {
    'success' => [
        'bg' => 'bg-emerald-50',
        'icon' => 'text-emerald-600',
        'badge' => 'bg-emerald-100/60 text-emerald-700',
    ],
    'warning' => [
        'bg' => 'bg-amber-50',
        'icon' => 'text-amber-600',
        'badge' => 'bg-amber-100/60 text-amber-700',
    ],
    'danger' => [
        'bg' => 'bg-rose-50',
        'icon' => 'text-rose-600',
        'badge' => 'bg-rose-100/60 text-rose-700',
    ],
    'secondary' => [
        'bg' => 'bg-[#00A99D]/10',
        'icon' => 'text-[#00A99D]',
        'badge' => 'bg-[#00A99D]/15 text-[#00A99D]',
    ],
    default => [
        'bg' => 'bg-[rgba(11,181,203,0.1)]',
        'icon' => 'text-[#028DA9]',
        'badge' => 'bg-[rgba(11,181,203,0.15)] text-[#028DA9]',
    ],
};
@endphp

<div class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-4 sm:p-5 lg:p-6 shadow-2xs transition-all duration-200 hover:shadow-md hover:border-slate-300 h-full flex flex-col justify-between">
    <div class="flex items-start justify-between gap-3">
        <div class="min-w-0 flex-1">
            <p class="text-[11px] sm:text-xs font-bold uppercase tracking-wider text-slate-500 min-h-7 sm:min-h-9 flex items-center leading-snug line-clamp-2">
                {{ $label }}
            </p>
            <h3 class="mt-1.5 sm:mt-2 text-2xl sm:text-3xl font-extrabold tracking-tight text-slate-900 leading-none">
                {{ $value }}
            </h3>
        </div>
        <div class="shrink-0 rounded-2xl {{ $colorStyles['bg'] }} p-2.5 sm:p-3.5 flex items-center justify-center shadow-2xs">
            <i data-feather="{{ $icon }}" class="h-5 w-5 sm:h-6 sm:w-6 {{ $colorStyles['icon'] }}"></i>
        </div>
    </div>
    @if($subtext)
        <div class="mt-3 sm:mt-4 pt-2.5 sm:pt-3 border-t border-slate-100/80 min-h-7 sm:min-h-8 flex items-center">
            <p class="text-[11px] sm:text-xs text-slate-400 leading-relaxed line-clamp-2">{{ $subtext }}</p>
        </div>
    @endif
</div>
