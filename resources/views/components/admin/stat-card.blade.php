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

<div class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition-all hover:shadow-md hover:border-slate-300">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">{{ $label }}</p>
            <h3 class="mt-2 text-3xl font-extrabold tracking-tight text-slate-900">{{ $value }}</h3>
            @if($subtext)
                <p class="mt-1 text-xs text-slate-400">{{ $subtext }}</p>
            @endif
        </div>
        <div class="rounded-2xl {{ $colorStyles['bg'] }} p-3.5 flex items-center justify-center">
            <i data-feather="{{ $icon }}" class="h-6 w-6 {{ $colorStyles['icon'] }}"></i>
        </div>
    </div>
</div>
