<div id="pdf-preview-modal"
    role="dialog"
    aria-modal="true"
    aria-labelledby="pdf-modal-title"
    class="fixed inset-0 z-9999 hidden items-center justify-center p-3 sm:p-6 bg-slate-950/80 backdrop-blur-sm transition-opacity duration-300">
    <div class="relative w-full max-w-5xl h-[85vh] sm:h-[90vh] bg-white rounded-2xl shadow-2xl flex flex-col overflow-hidden border border-slate-200">
        <!-- Modal Header -->
        <div class="flex items-center justify-between px-5 py-4 border-b border-slate-200 bg-slate-50 shrink-0">
            <div class="flex items-center gap-3 min-w-0">
                <div class="w-9 h-9 rounded-lg bg-red-100 text-red-600 flex items-center justify-center shrink-0">
                    <i data-feather="file-text" class="w-5 h-5"></i>
                </div>
                <div class="min-w-0">
                    <h3 id="pdf-modal-title" class="text-sm sm:text-base font-bold text-slate-800 truncate">
                        Pratinjau Dokumen
                    </h3>
                    <p id="pdf-modal-code" class="text-xs text-slate-500 truncate">
                        Memuat berkas...
                    </p>
                </div>
            </div>

            <!-- Header Action Controls -->
            <div class="flex items-center gap-2 shrink-0">
                <a id="pdf-modal-download"
                    href="#"
                    download
                    class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-lg bg-[#0BB5CB] text-white text-xs font-semibold hover:bg-[#028DA9] transition-colors shadow-2xs">
                    <i data-feather="download" class="w-3.5 h-3.5"></i>
                    <span class="hidden sm:inline">Unduh PDF</span>
                </a>
                <button id="pdf-modal-close"
                    type="button"
                    aria-label="Tutup pratinjau"
                    class="p-2 rounded-lg text-slate-400 hover:text-slate-700 hover:bg-slate-200/60 transition-colors cursor-pointer">
                    <i data-feather="x" class="w-5 h-5"></i>
                </button>
            </div>
        </div>

        <!-- Modal Body / Content -->
        <div class="relative flex-1 bg-slate-100 flex items-center justify-center overflow-hidden">
            <!-- Loading Spinner State -->
            <div id="pdf-modal-loading" class="flex flex-col items-center gap-3 text-slate-500">
                <div class="w-10 h-10 border-4 border-[#0BB5CB]/20 border-t-[#0BB5CB] rounded-full animate-spin"></div>
                <p class="text-xs sm:text-sm font-medium">Memuat pratinjau dokumen...</p>
            </div>

            <!-- Error State -->
            <div id="pdf-modal-error" class="hidden flex flex-col items-center gap-3 text-slate-600 p-6 text-center">
                <div class="w-12 h-12 rounded-full bg-red-100 text-red-500 flex items-center justify-center">
                    <i data-feather="alert-circle" class="w-6 h-6"></i>
                </div>
                <p class="text-sm font-semibold text-slate-800">Gagal Membuka Dokumen</p>
                <p class="text-xs text-slate-500 max-w-sm" id="pdf-modal-error-msg">
                    Berkas pratinjau tidak dapat diakses atau sedang mengalami gangguan.
                </p>
            </div>

            <!-- Anti-IDM Blob PDF Iframe -->
            <iframe id="pdf-modal-frame"
                src=""
                title="Dokumen PDF"
                class="w-full h-full border-0 hidden">
            </iframe>
        </div>
    </div>
</div>
