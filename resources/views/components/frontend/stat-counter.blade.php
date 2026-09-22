@props([
    'target' => 0,
    'label' => '',
    'icon' => 'activity',
    'suffix' => '+',
])

<div class="stat-counter-card flex items-center gap-4 sm:gap-5 bg-white rounded-2xl border border-slate-200/80 p-5 sm:p-6 shadow-xs transition-all duration-300 hover:shadow-lg hover:-translate-y-1 hover:border-[#0BB5CB]/40">
    <div class="w-13 h-13 rounded-2xl bg-linear-to-tr from-[#0BB5CB]/15 to-[#00A99D]/15 text-[#028DA9] flex items-center justify-center shrink-0 shadow-2xs">
        <i data-feather="{{ $icon }}" class="w-6 h-6"></i>
    </div>
    <div>
        <div class="flex items-baseline gap-0.5">
            <span class="stat-counter-number text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight"
                data-target="{{ $target }}">
                0
            </span>
            <span class="text-xl font-bold text-[#0BB5CB]">{{ $suffix }}</span>
        </div>
        <p class="text-xs sm:text-sm font-medium text-slate-500 mt-0.5">
            {{ $label }}
        </p>
    </div>
</div>
