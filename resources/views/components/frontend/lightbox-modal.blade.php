<div id="lightbox-modal"
    role="dialog"
    aria-modal="true"
    aria-labelledby="lightbox-title"
    class="fixed inset-0 z-9999 hidden items-center justify-center p-4 sm:p-6 bg-slate-950/85 backdrop-blur-md transition-opacity duration-300">
    <!-- Close Button -->
    <button id="lightbox-close"
        type="button"
        aria-label="Tutup pratinjau"
        class="absolute top-4 right-4 sm:top-6 sm:right-6 p-2.5 rounded-full bg-white/10 hover:bg-white/20 text-white transition-colors cursor-pointer z-10 focus:outline-hidden">
        <i data-feather="x" class="w-6 h-6"></i>
    </button>

    <!-- Modal Content Box -->
    <div class="relative max-w-5xl w-full max-h-[90vh] flex flex-col items-center justify-center">
        <div class="relative w-full overflow-hidden rounded-2xl bg-black/40 shadow-2xl flex items-center justify-center">
            <img id="lightbox-img"
                src=""
                alt="Pratinjau Foto"
                class="max-h-[75vh] w-auto max-w-full object-contain rounded-xl transition-transform duration-300">
        </div>
        <p id="lightbox-title" class="mt-3 text-center text-sm sm:text-base font-medium text-white/90 drop-shadow-sm px-4">
        </p>
    </div>
</div>
