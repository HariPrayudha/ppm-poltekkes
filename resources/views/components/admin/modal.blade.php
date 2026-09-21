@props([
    'id',
    'title',
    'maxWidth' => 'max-w-xl',
])

<div id="{{ $id }}" class="dashboard-modal fixed inset-0 z-50 hidden items-center justify-center bg-slate-950/50 backdrop-blur-sm p-4 overflow-y-auto">
    <div class="w-full {{ $maxWidth }} my-8 rounded-3xl bg-white shadow-2xl border border-slate-100 overflow-hidden transform transition-all">
        <!-- Modal Header -->
        <div class="flex items-center justify-between border-b border-slate-100 px-6 py-4 bg-slate-50/50">
            <h3 class="text-base font-bold text-slate-900">{{ $title }}</h3>
            <button type="button" data-modal-close class="rounded-xl p-1.5 text-slate-400 hover:bg-slate-100 hover:text-slate-600 transition-colors">
                <i data-feather="x" class="h-5 w-5"></i>
            </button>
        </div>

        <!-- Modal Body & Optional Footer (often inside form) -->
        <div class="p-6">
            {{ $slot }}
        </div>

        @isset($footer)
            <div class="flex items-center justify-end gap-2.5 border-t border-slate-100 bg-slate-50/60 px-6 py-4">
                {{ $footer }}
            </div>
        @endisset
    </div>
</div>
