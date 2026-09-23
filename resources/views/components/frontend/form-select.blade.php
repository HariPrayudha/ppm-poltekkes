@props([
    'name',
    'id' => null,
    'label' => null,
    'icon' => null,
    'placeholder' => '-- Pilih --',
])

@php
    $selectId = $id ?? $name;
@endphp

<div {{ $attributes->only('class')->merge(['class' => 'custom-select-wrapper relative']) }}>
    @if($label)
        <label for="{{ $selectId }}" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5 select-none">
            {{ $label }}
        </label>
    @endif

    <!-- Hidden Native Select (Synchronized via JS for clean form & AJAX handling) -->
    <select
        name="{{ $name }}"
        id="{{ $selectId }}"
        {{ $attributes->except(['class', 'name', 'label', 'icon', 'placeholder', 'id']) }}
        class="custom-select-native sr-only"
        tabindex="-1"
        aria-hidden="true"
    >
        {{ $slot }}
    </select>

    <!-- Custom Dropdown Trigger Button -->
    <div class="relative">
        <button
            type="button"
            class="custom-select-trigger w-full flex items-center justify-between gap-2.5 rounded-2xl border border-slate-200/90 bg-white px-3.5 sm:px-4 py-2.5 sm:py-3 text-xs sm:text-sm text-slate-800 transition-all duration-200 text-left cursor-pointer shadow-2xs hover:border-[#0BB5CB]/50 hover:bg-slate-50/50 focus:outline-hidden focus:border-[#0BB5CB] focus:ring-4 focus:ring-[#0BB5CB]/10"
            aria-haspopup="listbox"
            aria-expanded="false"
        >
            <div class="flex items-center gap-2.5 min-w-0">
                @if($icon)
                    <div class="w-6 h-6 rounded-lg bg-slate-100 flex items-center justify-center text-slate-400 shrink-0">
                        <i data-feather="{{ $icon }}" class="w-3.5 h-3.5"></i>
                    </div>
                @endif
                <span class="custom-select-label truncate font-semibold text-slate-700">
                    {{ $placeholder }}
                </span>
            </div>
            <svg class="custom-select-chevron h-4 w-4 shrink-0 text-slate-400 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <!-- Custom Dropdown Options Menu (Styled Floating Menu) -->
        <div class="custom-select-menu absolute left-0 right-0 z-50 mt-1.5 hidden rounded-2xl border border-slate-200/90 bg-white/98 backdrop-blur-md p-1.5 shadow-xl max-h-60 overflow-y-auto transform origin-top transition-all duration-150 ring-1 ring-slate-900/5">
            <div class="custom-select-options space-y-0.5" role="listbox">
                <!-- Dynamically populated from native select options by JS -->
            </div>
        </div>
    </div>
</div>
