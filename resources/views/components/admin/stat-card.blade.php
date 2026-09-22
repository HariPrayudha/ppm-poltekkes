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
        'bg' => 'bg-emerald-50 group-hover:bg-emerald-100/80',
        'icon' => 'text-emerald-600',
        'badge' => 'bg-emerald-100/60 text-emerald-700',
        'accent' => 'from-emerald-400 to-teal-500',
    ],
    'warning' => [
        'bg' => 'bg-amber-50 group-hover:bg-amber-100/80',
        'icon' => 'text-amber-600',
        'badge' => 'bg-amber-100/60 text-amber-700',
        'accent' => 'from-amber-400 to-orange-500',
    ],
    'danger' => [
        'bg' => 'bg-rose-50 group-hover:bg-rose-100/80',
        'icon' => 'text-rose-600',
        'badge' => 'bg-rose-100/60 text-rose-700',
        'accent' => 'from-rose-400 to-red-500',
    ],
    'secondary' => [
        'bg' => 'bg-[#00A99D]/10 group-hover:bg-[#00A99D]/20',
        'icon' => 'text-[#00A99D]',
        'badge' => 'bg-[#00A99D]/15 text-[#00A99D]',
        'accent' => 'from-[#00A99D] to-[#46B58B]',
    ],
    default => [
        'bg' => 'bg-[rgba(11,181,203,0.1)] group-hover:bg-[rgba(11,181,203,0.2)]',
        'icon' => 'text-[#028DA9]',
        'badge' => 'bg-[rgba(11,181,203,0.15)] text-[#028DA9]',
        'accent' => 'from-[#00A99D] to-[#0BB5CB]',
    ],
};
@endphp

<div class="group relative overflow-hidden rounded-2xl border border-slate-200/90 bg-white p-4 sm:p-5 lg:p-6 shadow-xs transition-all duration-300 ease-out hover:-translate-y-1.5 hover:shadow-xl hover:shadow-[#0BB5CB]/12 hover:border-[#0BB5CB]/35 h-full flex flex-col justify-between">
    <!-- Top Accent Gradient Line -->
    <div class="absolute top-0 left-0 right-0 h-1 bg-linear-to-r {{ $colorStyles['accent'] }} opacity-70 group-hover:opacity-100 transition-opacity duration-300"></div>

    <!-- Subtle Ambient Glow -->
    <div class="absolute -right-10 -bottom-10 h-32 w-32 rounded-full bg-linear-to-br {{ $colorStyles['accent'] }} opacity-0 blur-2xl transition-all duration-500 group-hover:opacity-15 pointer-events-none"></div>

    <div class="relative z-10 flex items-start justify-between gap-3">
        <div class="min-w-0 flex-1">
            <p class="text-[11px] sm:text-xs font-bold uppercase tracking-wider text-slate-500 min-h-7 sm:min-h-9 flex items-center leading-snug line-clamp-2">
                {{ $label }}
            </p>
            <h3 class="mt-1.5 sm:mt-2 text-2xl sm:text-3xl font-extrabold tracking-tight text-slate-900 leading-none">
                {{ $value }}
            </h3>
        </div>
        <div class="shrink-0 rounded-2xl {{ $colorStyles['bg'] }} p-2.5 sm:p-3.5 flex items-center justify-center shadow-2xs transition-all duration-300 ease-out group-hover:scale-110 group-hover:rotate-3">
            <i data-feather="{{ $icon }}" class="h-5 w-5 sm:h-6 sm:w-6 {{ $colorStyles['icon'] }}"></i>
        </div>
    </div>
    @if($subtext)
        <div class="relative z-10 mt-3 sm:mt-4 pt-2.5 sm:pt-3 border-t border-slate-100/80 min-h-7 sm:min-h-8 flex items-center">
            <p class="text-[11px] sm:text-xs text-slate-400 leading-relaxed line-clamp-2">{{ $subtext }}</p>
        </div>
    @endif
</div>
