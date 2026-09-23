@extends('layouts.frontend')

@section('title', 'Galeri Kegiatan')

@section('content')
    <!-- Institutional Header Banner (Light & Professional, Aligned with Contact) -->
    <div class="relative bg-linear-to-b from-slate-50 via-white to-slate-50/60 overflow-hidden">
        <!-- Top Signature Gradient Accent Line -->
        <div class="h-1 w-full bg-linear-to-r from-[#00A99D] via-[#0BB5CB] to-[#46B58B]"></div>

        <!-- Soft Ambient Radial Glow -->
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_60%_50%_at_50%_-10%,rgba(11,181,203,0.08),transparent)] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-7 pb-6 sm:pt-9 sm:pb-7 relative z-10">
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-2 text-xs font-semibold text-slate-500 mb-3 select-none" aria-label="Breadcrumb">
                <a href="{{ route('frontend.home') }}" class="hover:text-[#028DA9] transition-colors flex items-center gap-1.5">
                    <i data-feather="home" class="w-3.5 h-3.5"></i>
                    <span>Beranda</span>
                </a>
                <i data-feather="chevron-right" class="w-3.5 h-3.5 text-slate-300"></i>
                <span class="text-[#028DA9] font-bold">Galeri Dokumentasi</span>
            </nav>

            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-black text-slate-900 tracking-tight">
                Galeri Penjaminan Mutu
            </h1>
            <p class="mt-2 text-xs sm:text-sm text-slate-600 max-w-2xl leading-relaxed">
                Dokumentasi visual rangkaian kegiatan Audit Mutu Internal (AMI), Rapat Tinjauan Manajemen (RTM), sosialisasi instrumen, dan workshop akreditasi di lingkungan Poltekkes Kemenkes Medan.
            </p>
        </div>
    </div>

    <!-- Gallery Grid Section -->
    <section class="pt-5 pb-12 sm:pt-7 sm:pb-16 bg-slate-50/60 min-h-[600px] reveal-on-scroll">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($galleries->isNotEmpty())
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                    @foreach($galleries as $item)
                        <div class="group relative overflow-hidden rounded-3xl bg-white border border-slate-200/80 p-3 sm:p-3.5 shadow-xs hover:shadow-xl transition-all duration-300 hover:-translate-y-1.5 cursor-pointer lightbox-trigger flex flex-col"
                            data-image="{{ $item->image_url }}"
                            data-title="{{ $item->title }}"
                            data-date="{{ $item->event_date?->translatedFormat('d F Y') }}"
                            data-description="{{ $item->description ?? '' }}">
                            <!-- Image Frame with Floating Frosted Date Badge -->
                            <div class="aspect-4/3 relative w-full overflow-hidden rounded-2xl bg-slate-100">
                                <img src="{{ $item->image_url }}"
                                    alt="{{ $item->title }}"
                                    class="w-full h-full object-cover transition-transform duration-500 ease-out group-hover:scale-106"
                                    loading="lazy" />

                                <!-- Floating Frosted Glass Date Pill -->
                                @if($item->event_date)
                                    <div class="absolute top-3 left-3 inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-white/95 backdrop-blur-md border border-slate-200/80 text-slate-800 shadow-sm text-xs font-bold z-10">
                                        <i data-feather="calendar" class="w-3.5 h-3.5 text-[#00A99D] shrink-0"></i>
                                        <span>{{ $item->event_date->translatedFormat('d F Y') }}</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Card Body -->
                            <div class="p-3 sm:p-4 flex-1 flex flex-col justify-between">
                                <div>
                                    <h3 class="text-sm sm:text-base font-bold text-slate-900 group-hover:text-[#028DA9] transition-colors line-clamp-2 leading-snug">
                                        {{ $item->title }}
                                    </h3>
                                    @if($item->description)
                                        <p class="text-xs text-slate-500 line-clamp-2 mt-2 leading-relaxed">
                                            {{ $item->description }}
                                        </p>
                                    @endif
                                </div>

                                <!-- Card Action Footer -->
                                <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500 group-hover:text-[#028DA9] transition-colors">
                                    <span class="font-semibold">Lihat Detail Dokumentasi</span>
                                    <div class="w-7 h-7 rounded-lg bg-slate-100 group-hover:bg-[#00A99D]/10 text-slate-500 group-hover:text-[#028DA9] flex items-center justify-center transition-colors">
                                        <i data-feather="arrow-right" class="w-3.5 h-3.5 transition-transform duration-200 group-hover:translate-x-0.5"></i>
                                    </div>
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
