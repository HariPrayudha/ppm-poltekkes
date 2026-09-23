<!-- Desktop Tabular View (Visible on md and up) -->
<div class="hidden md:block overflow-x-auto">
    <table class="w-full text-left text-sm text-slate-600">
        <thead class="bg-slate-50/90 text-xs uppercase font-bold text-slate-500 border-b border-slate-200/80 tracking-wider">
            <tr>
                <th scope="col" class="px-5 py-4 text-center w-14">No</th>
                <th scope="col" class="px-5 py-4 whitespace-nowrap">Kode</th>
                <th scope="col" class="px-5 py-4">Nama Dokumen</th>
                <th scope="col" class="px-5 py-4">Kategori SPMI</th>
                <th scope="col" class="px-5 py-4 text-center whitespace-nowrap">Tahun</th>
                <th scope="col" class="px-5 py-4 text-center whitespace-nowrap">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($documents as $index => $doc)
                <tr class="hover:bg-slate-50/90 transition-colors group">
                    <!-- Serial Number -->
                    <td class="px-5 py-4 text-center text-xs font-semibold text-slate-400 whitespace-nowrap">
                        {{ $documents->firstItem() ? ($documents->firstItem() + $index) : ($index + 1) }}
                    </td>

                    <!-- Code Monospace Pill -->
                    <td class="px-5 py-4 whitespace-nowrap">
                        @if($doc->code)
                            <span class="inline-flex items-center px-2.5 py-1 rounded-xl bg-slate-100 text-slate-700 font-mono text-xs font-bold border border-slate-200/70 shadow-2xs group-hover:border-[#0BB5CB]/30 transition-colors">
                                {{ $doc->code }}
                            </span>
                        @else
                            <span class="text-xs text-slate-400 font-medium">-</span>
                        @endif
                    </td>

                    <!-- Document Title -->
                    <td class="px-5 py-4">
                        <span class="font-bold text-slate-900 group-hover:text-[#028DA9] transition-colors leading-snug">
                            {{ $doc->name }}
                        </span>
                    </td>

                    <!-- Category Badge -->
                    <td class="px-5 py-4 whitespace-nowrap">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl text-xs font-semibold bg-[#0BB5CB]/10 text-[#028DA9] border border-[#0BB5CB]/20 shadow-2xs">
                            <i data-feather="folder" class="w-3 h-3 text-[#0BB5CB]"></i>
                            <span>{{ $doc->category?->name ?: 'Umum' }}</span>
                        </span>
                    </td>

                    <!-- Publication Year -->
                    <td class="px-5 py-4 text-center whitespace-nowrap">
                        @if($doc->year)
                            <span class="inline-flex items-center px-2.5 py-1 rounded-xl bg-slate-100/90 text-xs font-semibold text-slate-700 border border-slate-200/60">
                                {{ $doc->year }}
                            </span>
                        @else
                            <span class="text-xs text-slate-400">-</span>
                        @endif
                    </td>

                    <!-- Action Buttons (Centered) -->
                    <td class="px-5 py-4 text-center whitespace-nowrap">
                        <div class="inline-flex items-center justify-center gap-2">
                            <!-- Preview PDF (Anti-IDM Modal) -->
                            <button type="button"
                                class="btn-preview-pdf inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-[#0BB5CB]/10 text-[#028DA9] hover:bg-linear-to-r hover:from-[#00A99D] hover:to-[#0BB5CB] hover:text-white transition-all duration-200 text-xs font-bold cursor-pointer shadow-2xs hover:shadow-md hover:shadow-[#0BB5CB]/25 hover:-translate-y-0.5 active:scale-95"
                                data-preview-url="{{ route('frontend.documents.preview', $doc) }}"
                                data-download-url="{{ route('frontend.documents.download', $doc) }}"
                                data-title="{{ $doc->name }}"
                                data-code="{{ $doc->code }}"
                                title="Pratinjau Dokumen">
                                <i data-feather="eye" class="w-3.5 h-3.5"></i>
                                <span>Lihat</span>
                            </button>

                            <!-- Direct Download PDF -->
                            <a href="{{ route('frontend.documents.download', $doc) }}"
                                class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-slate-100 text-slate-700 hover:bg-slate-800 hover:text-white transition-all duration-200 text-xs font-bold shadow-2xs hover:shadow-md hover:-translate-y-0.5 active:scale-95"
                                title="Unduh Berkas PDF">
                                <i data-feather="download" class="w-3.5 h-3.5"></i>
                                <span>Unduh</span>
                            </a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-16 text-center text-slate-400">
                        <div class="flex flex-col items-center justify-center gap-3">
                            <div class="w-14 h-14 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center border border-slate-200/80 shadow-2xs">
                                <i data-feather="file-text" class="w-7 h-7 text-slate-400"></i>
                            </div>
                            <p class="text-base font-bold text-slate-800">Dokumen Tidak Ditemukan</p>
                            <p class="text-xs text-slate-500 max-w-md leading-relaxed">
                                Tidak ada dokumen SPMI yang sesuai dengan kriteria kata kunci atau filter yang Anda pilih. Silakan atur ulang filter pencarian Anda.
                            </p>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Mobile List View (Structured, Balanced, Touch-Friendly Document Cards) -->
<div class="block md:hidden divide-y divide-slate-100/90">
    @forelse($documents as $doc)
        <article class="p-4 transition-colors duration-150 hover:bg-slate-50/70">
            <!-- Row 1: Category Tag & Year Badge (Symmetrical Top Row, No Code Cramming) -->
            <div class="flex items-center justify-between gap-2 mb-2">
                <!-- Category Pill -->
                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-lg bg-[#0BB5CB]/10 text-[#028DA9] text-[11px] font-semibold tracking-wide border border-[#0BB5CB]/20">
                    <i data-feather="folder" class="w-3 h-3 text-[#0BB5CB]"></i>
                    <span>{{ $doc->category?->name ?: 'Umum' }}</span>
                </span>

                <!-- Publication Year (Safe Right Anchor) -->
                @if($doc->year)
                    <span class="text-[11px] font-semibold text-slate-500 px-2 py-0.5 rounded-md bg-slate-100 border border-slate-200/70 shrink-0">
                        {{ $doc->year }}
                    </span>
                @endif
            </div>

            <!-- Row 2: Document Title (Balanced typography, clear hierarchy) -->
            <h4 class="text-xs sm:text-sm font-bold text-slate-900 leading-snug tracking-tight mb-2.5 break-words">
                {{ $doc->name }}
            </h4>

            <!-- Row 3: Code & Compact Actions (No internal border, line is only for list divider) -->
            <div class="flex items-center justify-between gap-2 pt-0.5">
                <!-- Document Code -->
                <div class="min-w-0">
                    @if($doc->code)
                        <span class="font-mono text-[10px] font-bold px-1.5 py-0.5 rounded-md bg-slate-100 text-slate-700 border border-slate-200/80 shrink-0">
                            {{ $doc->code }}
                        </span>
                    @endif
                </div>

                <!-- Action Buttons: Lihat & Unduh -->
                <div class="inline-flex items-center gap-1.5 shrink-0">
                    <!-- Preview PDF (Anti-IDM Modal) -->
                    <button type="button"
                        class="btn-preview-pdf inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-linear-to-r from-[#00A99D] to-[#0BB5CB] text-white text-xs font-bold shadow-2xs hover:shadow-xs active:scale-95 transition-all cursor-pointer"
                        data-preview-url="{{ route('frontend.documents.preview', $doc) }}"
                        data-download-url="{{ route('frontend.documents.download', $doc) }}"
                        data-title="{{ $doc->name }}"
                        data-code="{{ $doc->code }}"
                        title="Pratinjau Dokumen">
                        <i data-feather="eye" class="w-3.5 h-3.5"></i>
                        <span>Lihat</span>
                    </button>

                    <!-- Direct Download PDF -->
                    <a href="{{ route('frontend.documents.download', $doc) }}"
                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold border border-slate-200/80 active:scale-95 shadow-2xs transition-all"
                        title="Unduh Berkas PDF">
                        <i data-feather="download" class="w-3.5 h-3.5"></i>
                        <span>Unduh</span>
                    </a>
                </div>
            </div>
        </article>
    @empty
        <div class="py-12 text-center text-slate-400 px-4">
            <div class="flex flex-col items-center justify-center gap-2.5">
                <div class="w-12 h-12 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center border border-slate-200/80 shadow-2xs">
                    <i data-feather="file-text" class="w-6 h-6 text-slate-400"></i>
                </div>
                <p class="text-sm font-bold text-slate-800">Dokumen Tidak Ditemukan</p>
                <p class="text-xs text-slate-500 max-w-xs leading-relaxed">
                    Tidak ada dokumen yang sesuai dengan pencarian atau filter yang dipilih. Silakan atur ulang filter pencarian Anda.
                </p>
            </div>
        </div>
    @endforelse
</div>

<!-- Pagination Outlet -->
@if($documents->hasPages())
    <div class="px-5 py-4 border-t border-slate-200/80 bg-slate-50/60">
        {{ $documents->links() }}
    </div>
@endif
