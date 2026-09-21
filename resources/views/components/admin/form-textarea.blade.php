@props([
    'name',
    'label' => null,
    'value' => null,
    'rows' => 3,
    'placeholder' => '',
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
        $textareaClasses = 'w-full rounded-xl border px-3.5 py-2.5 text-sm bg-white text-slate-900 placeholder:text-slate-400 transition-all focus:outline-none';
        $textareaClasses .= $hasError ? ' border-rose-500 ring-4 ring-rose-500/10 focus:border-rose-500' : ' border-slate-200 focus:border-[#0BB5CB] focus:ring-4 focus:ring-[#0BB5CB]/10';
    @endphp

    <textarea
        name="{{ $name }}"
        id="{{ $name }}"
        rows="{{ $rows }}"
        placeholder="{{ $placeholder }}"
        @if($required) required @endif
        {{ $attributes->except(['class', 'name', 'label', 'value', 'rows', 'placeholder', 'required', 'hint']) }}
        class="{{ $textareaClasses }}"
    >{{ $value ?? old($name) }}</textarea>

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
