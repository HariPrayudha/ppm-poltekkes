@props([
    'id' => 'modal-global-pdf-preview',
])

<div id="{{ $id }}" class="dashboard-modal fixed inset-0 z-60 hidden items-center justify-center bg-slate-950/80 backdrop-blur-md p-3 sm:p-4 overflow-hidden">
    <div class="modal-dialog relative flex flex-col w-full max-w-5xl h-[calc(100dvh-1.5rem)] sm:h-[calc(100vh-3rem)] rounded-3xl bg-white shadow-2xl border border-slate-100 overflow-hidden transform">
        <!-- Header (Pinned, Sticky) -->
        <div class="modal-header shrink-0 flex items-center justify-between border-b border-slate-100 px-5 sm:px-6 py-3.5 sm:py-4 bg-white sticky top-0 z-20">
            <div class="min-w-0 pr-4">
                <h3 id="global-pdf-modal-title" class="text-sm sm:text-base font-bold text-slate-900 truncate">Pratinjau Dokumen PDF</h3>
                <p class="text-[11px] text-slate-400 mt-0.5 hidden sm:block">Dokumen resmi Pusat Penjaminan Mutu Poltekkes Kemenkes Medan</p>
            </div>

            <!-- PDF Toolbar Controls -->
            <div class="flex items-center gap-1.5 sm:gap-2 shrink-0">
                <!-- Open in New Tab -->
                <a
                    id="global-pdf-modal-link"
                    href="#"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="rounded-xl p-2 text-slate-400 hover:bg-slate-100 hover:text-[#028DA9] transition-colors cursor-pointer"
                    title="Buka dokumen di tab baru"
                >
                    <i data-feather="external-link" class="h-4.5 w-4.5"></i>
                </a>

                <!-- Download Button -->
                <a
                    id="global-pdf-modal-download"
                    href="#"
                    download
                    class="rounded-xl p-2 text-slate-400 hover:bg-slate-100 hover:text-emerald-600 transition-colors cursor-pointer"
                    title="Unduh dokumen PDF"
                >
                    <i data-feather="download" class="h-4.5 w-4.5"></i>
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

        <!-- Body with Iframe Render Container -->
        <div class="modal-body flex-1 relative bg-slate-900/5 overflow-hidden flex flex-col">
            <!-- Loading Indicator -->
            <div id="global-pdf-loading" class="absolute inset-0 flex flex-col items-center justify-center bg-slate-50 gap-3 z-20 transition-opacity duration-300 pointer-events-none">
                <div class="h-10 w-10 animate-spin rounded-full border-3 border-[#028DA9]/20 border-t-[#028DA9]"></div>
                <p class="text-xs font-semibold text-slate-600">Memuat pratinjau PDF...</p>
            </div>

            <iframe id="global-pdf-iframe" src="" class="w-full h-full border-0 bg-white relative z-10" allowfullscreen></iframe>

            <!-- Fallback Helper if PDF inline preview is restricted on mobile/browser -->
            <div id="global-pdf-fallback" class="hidden absolute inset-x-4 bottom-4 mx-auto max-w-md bg-white/95 backdrop-blur-xs border border-slate-200/80 shadow-lg rounded-2xl p-3 sm:p-4 text-center z-15">
                <p class="text-xs text-slate-600 mb-2">Pratinjau dokumen tidak muncul di browser Anda?</p>
                <div class="flex items-center justify-center gap-2">
                    <a id="global-pdf-fallback-link" href="#" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-white bg-[#028DA9] hover:bg-[#02758d] rounded-xl transition-all shadow-2xs">
                        <i data-feather="external-link" class="h-3.5 w-3.5"></i>
                        <span>Buka di Tab Baru</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
