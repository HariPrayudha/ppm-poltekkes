@props([
    'type' => 'button',
    'href' => null,
])

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => 'btn-danger']) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => 'btn-danger']) }}>
        {{ $slot }}
    </button>
@endif
