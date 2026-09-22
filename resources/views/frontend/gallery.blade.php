@extends('layouts.frontend')

@section('title', 'Galeri Kegiatan')

@section('content')
    <!-- Header Banner -->
    <div class="bg-linear-to-b from-slate-900 via-slate-900 to-slate-800 text-white py-16 sm:py-20 border-b border-slate-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-[#0BB5CB]/20 border border-[#0BB5CB]/40 text-[#0BB5CB] text-xs font-semibold uppercase tracking-wider mb-4">
                <i data-feather="camera" class="w-3.5 h-3.5"></i>
                Dokumentasi Kegiatan
            </div>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight">
                Galeri Penjaminan Mutu
            </h1>
            <p class="mt-4 text-slate-300 text-sm sm:text-base max-w-2xl mx-auto leading-relaxed">
                Dokumentasi visual rangkaian kegiatan Audit Mutu Internal (AMI), Rapat Tinjauan Manajemen (RTM), sosialisasi instrumen, dan workshop akreditasi di lingkungan Poltekkes Kemenkes Medan.
            </p>
        </div>
    </div>

    <!-- Gallery Grid Section -->
    <section class="py-14 sm:py-20 bg-slate-50 min-h-[600px] reveal-on-scroll">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($galleries->isNotEmpty())
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                    @foreach($galleries as $item)
                        <div class="group relative overflow-hidden rounded-2xl bg-white border border-slate-200/80 shadow-xs hover:shadow-xl transition-all duration-300 hover:-translate-y-1.5 cursor-pointer lightbox-trigger"
                            data-image="{{ $item->image_url }}"
                            data-title="{{ $item->title }} ({{ $item->event_date?->translatedFormat('d F Y') }})">
                            <!-- Image Frame -->
                            <div class="aspect-4/3 w-full overflow-hidden bg-slate-100">
                                <img src="{{ $item->image_url }}"
                                    alt="{{ $item->title }}"
                                    class="w-full h-full object-cover transition-transform duration-500 ease-out group-hover:scale-108"
                                    loading="lazy" />
                            </div>

                            <!-- Overlay details -->
                            <div class="p-5">
                                <div class="flex items-center gap-2 text-2xs font-semibold text-[#028DA9] uppercase tracking-wider mb-1.5">
                                    <i data-feather="calendar" class="w-3.5 h-3.5"></i>
                                    <span>{{ $item->event_date?->translatedFormat('d F Y') }}</span>
                                </div>
                                <h3 class="text-base font-bold text-slate-900 group-hover:text-[#028DA9] transition-colors line-clamp-2 leading-snug">
                                    {{ $item->title }}
                                </h3>
                                @if($item->description)
                                    <p class="text-xs text-slate-500 line-clamp-2 mt-2 leading-relaxed">
                                        {{ $item->description }}
                                    </p>
                                @endif
                                <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-400 group-hover:text-[#0BB5CB] transition-colors">
                                    <span class="font-medium">Klik untuk perbesar</span>
                                    <i data-feather="maximize-2" class="w-3.5 h-3.5"></i>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($galleries->hasPages())
                    <div class="mt-12">
                        {{ $galleries->links() }}
                    </div>
                @endif
            @else
                <div class="flex flex-col items-center justify-center py-20 text-slate-400 bg-white rounded-3xl border border-dashed border-slate-300 p-8 text-center max-w-md mx-auto">
                    <i data-feather="image" class="w-14 h-14 text-slate-300 mb-3"></i>
                    <p class="text-base font-semibold text-slate-700">Belum Ada Dokumentasi Kegiatan</p>
                    <p class="text-xs text-slate-500 mt-1">Foto kegiatan penjaminan mutu akan segera diperbarui oleh tim pengelola.</p>
                </div>
            @endif
        </div>
    </section>
@endsection

@section('modals')
    <x-frontend.lightbox-modal />
@endsection
