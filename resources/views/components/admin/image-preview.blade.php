@props([
    'src' => null,
    'alt' => '',
    'label' => 'Pratinjau Gambar Saat Ini (Klik untuk memperbesar)',
    'height' => 'h-32',
    'imgId' => null,
    'wrapperId' => null,
])

<div {{ $attributes->merge(['class' => 'mt-2 ' . ($src ? '' : 'hidden')]) }}>
    @if($label)
        <p class="text-xs font-semibold text-slate-500 mb-1.5">{{ $label }}</p>
    @endif
    <div class="relative inline-block overflow-hidden rounded-xl border border-slate-200 bg-slate-50 p-1 group cursor-pointer max-w-full"
         @if($wrapperId) id="{{ $wrapperId }}" @endif
         data-preview-image="{{ $src ?: '' }}"
         data-preview-title="{{ $alt ?: 'Pratinjau Gambar' }}"
         title="Klik untuk memperbesar gambar">
        <img @if($imgId) id="{{ $imgId }}" @endif
             src="{{ $src ?: '' }}"
             alt="{{ $alt }}"
             class="{{ $height }} w-auto max-w-full object-contain rounded-lg transition-transform duration-300 group-hover:scale-[1.02]">
        <div class="absolute inset-0 bg-slate-950/20 opacity-0 group-hover:opacity-100 transition-opacity rounded-xl flex items-center justify-center pointer-events-none">
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-white/95 text-slate-900 text-xs font-bold shadow-md">
                <i data-feather="zoom-in" class="h-4 w-4 text-[#028DA9]"></i>
                <span>Klik untuk Zoom</span>
            </span>
        </div>
    </div>
</div>

