@props([
    'id' => 'modal-global-image-preview',
])

<div id="{{ $id }}" class="dashboard-modal fixed inset-0 z-50 hidden items-center justify-center bg-slate-950/80 backdrop-blur-md p-3 sm:p-4 overflow-hidden">
    <div class="modal-dialog relative flex flex-col w-full max-w-4xl max-h-[calc(100dvh-1.5rem)] sm:max-h-[calc(100vh-3rem)] rounded-3xl bg-white shadow-2xl border border-slate-100 overflow-hidden transform">
        <!-- Header (Pinned, Clean without clunky buttons) -->
        <div class="modal-header shrink-0 flex items-center justify-between border-b border-slate-100 px-5 sm:px-6 py-3.5 sm:py-4 bg-white sticky top-0 z-20">
            <div class="min-w-0 pr-4">
                <h3 id="global-image-modal-title" class="text-sm sm:text-base font-bold text-slate-900 truncate">Pratinjau Gambar</h3>
                <p class="text-[11px] text-slate-400 mt-0.5 hidden sm:block">Scroll untuk zoom, tahan & geser untuk memindahkan gambar</p>
            </div>

            <div class="flex items-center gap-1.5 shrink-0">
                <!-- Open Original in New Tab -->
                <a
                    id="global-image-modal-link"
                    href="#"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="rounded-xl p-2 text-slate-400 hover:bg-slate-100 hover:text-[#028DA9] transition-colors"
                    title="Buka gambar di tab baru"
                >
                    <i data-feather="external-link" class="h-4.5 w-4.5"></i>
                </a>

                <!-- Close Button -->
                <button
                    type="button"
                    data-modal-close
                    class="rounded-xl p-2 text-slate-400 hover:bg-slate-100 hover:text-slate-600 transition-colors cursor-pointer"
                    title="Tutup pratinjau"
                >
                    <i data-feather="x" class="h-5 w-5"></i>
                </button>
            </div>
        </div>

        <!-- Body with Interactive Gesture Zoom Container -->
        <div class="modal-body flex-1 overflow-hidden p-4 sm:p-6 flex items-center justify-center bg-slate-950/5 select-none touch-none relative" id="img-zoom-container">
            <div class="relative flex items-center justify-center will-change-transform select-none" id="img-zoom-wrapper">
                <img
                    id="global-image-modal-img"
                    src=""
                    alt="Pratinjau Gambar"
                    draggable="false"
                    class="max-h-[62dvh] sm:max-h-[70vh] w-auto max-w-full object-contain rounded-2xl shadow-md border border-slate-200/60 bg-white select-none pointer-events-none"
                >
            </div>
        </div>
    </div>
</div>
