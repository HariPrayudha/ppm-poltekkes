@props([
    'id' => 'frontend-image-modal',
])

<div id="{{ $id }}"
    role="dialog"
    aria-modal="true"
    aria-labelledby="frontend-image-modal-title"
    class="fixed inset-0 z-99999 hidden items-center justify-center bg-slate-950/80 backdrop-blur-md p-3 sm:p-4 overflow-hidden opacity-0 transition-opacity duration-300 ease-out">
    
    <div id="frontend-image-modal-dialog"
        class="relative flex flex-col w-full max-w-4xl max-h-[calc(100dvh-1.5rem)] sm:max-h-[calc(100vh-3rem)] rounded-3xl bg-white shadow-2xl border border-slate-100 overflow-hidden transform scale-95 opacity-0 transition-all duration-300 ease-out">
        
        <!-- Header (Pinned, Clean, Non-scrolling) -->
        <div class="shrink-0 flex items-center justify-between border-b border-slate-100 px-5 sm:px-6 py-3.5 sm:py-4 bg-white sticky top-0 z-20">
            <div class="min-w-0 pr-4">
                <h3 id="frontend-image-modal-title" class="text-sm sm:text-base font-bold text-slate-900 truncate">Pratinjau Foto</h3>
                <p class="text-[11px] text-slate-400 mt-0.5 hidden sm:block">Scroll mouse untuk zoom, klik & tahan untuk menggeser foto</p>
            </div>

            <div class="flex items-center gap-1.5 shrink-0">
                <!-- Open Original in New Tab -->
                <a id="frontend-image-modal-link"
                    href="#"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="rounded-xl p-2 text-slate-400 hover:bg-slate-100 hover:text-[#028DA9] transition-colors"
                    title="Buka gambar ukuran penuh di tab baru">
                    <i data-feather="external-link" class="w-4.5 h-4.5"></i>
                </a>

                <!-- Close Button -->
                <button id="frontend-image-modal-close"
                    type="button"
                    aria-label="Tutup pratinjau foto"
                    class="rounded-xl p-2 text-slate-400 hover:bg-slate-100 hover:text-slate-600 transition-colors cursor-pointer"
                    title="Tutup pratinjau">
                    <i data-feather="x" class="w-5 h-5"></i>
                </button>
            </div>
        </div>

        <!-- Body with Interactive Gesture Zoom & Pan Container -->
        <div class="flex-1 overflow-hidden p-4 sm:p-6 flex items-center justify-center bg-slate-950/5 select-none touch-none relative cursor-default" id="frontend-img-zoom-container">
            <div class="relative flex items-center justify-center will-change-transform select-none" id="frontend-img-zoom-wrapper">
                <img id="frontend-image-modal-img"
                    src=""
                    alt="Pratinjau Foto Penuh"
                    draggable="false"
                    class="max-h-[62dvh] sm:max-h-[70vh] w-auto max-w-full object-contain rounded-2xl shadow-md border border-slate-200/60 bg-white select-none pointer-events-none">
            </div>
        </div>
    </div>
</div>
