@extends('layouts.frontend')

@section('title', 'Beranda')

@section('content')
    <!-- 1. Hero Banner / Slider Section (Bab 2.2 SRS) -->
    <x-frontend.hero-slider :banners="$banners" />

    <!-- 2. Section Sambutan Kepala PPM (Bab 2.2 SRS) -->
    @if($greeting && ($greeting->name || $greeting->content))
        <section class="py-14 sm:py-20 lg:py-24 bg-slate-50/70 border-b border-slate-200/70">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-10 lg:p-14 shadow-xs relative overflow-hidden">
                    <!-- Ambient Glow Accent -->
                    <div class="absolute -right-20 -top-20 w-80 h-80 rounded-full bg-linear-to-br from-[#0BB5CB]/10 to-[#00A99D]/10 blur-3xl pointer-events-none"></div>

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-14 items-center relative z-10">
                        <!-- Foto Resmi Kepala PPM (4 cols) -->
                        <div class="lg:col-span-4 flex flex-col items-center text-center">
                            <div class="relative group w-full max-w-[280px] sm:max-w-[320px]">
                                <div class="absolute -inset-2 rounded-3xl bg-linear-to-tr from-[#0BB5CB] to-[#00A99D] opacity-15 blur-md transition-opacity duration-300 group-hover:opacity-30"></div>
                                <div class="relative w-full aspect-[3/4] rounded-2xl overflow-hidden bg-slate-100 shadow-md border-2 border-white">
                                    @if($greeting->photo_path)
                                        <img src="{{ $greeting->photo_url }}"
                                            alt="{{ $greeting->name }}"
                                            class="w-full h-full object-cover object-top transition-transform duration-500 group-hover:scale-105" />
                                    @else
                                        <div class="w-full h-full flex flex-col items-center justify-center text-slate-400 bg-slate-100">
                                            <i data-feather="user" class="w-16 h-16"></i>
                                            <span class="text-xs mt-2 font-medium">Foto Pimpinan</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="mt-4 sm:mt-5 space-y-1">
                                <h3 class="text-base sm:text-lg font-bold text-slate-900 tracking-tight">
                                    {{ $greeting->name }}
                                </h3>
                                <p class="text-xs sm:text-sm font-semibold text-[#028DA9]">
                                    {{ $greeting->position ?: 'Kepala Pusat Penjaminan Mutu' }}
                                </p>
                            </div>
                        </div>

                        <!-- Teks Sambutan Resmi (8 cols) -->
                        <div class="lg:col-span-8 space-y-5">
                            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-[#0BB5CB]/10 border border-[#0BB5CB]/25 text-[#028DA9] text-xs font-semibold uppercase tracking-wider">
                                <i data-feather="message-square" class="w-3.5 h-3.5 text-[#00A99D]"></i>
                                <span>Sambutan Kepala PPM</span>
                            </div>

                            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight">
                                Komitmen Integritas dan Penguatan Budaya Mutu Berkelanjutan
                            </h2>

                            <div class="text-slate-600 text-sm sm:text-base leading-relaxed space-y-3.5 font-normal prose prose-slate max-w-none">
                                {!! $greeting->content !!}
                            </div>

                            <div class="pt-4 border-t border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                                <div class="flex items-center gap-2 text-xs font-medium text-slate-600">
                                    <i data-feather="shield" class="w-4 h-4 text-[#46B58B]"></i>
                                    <span>Sistem Penjaminan Mutu Internal (SPMI) Siklus PPEPP</span>
                                </div>
                                <a href="{{ route('frontend.profile.duties') }}"
                                    class="text-xs sm:text-sm font-bold text-[#028DA9] hover:text-[#0BB5CB] transition-colors flex items-center gap-1.5 self-start sm:self-auto group">
                                    <span>Pelajari Tugas & Fungsi</span>
                                    <i data-feather="arrow-right" class="w-3.5 h-3.5 transition-transform duration-200 group-hover:translate-x-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- 3. Section Layanan Kami (Bab 2.2 SRS) -->
    @if($services->isNotEmpty())
        <section class="py-16 sm:py-24 bg-white reveal-on-scroll">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <x-frontend.section-heading
                    badge="Layanan Institusi"
                    title="Layanan Penjaminan Mutu Kami"
                    description="Pusat Penjaminan Mutu Poltekkes Kemenkes Medan melayani seluruh sivitas akademika dalam penyelenggaraan siklus penetapan, pelaksanaan, evaluasi, pengendalian, dan peningkatan standar mutu."
                    align="center" />

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                    @foreach($services as $service)
                        <x-frontend.service-card :service="$service" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- 4. Section Link Terkait: 1:1 Transparent PNG Presentation (Bab 2.2 SRS) -->
    @if($relatedLinks->isNotEmpty())
        <section class="py-16 sm:py-20 bg-slate-50/70 border-t border-slate-200/80 reveal-on-scroll">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-2xl mx-auto mb-10 sm:mb-12">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-[#0BB5CB]/10 border border-[#0BB5CB]/25 text-[#028DA9] text-xs font-semibold uppercase tracking-wider mb-3">
                        <i data-feather="link-2" class="w-3.5 h-3.5 text-[#00A99D]"></i>
                        <span>Tautan Layanan Terpadu</span>
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                        Lembaga Mitra & Kementerian Terkait
                    </h2>
                    <div class="h-1 w-16 bg-linear-to-r from-[#0BB5CB] to-[#00A99D] rounded-full mx-auto my-3"></div>
                    <p class="text-slate-500 text-xs sm:text-sm leading-relaxed">
                        Akses cepat menuju portal kementerian, sistem informasi internal, dan layanan terpadu Poltekkes Kemenkes Medan.
                    </p>
                </div>

                <!-- 1:1 Aspect Ratio Logo Cards Grid -->
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3.5 sm:gap-5">
                    @foreach($relatedLinks as $link)
                        <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer"
                            class="group relative flex flex-col items-center justify-between p-4 sm:p-5 rounded-2xl bg-white border border-slate-200/80 shadow-2xs hover:shadow-lg hover:border-[#0BB5CB]/40 hover:-translate-y-1 transition-all duration-300 text-center"
                            title="{{ $link->name }}">
                            
                            <!-- 1:1 Transparent PNG Frame -->
                            <div class="w-16 h-16 sm:w-20 sm:h-20 flex items-center justify-center mb-2.5 transition-transform duration-300 group-hover:scale-105">
                                @if($link->logo_path)
                                    <img src="{{ $link->logo_url }}"
                                        alt="{{ $link->name }}"
                                        class="max-h-full max-w-full object-contain" />
                                @else
                                    <div class="w-12 h-12 rounded-xl bg-slate-50 border border-slate-200/80 flex items-center justify-center text-slate-400 group-hover:text-[#028DA9] transition-colors">
                                        <i data-feather="external-link" class="w-5 h-5"></i>
                                    </div>
                                @endif
                            </div>

                            <!-- Portal Name Label -->
                            <span class="text-xs sm:text-sm font-bold text-slate-700 group-hover:text-[#028DA9] transition-colors leading-snug line-clamp-2 w-full">
                                {{ $link->name }}
                            </span>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection

@push('scripts')
    <script src="{{ asset('frontend/assets/js/home.js') }}?v={{ file_exists(public_path('frontend/assets/js/home.js')) ? filemtime(public_path('frontend/assets/js/home.js')) : time() }}" defer></script>
@endpush
