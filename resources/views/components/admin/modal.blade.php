@props([
    'id',
    'title',
    'maxWidth' => 'max-w-xl',
])

<div id="{{ $id }}" class="dashboard-modal fixed inset-0 z-50 hidden items-center justify-center bg-slate-950/50 backdrop-blur-xs sm:backdrop-blur-sm p-3 sm:p-4 overflow-hidden">
    <div class="modal-dialog flex flex-col w-full {{ $maxWidth }} max-h-[calc(100dvh-1.5rem)] sm:max-h-[calc(100vh-3.5rem)] rounded-3xl bg-white shadow-2xl border border-slate-100 overflow-hidden transform">
        <!-- Modal Header (Pinned, Never Scrolls) -->
        <div class="modal-header shrink-0 flex items-center justify-between border-b border-slate-100 px-5 sm:px-6 py-4 bg-white sticky top-0 z-20">
            <h3 class="text-base font-bold text-slate-900 truncate pr-2">{{ $title }}</h3>
            <button type="button" data-modal-close class="rounded-xl p-1.5 text-slate-400 hover:bg-slate-100 hover:text-slate-600 transition-colors cursor-pointer shrink-0">
                <i data-feather="x" class="h-5 w-5"></i>
            </button>
        </div>

        <!-- Modal Body (The Only Scrollable Container) -->
        <div class="modal-body flex-1 overflow-y-auto p-5 sm:p-6 overscroll-contain">
            {{ $slot }}
        </div>

        @isset($footer)
            <div class="modal-footer shrink-0 flex flex-col-reverse sm:flex-row items-stretch sm:items-center justify-end gap-2.5 border-t border-slate-100 bg-slate-50/80 px-5 sm:px-6 py-3.5 sm:py-4 sticky bottom-0 z-20 [&>*]:w-full sm:[&>*]:w-auto">
                {{ $footer }}
            </div>
        @endisset
    </div>
</div>
