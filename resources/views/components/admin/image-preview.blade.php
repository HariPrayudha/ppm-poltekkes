@props([
    'src',
    'alt' => '',
    'label' => 'Pratinjau Gambar Saat Ini',
    'height' => 'h-32',
])

@if($src)
    <div {{ $attributes->merge(['class' => 'mt-2']) }}>
        <p class="text-xs font-semibold text-slate-500 mb-1.5">{{ $label }}</p>
        <div class="relative inline-block overflow-hidden rounded-xl border border-slate-200 bg-slate-50 p-1">
            <img src="{{ $src }}" alt="{{ $alt }}" class="{{ $height }} w-auto object-contain rounded-lg">
        </div>
    </div>
@endif
