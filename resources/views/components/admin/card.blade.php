@props([
    'title' => null,
    'description' => null,
])

<div {{ $attributes->merge(['class' => 'rounded-2xl border border-slate-200 bg-white shadow-sm overflow-hidden']) }}>
    @if($title || isset($headerActions))
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between border-b border-slate-100 px-6 py-4">
            <div>
                @if($title)
                    <h3 class="text-base font-semibold text-slate-900">{{ $title }}</h3>
                @endif
                @if($description)
                    <p class="mt-0.5 text-xs text-slate-500">{{ $description }}</p>
                @endif
            </div>

            @isset($headerActions)
                <div class="flex items-center gap-2">
                    {{ $headerActions }}
                </div>
            @endisset
        </div>
    @endif

    <div class="p-6">
        {{ $slot }}
    </div>
</div>
