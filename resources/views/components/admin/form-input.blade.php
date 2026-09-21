@props([
    'name',
    'label' => null,
    'type' => 'text',
    'value' => null,
    'placeholder' => '',
    'required' => false,
    'hint' => null,
    'readonly' => false,
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
        $inputClasses = 'w-full rounded-xl border px-3.5 py-2.5 text-sm placeholder:text-slate-400 transition-all focus:outline-none';
        $inputClasses .= $hasError ? ' border-rose-500 ring-4 ring-rose-500/10 focus:border-rose-500' : ' border-slate-200 focus:border-[#0BB5CB] focus:ring-4 focus:ring-[#0BB5CB]/10';
        $inputClasses .= $readonly ? ' bg-slate-50 text-slate-500 cursor-not-allowed' : ' bg-white text-slate-900';
    @endphp

    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ $value ?? old($name) }}"
        placeholder="{{ $placeholder }}"
        @if($required) required @endif
        @if($readonly) readonly @endif
        {{ $attributes->except(['class', 'name', 'label', 'type', 'value', 'placeholder', 'required', 'hint', 'readonly']) }}
        class="{{ $inputClasses }}"
    >

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
