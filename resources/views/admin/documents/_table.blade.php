<x-admin.card>
    <div class="overflow-x-auto -mx-4 -mt-4 sm:-mx-6 sm:-mt-6 {{ $documents->hasPages() ? '' : '-mb-4 sm:-mb-6' }}">
        <table class="min-w-full divide-y divide-slate-100">
            <thead class="bg-slate-50/75">
                <tr>
                    <th class="px-4 py-3.5 sm:px-6 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Kode</th>
                    <th class="px-4 py-3.5 sm:px-6 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Nama Dokumen</th>
                    <th class="px-4 py-3.5 sm:px-6 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Kategori</th>
                    <th class="px-4 py-3.5 sm:px-6 text-center text-xs font-semibold uppercase tracking-wider text-slate-500">Tahun</th>
                    <th class="px-4 py-3.5 sm:px-6 text-center text-xs font-semibold uppercase tracking-wider text-slate-500">Ukuran</th>
                    <th class="px-4 py-3.5 sm:px-6 text-center text-xs font-semibold uppercase tracking-wider text-slate-500">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 bg-white">
                @forelse($documents as $doc)
                    <tr class="hover:bg-slate-50/60 transition-colors">
                        <td class="px-4 py-4 sm:px-6">
                            <span class="inline-flex items-center font-mono text-xs font-bold text-[#028DA9] bg-[rgba(11,181,203,0.08)] px-2.5 py-1 rounded-lg border border-[rgba(11,181,203,0.2)] whitespace-nowrap">
                                {{ $doc->code }}
                            </span>
                        </td>
                        <td class="px-4 py-4 sm:px-6">
                            <p class="text-sm font-semibold text-slate-900 leading-snug">{{ $doc->name }}</p>
                        </td>
                        <td class="px-4 py-4 sm:px-6">
                            <span class="inline-flex items-center rounded-lg bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-700 whitespace-nowrap">
                                {{ $doc->category?->name ?? 'Umum' }}
                            </span>
                        </td>
                        <td class="px-4 py-4 sm:px-6 text-center">
                            <span class="text-xs font-bold text-slate-700 font-mono">{{ $doc->year }}</span>
                        </td>
                        <td class="px-4 py-4 sm:px-6 text-center">
                            <span class="text-xs text-slate-500 whitespace-nowrap">{{ $doc->formatted_file_size }}</span>
                        </td>
                        <td class="px-4 py-4 sm:px-6 text-center">
                            <div class="flex items-center justify-center gap-1.5">
                                <!-- PDF Preview Button (Cyan Background) -->
                                <button
                                    type="button"
                                    class="btn-icon btn-icon-info rounded-xl p-2 transition-all duration-200 shadow-2xs hover:shadow-xs active:scale-95 cursor-pointer"
                                    title="Pratinjau PDF"
                                    data-preview-pdf="{{ route('admin.documents.preview-file', $doc, false) }}"
                                    data-download-url="{{ $doc->file_url }}"
                                    data-preview-title="{{ $doc->code }} | {{ $doc->name }}"
                                >
                                    <i data-feather="eye" class="h-4 w-4"></i>
                                </button>

                                <!-- Download Button (Emerald Background) -->
                                <a
                                    href="{{ $doc->file_url }}"
                                    download
                                    class="btn-icon btn-icon-success rounded-xl p-2 transition-all duration-200 shadow-2xs hover:shadow-xs active:scale-95 cursor-pointer"
                                    title="Unduh File"
                                >
                                    <i data-feather="download" class="h-4 w-4"></i>
                                </a>

                                <!-- Edit Button (Lime Background) -->
                                <button
                                    type="button"
                                    class="btn-icon btn-icon-lime btn-edit-document rounded-xl p-2 transition-all duration-200 shadow-2xs hover:shadow-xs active:scale-95 cursor-pointer"
                                    title="Edit Dokumen"
                                    data-action="{{ route('admin.documents.update', $doc) }}"
                                    data-document="{{ json_encode([
                                        'id' => $doc->id,
                                        'document_category_id' => $doc->document_category_id,
                                        'code' => $doc->code,
                                        'name' => $doc->name,
                                        'year' => $doc->year,
                                        'file_url' => $doc->file_url,
                                        'preview_url' => route('admin.documents.preview-file', $doc, false),
                                        'formatted_file_size' => $doc->formatted_file_size,
                                    ]) }}"
                                >
                                    <i data-feather="edit-2" class="h-4 w-4"></i>
                                </button>

                                <!-- Delete Button (Danger Background) -->
                                <button
                                    type="button"
                                    class="btn-icon btn-icon-danger rounded-xl p-2 transition-all duration-200 shadow-2xs hover:shadow-xs active:scale-95 cursor-pointer"
                                    title="Hapus Dokumen"
                                    onclick="confirmDelete('delete-doc-{{ $doc->id }}', 'dokumen {{ addslashes($doc->name) }}')"
                                >
                                    <i data-feather="trash-2" class="h-4 w-4"></i>
                                </button>

                                <form id="delete-doc-{{ $doc->id }}" method="POST" action="{{ route('admin.documents.destroy', $doc) }}" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <x-admin.empty-state
                        colspan="6"
                        message="Tidak ada dokumen mutu yang cocok."
                        description="Gunakan kata kunci lain atau pilih kategori dan tahun yang berbeda."
                    />
                @endforelse
            </tbody>
        </table>
    </div>

    @if($documents->hasPages())
        <div class="border-t border-slate-100 px-4 py-3.5 sm:px-6 sm:py-4 -mx-4 -mb-4 sm:-mx-6 sm:-mb-6">
            {{ $documents->links() }}
        </div>
    @endif
</x-admin.card>
