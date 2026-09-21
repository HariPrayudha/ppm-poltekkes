@props([
    'src',
    'alt' => '',
    'label' => 'Pratinjau Gambar Saat Ini (Klik untuk memperbesar)',
    'height' => 'h-32',
])

@if($src)
    <div {{ $attributes->merge(['class' => 'mt-2']) }}>
        <p class="text-xs font-semibold text-slate-500 mb-1.5">{{ $label }}</p>
        <div class="relative inline-block overflow-hidden rounded-xl border border-slate-200 bg-slate-50 p-1 group cursor-pointer"
             data-preview-image="{{ $src }}"
             data-preview-title="{{ $alt ?: 'Pratinjau Gambar' }}"
             title="Klik untuk memperbesar gambar">
            <img src="{{ $src }}" alt="{{ $alt }}" class="{{ $height }} w-auto object-contain rounded-lg transition-transform duration-300 group-hover:scale-105">
            <div class="absolute inset-0 bg-slate-950/20 opacity-0 group-hover:opacity-100 transition-opacity rounded-xl flex items-center justify-center pointer-events-none">
                <i data-feather="zoom-in" class="h-5 w-5 text-white drop-shadow-md"></i>
            </div>
        </div>
    </div>
@endif
