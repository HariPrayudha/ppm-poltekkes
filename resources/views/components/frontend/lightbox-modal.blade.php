<div id="lightbox-modal"
    role="dialog"
    aria-modal="true"
    aria-labelledby="lightbox-title"
    class="fixed inset-0 z-9999 hidden items-center justify-center p-3.5 sm:p-6 bg-slate-950/80 backdrop-blur-md opacity-0 transition-opacity duration-300 ease-out overflow-hidden">

    <!-- Modal Card Dialog -->
    <div id="lightbox-dialog"
        class="relative max-w-3xl w-full max-h-[calc(100dvh-2.5rem)] sm:max-h-[calc(100vh-4rem)] flex flex-col rounded-3xl bg-white shadow-2xl border border-slate-200/90 overflow-hidden transform scale-95 opacity-0 transition-all duration-300 ease-out">
        
        <!-- Pinned Header (Close Button Never Scrolls Away) -->
        <div class="shrink-0 flex items-center justify-between border-b border-slate-100 px-5 sm:px-6 py-4 bg-white/95 backdrop-blur-md sticky top-0 z-30">
            <div class="flex items-center gap-2.5 min-w-0 pr-3">
                <div class="w-8 h-8 rounded-xl bg-linear-to-tr from-[#00A99D]/10 to-[#0BB5CB]/10 text-[#028DA9] flex items-center justify-center shrink-0">
                    <i data-feather="image" class="w-4 h-4"></i>
                </div>
                <div class="min-w-0">
                    <span class="block text-[11px] font-bold uppercase tracking-wider text-slate-400">Detail Dokumentasi</span>
                    <span id="lightbox-header-title" class="block text-xs font-semibold text-slate-800 truncate"></span>
                </div>
            </div>
            <button id="lightbox-close"
                type="button"
                aria-label="Tutup detail dokumentasi"
                class="rounded-xl p-2 text-slate-400 hover:text-slate-700 hover:bg-slate-100 transition-colors cursor-pointer shrink-0 focus:outline-hidden">
                <i data-feather="x" class="w-5 h-5"></i>
            </button>
        </div>

        <!-- Scrollable Modal Body -->
        <div class="flex-1 overflow-y-auto p-5 sm:p-7 space-y-5 overscroll-contain">
            <!-- High-Res Image Showcase (Full Width, No Horizontal Letterbox Bars) -->
            <div id="lightbox-img-trigger"
                class="relative w-full aspect-16/10 sm:aspect-16/9 rounded-2xl overflow-hidden bg-slate-900 border border-slate-200/80 cursor-zoom-in group/img select-none"
                title="Klik untuk memperbesar foto (Zoom & Pan)">
                <img id="lightbox-img"
                    src=""
                    alt="Pratinjau Foto Kegiatan"
                    class="w-full h-full object-cover transition-transform duration-500 ease-out group-hover/img:scale-103">

                <!-- Hover Overlay Cue -->
                <div class="absolute inset-0 bg-slate-950/30 opacity-0 group-hover/img:opacity-100 transition-opacity duration-200 flex items-center justify-center pointer-events-none">
                    <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-slate-950/80 backdrop-blur-md text-white text-xs font-semibold shadow-lg">
                        <i data-feather="zoom-in" class="w-4 h-4 text-[#0BB5CB]"></i>
                        <span>Klik untuk perbesar foto (Zoom & Pan)</span>
                    </span>
                </div>
            </div>

            <!-- Date Meta Strip (Shown when date is available) -->
            <div id="lightbox-meta-container" class="flex flex-wrap items-center gap-2.5">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-linear-to-r from-[#00A99D]/10 to-[#0BB5CB]/10 border border-[#0BB5CB]/20 text-[#028DA9] text-xs font-bold">
                    <i data-feather="calendar" class="w-3.5 h-3.5 text-[#00A99D] shrink-0"></i>
                    <span id="lightbox-date"></span>
                </span>
            </div>

            <!-- Title -->
            <div>
                <h3 id="lightbox-title" class="text-base sm:text-xl font-extrabold text-slate-900 leading-snug"></h3>
            </div>

            <!-- Description (Shown when description is available) -->
            <div id="lightbox-desc-container" class="border-t border-slate-100 pt-4">
                <span class="block text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-2">Deskripsi Kegiatan</span>
                <div id="lightbox-desc" class="text-xs sm:text-sm text-slate-600 leading-relaxed whitespace-pre-line"></div>
            </div>
        </div>
    </div>
</div>
