@props([
    'name',
    'id' => null,
    'label',
    'description' => null,
    'value' => '1',
    'checked' => false,
])

@php
    $inputId = $id ?? ($name . '_' . \Illuminate\Support\Str::random(6));
@endphp

<label for="{{ $inputId }}" {{ $attributes->merge(['class' => 'group flex items-start gap-2.5 cursor-pointer select-none py-1']) }}>
    <div class="relative flex items-center justify-center shrink-0 mt-0.5">
        <input
            type="checkbox"
            name="{{ $name }}"
            id="{{ $inputId }}"
            value="{{ $value }}"
            @checked(old($name, $checked))
            class="peer sr-only"
        >
        <div class="h-4.5 w-4.5 rounded-md border border-slate-300 bg-white shadow-2xs transition-all duration-200 peer-hover:border-[#0BB5CB] peer-focus-visible:ring-4 peer-focus-visible:ring-[#0BB5CB]/20 peer-checked:border-[#00A99D] peer-checked:bg-linear-to-r peer-checked:from-[#00A99D] peer-checked:to-[#0BB5CB] flex items-center justify-center cursor-pointer">
            <svg class="h-3 w-3 text-white opacity-0 transition-opacity duration-200 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
        </div>
    </div>
    <div class="min-w-0">
        <span class="text-sm font-semibold text-slate-700 transition-colors duration-200 group-hover:text-slate-900 block leading-tight">{{ $label }}</span>
        @if($description)
            <p class="text-xs text-slate-400 mt-1 leading-normal">{{ $description }}</p>
        @endif
    </div>
</label>
