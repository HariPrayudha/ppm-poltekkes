@props([
    'title' => null,
    'description' => null,
    'overflow' => false,
])

<div {{ $attributes->merge(['class' => 'rounded-2xl border border-slate-200 bg-white shadow-2xs ' . ($overflow ? 'overflow-visible' : 'overflow-hidden')]) }}>
    @if($title || isset($headerActions))
        <div class="shrink-0 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between border-b border-slate-100 px-4 py-3.5 sm:px-6 sm:py-4">
            <div>
                @if($title)
                    <h3 class="text-sm sm:text-base font-semibold text-slate-900 leading-tight">{{ $title }}</h3>
                @endif
                @if($description)
                    <p class="mt-0.5 text-[11px] sm:text-xs text-slate-500">{{ $description }}</p>
                @endif
            </div>

            @isset($headerActions)
                <div class="flex items-center gap-2">
                    {{ $headerActions }}
                </div>
            @endisset
        </div>
    @endif

    <div class="p-4 sm:p-6 flex-1 flex flex-col">
        {{ $slot }}
    </div>
</div>
