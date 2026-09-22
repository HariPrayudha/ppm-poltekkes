@props([
    'name',
    'label' => null,
    'required' => false,
    'hint' => null,
    'id' => null,
])

@php
    $selectId = $id ?? $name;
    $hasError = $errors->has($name);
@endphp

<div {{ $attributes->only('class')->merge(['class' => 'custom-select-wrapper relative']) }}>
    @if($label)
        <label for="{{ $selectId }}" class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-1.5">
            {{ $label }}
            @if($required)
                <span class="text-rose-500">*</span>
            @endif
        </label>
    @endif

    <!-- Hidden native select for standard form submissions & validation -->
    <select
        name="{{ $name }}"
        id="{{ $selectId }}"
        @if($required) required @endif
        {{ $attributes->except(['class', 'name', 'label', 'required', 'hint', 'id']) }}
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
            class="custom-select-trigger w-full flex items-center justify-between rounded-xl border px-3.5 py-2.5 text-sm bg-white text-slate-900 transition-all text-left cursor-pointer shadow-2xs hover:border-slate-300 {{ $hasError ? 'border-rose-500 ring-4 ring-rose-500/10' : 'border-slate-200 focus:border-[#0BB5CB] focus:ring-4 focus:ring-[#0BB5CB]/10' }}"
            aria-haspopup="listbox"
            aria-expanded="false"
        >
            <span class="custom-select-label truncate font-medium text-slate-800">-- Pilih --</span>
            <svg class="custom-select-chevron h-4 w-4 shrink-0 text-slate-400 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <!-- Custom Dropdown Options Menu (Styled Floating Menu) -->
        <div class="custom-select-menu absolute left-0 right-0 z-50 mt-1.5 hidden rounded-2xl border border-slate-200/90 bg-white p-1.5 shadow-xl max-h-60 overflow-y-auto transform origin-top transition-all duration-150">
            <div class="custom-select-options space-y-0.5" role="listbox">
                <!-- Dynamically populated from native select options by JS -->
            </div>
        </div>
    </div>

    @if($hint)
        <p class="mt-1 text-xs text-slate-400">{{ $hint }}</p>
    @endif

    @error($name)
        <p class="mt-1 text-xs text-rose-600 flex items-center gap-1">
            <i data-feather="alert-circle" class="h-3.5 w-3.5"></i>
            {{ $message }}
        </p>
    @enderror
</div>
