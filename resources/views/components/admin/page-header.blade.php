@props([
    'title',
    'description' => null,
])

<div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between mb-6 sm:mb-8">
    <div class="min-w-0">
        <h1 class="text-xl sm:text-2xl font-bold tracking-tight text-slate-900 leading-snug">{{ $title }}</h1>
        @if($description)
            <p class="mt-1 text-xs sm:text-sm text-slate-500 leading-relaxed">{{ $description }}</p>
        @endif
    </div>

    @isset($actions)
        <div class="flex flex-wrap items-center gap-2.5 w-full sm:w-auto">
            {{ $actions }}
        </div>
    @endisset
</div>
