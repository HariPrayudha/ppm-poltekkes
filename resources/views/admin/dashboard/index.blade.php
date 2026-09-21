@extends('layouts.admin', ['title' => 'Dashboard'])

@section('content')
    <!-- Page Header -->
    <x-admin.page-header
        title="Selamat Datang di Panel PPM"
        description="Pusat kendali konten dan penjaminan mutu Poltekkes Kemenkes Medan."
    >
        <x-slot:actions>
            <x-admin.btn-primary href="{{ route('admin.documents.index') }}">
                <i data-feather="file-text" class="h-4 w-4"></i>
                Kelola Dokumen
            </x-admin.btn-primary>
        </x-slot:actions>
    </x-admin.page-header>

    <!-- Stats Grid (4 Stat Cards) -->
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 sm:gap-5 mb-6 sm:mb-8">
        <x-admin.stat-card
            label="Total Dokumen Mutu"
            :value="$stats['total_documents']"
            icon="file-text"
            color="primary"
            subtext="SOP, standar, dan manual mutu"
        />
        <x-admin.stat-card
            label="Foto Galeri Kegiatan"
            :value="$stats['total_gallery']"
            icon="camera"
            color="secondary"
            subtext="Dokumentasi agenda & AMI"
        />
        <x-admin.stat-card
            label="Hero Banner Aktif"
            :value="$stats['active_banners']"
            icon="image"
            color="success"
            subtext="Ditayangkan pada beranda"
        />
        <x-admin.stat-card
            label="Layanan Mutu Aktif"
            :value="$stats['active_services']"
            icon="grid"
            color="warning"
            subtext="Layanan penjaminan mutu"
        />
    </div>

    <!-- Two-Column Overview: Latest Documents & Recent Gallery -->
    <div class="grid grid-cols-1 gap-6 lg:gap-8 lg:grid-cols-3 items-stretch">
        <!-- Left: Latest Documents (2 cols) -->
        <div class="lg:col-span-2 flex flex-col">
            <x-admin.card
                title="Dokumen Terbaru"
                description="5 dokumen mutu terakhir yang diunggah ke sistem."
                class="h-full flex flex-col"
            >
                <x-slot:headerActions>
                    <a href="{{ route('admin.documents.index') }}" class="text-xs font-semibold text-[#028DA9] hover:underline">
                        Lihat Semua &rarr;
                    </a>
                </x-slot:headerActions>

                @if($latestDocuments->isEmpty())
                    <div class="flex-1 flex flex-col items-center justify-center py-10 sm:py-14 text-center">
                        <div class="rounded-2xl bg-slate-100 p-3.5 text-slate-400 mb-3">
                            <i data-feather="file-text" class="h-8 w-8"></i>
                        </div>
                        <p class="text-sm font-semibold text-slate-700">Belum ada dokumen mutu yang diunggah.</p>
                        <p class="mt-1 text-xs text-slate-400">Data yang ditambahkan akan muncul di sini.</p>
                    </div>
                @else
                    <div class="overflow-x-auto -mx-4 -my-4 sm:-mx-6 sm:-my-6">
                        <table class="min-w-full divide-y divide-slate-100">
                            <thead class="bg-slate-50/75">
                                <tr>
                                    <th class="px-4 py-3 sm:px-6 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Kode & Nama</th>
                                    <th class="px-4 py-3 sm:px-6 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Kategori</th>
                                    <th class="px-4 py-3 sm:px-6 text-center text-xs font-semibold uppercase tracking-wider text-slate-500">Tahun</th>
                                    <th class="px-4 py-3 sm:px-6 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 bg-white">
                                @foreach($latestDocuments as $doc)
                                    <tr class="hover:bg-slate-50/60 transition-colors">
                                        <td class="px-4 py-3.5 sm:px-6 sm:py-4">
                                            <div class="text-xs font-mono font-semibold text-[#028DA9]">{{ $doc->code }}</div>
                                            <div class="text-sm font-medium text-slate-900 line-clamp-1">{{ $doc->name }}</div>
                                        </td>
                                        <td class="px-4 py-3.5 sm:px-6 sm:py-4 text-xs font-medium text-slate-600">
                                            {{ $doc->category?->name ?? '-' }}
                                        </td>
                                        <td class="px-4 py-3.5 sm:px-6 sm:py-4 text-center text-xs font-semibold text-slate-700">
                                            {{ $doc->year }}
                                        </td>
                                        <td class="px-4 py-3.5 sm:px-6 sm:py-4 text-right">
                                            <a href="{{ $doc->file_url }}" target="_blank" class="inline-flex items-center gap-1 rounded-lg px-2.5 py-1 text-xs font-semibold text-[#028DA9] bg-[rgba(11,181,203,0.08)] hover:bg-[rgba(11,181,203,0.15)] transition-all">
                                                <i data-feather="eye" class="h-3 w-3"></i>
                                                Lihat
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </x-admin.card>
        </div>

        <!-- Right: Recent Gallery & Quick Links (1 col) -->
        <div class="space-y-6 flex flex-col justify-between">
            <x-admin.card
                title="Galeri Terbaru"
                description="Dokumentasi foto kegiatan mutu."
            >
                <x-slot:headerActions>
                    <a href="{{ route('admin.gallery.index') }}" class="text-xs font-semibold text-[#028DA9] hover:underline">
                        Lihat &rarr;
                    </a>
                </x-slot:headerActions>

                <div class="grid grid-cols-2 gap-2.5 sm:gap-3">
                    @forelse($latestGallery as $item)
                        <div class="group relative overflow-hidden rounded-xl border border-slate-200 bg-slate-100 aspect-video">
                            <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="h-full w-full object-cover transition-transform group-hover:scale-105">
                            <div class="absolute inset-0 bg-linear-to-t from-black/70 via-transparent to-transparent flex items-end p-2">
                                <p class="text-[11px] font-semibold text-white line-clamp-1 leading-tight">{{ $item->title }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-2 py-6 flex flex-col items-center justify-center text-center">
                            <div class="rounded-full bg-slate-100 p-2.5 text-slate-400 mb-2">
                                <i data-feather="camera" class="h-5 w-5"></i>
                            </div>
                            <p class="text-xs font-semibold text-slate-600">Belum ada foto kegiatan.</p>
                            <p class="text-[11px] text-slate-400 mt-0.5">Dokumentasi yang diunggah akan muncul di sini.</p>
                        </div>
                    @endforelse
                </div>
            </x-admin.card>

            <!-- Quick Info Card -->
            <div class="rounded-2xl border border-slate-200 bg-linear-to-br from-white to-[#0BB5CB]/5 p-4 sm:p-6 shadow-2xs">
                <div class="flex items-center gap-3 mb-3">
                    <div class="rounded-xl bg-[#0BB5CB]/10 p-2 text-[#028DA9]">
                        <i data-feather="info" class="h-5 w-5"></i>
                    </div>
                    <h4 class="text-sm font-bold text-slate-900">Panduan Pengelolaan Mutu</h4>
                </div>
                <p class="text-xs text-slate-600 leading-relaxed mb-4">
                    Pastikan setiap dokumen SOP dan Standar Mutu yang diunggah dalam format PDF yang rapi serta memiliki kode resmi SPMI Poltekkes Medan.
                </p>
                <a href="{{ route('admin.documents.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-[#028DA9] hover:text-[#0BB5CB] transition-colors">
                    <span>Unggah dokumen sekarang</span>
                    <i data-feather="arrow-right" class="h-3.5 w-3.5"></i>
                </a>
            </div>
        </div>
    </div>
@endsection
