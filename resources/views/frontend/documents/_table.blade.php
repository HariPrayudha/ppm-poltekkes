<div class="overflow-x-auto">
    <table class="w-full text-left text-sm text-slate-600">
        <thead class="bg-slate-100/75 text-xs uppercase font-semibold text-slate-600 border-b border-slate-200 tracking-wider">
            <tr>
                <th scope="col" class="px-5 py-4 text-center w-14">No</th>
                <th scope="col" class="px-5 py-4 whitespace-nowrap">Kode</th>
                <th scope="col" class="px-5 py-4">Nama Dokumen</th>
                <th scope="col" class="px-5 py-4">Kategori</th>
                <th scope="col" class="px-5 py-4 text-center whitespace-nowrap">Tahun Terbit</th>
                <th scope="col" class="px-5 py-4 text-right whitespace-nowrap">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($documents as $index => $doc)
                <tr class="hover:bg-slate-50/80 transition-colors">
                    <td class="px-5 py-4 text-center text-xs font-semibold text-slate-500 whitespace-nowrap">
                        {{ $documents->firstItem() ? ($documents->firstItem() + $index) : ($index + 1) }}
                    </td>
                    <td class="px-5 py-4 font-mono text-xs font-bold text-[#028DA9] whitespace-nowrap">
                        {{ $doc->code ?: '-' }}
                    </td>
                    <td class="px-5 py-4 font-semibold text-slate-800">
                        {{ $doc->name }}
                    </td>
                    <td class="px-5 py-4 whitespace-nowrap">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#0BB5CB]/10 text-[#028DA9]">
                            {{ $doc->category?->name ?: 'Umum' }}
                        </span>
                    </td>
                    <td class="px-5 py-4 text-center text-xs font-semibold text-slate-600 whitespace-nowrap">
                        {{ $doc->year ?: '-' }}
                    </td>
                    <td class="px-5 py-4 text-right whitespace-nowrap">
                        <div class="inline-flex items-center justify-end gap-2">
                            <button type="button"
                                class="btn-preview-pdf inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-[#0BB5CB]/10 text-[#028DA9] hover:bg-[#0BB5CB] hover:text-white transition-all duration-200 text-xs font-semibold cursor-pointer shadow-2xs"
                                data-preview-url="{{ route('frontend.documents.preview', $doc) }}"
                                data-download-url="{{ route('frontend.documents.download', $doc) }}"
                                data-title="{{ $doc->name }}"
                                data-code="{{ $doc->code }}"
                                title="Lihat Dokumen">
                                <i data-feather="eye" class="w-3.5 h-3.5"></i>
                                <span>Lihat Dokumen</span>
                            </button>
                            <a href="{{ route('frontend.documents.download', $doc) }}"
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-slate-100 text-slate-700 hover:bg-[#46B58B] hover:text-white transition-all duration-200 text-xs font-semibold shadow-2xs"
                                title="Unduh Dokumen">
                                <i data-feather="download" class="w-3.5 h-3.5"></i>
                                <span>Unduh Dokumen</span>
                            </a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-14 text-center text-slate-400">
                        <div class="flex flex-col items-center justify-center gap-2.5">
                            <div class="w-12 h-12 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center">
                                <i data-feather="search" class="w-6 h-6"></i>
                            </div>
                            <p class="text-sm font-semibold text-slate-700">Tidak ada dokumen yang ditemukan</p>
                            <p class="text-xs text-slate-500 max-w-sm">
                                Coba sesuaikan kata kunci pencarian atau ganti filter kategori dan tahun yang dipilih.
                            </p>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($documents->hasPages())
    <div class="px-6 py-4 border-t border-slate-200/80 bg-slate-50/50">
        {{ $documents->links() }}
    </div>
@endif
