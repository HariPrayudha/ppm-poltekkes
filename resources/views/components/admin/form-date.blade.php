@props([
    'name',
    'label' => null,
    'value' => null,
    'placeholder' => 'Pilih tanggal pelaksanaan...',
    'required' => false,
    'hint' => null,
])

<div {{ $attributes->only('class') }}>
    @if($label)
        <label for="{{ $name }}" class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-1.5">
            {{ $label }}
            @if($required)
                <span class="text-rose-500">*</span>
            @endif
        </label>
    @endif

    @php
        $hasError = $errors->has($name);
        $val = $value ?? old($name);
        $borderClass = $hasError 
            ? 'border-rose-500 ring-4 ring-rose-500/10 focus-within:border-rose-500' 
            : 'border-slate-200 hover:border-[#0BB5CB] focus-within:border-[#0BB5CB] focus-within:ring-4 focus-within:ring-[#0BB5CB]/10';
    @endphp

    <div class="relative group cursor-pointer" data-date-trigger="{{ $name }}">
        <input
            type="text"
            name="{{ $name }}"
            id="{{ $name }}"
            value="{{ $val }}"
            placeholder="{{ $placeholder }}"
            readonly
            @if($required) required @endif
            class="custom-date-picker w-full rounded-xl border bg-white px-3.5 py-2.5 pr-10 text-sm font-medium text-slate-800 placeholder:text-slate-400 cursor-pointer select-none transition-all outline-none {{ $borderClass }}"
            {{ $attributes->except(['class', 'name', 'label', 'value', 'placeholder', 'required', 'hint']) }}
        >

        <div class="absolute inset-y-0 right-0 flex items-center pr-3.5 pointer-events-none text-slate-400 group-hover:text-[#028DA9] transition-colors">
            <i data-feather="calendar" class="h-4 w-4"></i>
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
