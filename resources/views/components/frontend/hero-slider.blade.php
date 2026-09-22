@props(['banners' => collect()])

<section class="relative w-full overflow-hidden bg-slate-900 min-h-[520px] lg:min-h-[620px] flex items-center" id="hero-slider-container">
    @if($banners->isNotEmpty())
        <!-- Slides Wrapper -->
        <div id="hero-slider-track" class="relative w-full h-[520px] lg:h-[620px]">
            @foreach($banners as $index => $banner)
                <div class="hero-slide absolute inset-0 transition-opacity duration-700 ease-in-out {{ $index === 0 ? 'opacity-100 z-10' : 'opacity-0 pointer-events-none z-0' }}"
                    data-slide-index="{{ $index }}">
                    <!-- Background Image -->
                    <img src="{{ $banner->image_url }}"
                        alt="{{ $banner->title }}"
                        class="absolute inset-0 w-full h-full object-cover object-center transform scale-100 transition-transform duration-7000 ease-out" />

                    <!-- Gradient Overlays for Readability -->
                    <div class="absolute inset-0 bg-linear-to-r from-slate-950/90 via-slate-900/65 to-transparent"></div>
                    <div class="absolute inset-0 bg-linear-to-t from-slate-950/70 via-transparent to-black/30"></div>

                    <!-- Slide Content -->
                    <div class="relative z-10 max-w-7xl mx-auto h-full px-4 sm:px-6 lg:px-8 flex flex-col justify-center">
                        <div class="max-w-3xl space-y-4 sm:space-y-6">
                            <!-- Institutional Tag Badge -->
                            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-[#0BB5CB]/20 border border-[#0BB5CB]/40 backdrop-blur-md text-[#0BB5CB] text-xs font-semibold tracking-wide uppercase">
                                <span class="w-2 h-2 rounded-full bg-[#D2DC03] animate-pulse"></span>
                                Penjaminan Mutu Institusi
                            </div>

                            <!-- Title -->
                            <h1 class="text-3xl sm:text-4xl lg:text-5xl xl:text-6xl font-extrabold text-white leading-tight tracking-tight drop-shadow-sm">
                                {{ $banner->title }}
                            </h1>

                            <!-- Description -->
                            @if($banner->description)
                                <p class="text-slate-200 text-sm sm:text-base lg:text-lg leading-relaxed max-w-2xl drop-shadow-xs">
                                    {{ $banner->description }}
                                </p>
                            @endif

                            <!-- Action Buttons -->
                            <div class="flex flex-wrap items-center gap-4 pt-2">
                                @if($banner->cta_label && $banner->cta_url)
                                    <a href="{{ $banner->cta_url }}"
                                        class="relative group overflow-hidden rounded-xl bg-linear-to-r from-[#0BB5CB] to-[#028DA9] px-6 py-3 text-sm font-semibold text-white shadow-lg transition-all duration-300 ease-out hover:-translate-y-0.5 hover:shadow-xl active:scale-95 flex items-center gap-2">
                                        <span class="absolute inset-0 bg-white/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                                        <span class="relative z-10">{{ $banner->cta_label }}</span>
                                        <i data-feather="arrow-right" class="w-4 h-4 relative z-10 transition-transform duration-300 group-hover:translate-x-1"></i>
                                    </a>
                                @endif

                                <a href="{{ route('frontend.documents.index') }}"
                                    class="rounded-xl border border-white/30 bg-white/10 backdrop-blur-md px-6 py-3 text-sm font-semibold text-white transition-all duration-300 hover:bg-white/20 hover:border-white/50 active:scale-95 flex items-center gap-2">
                                    <i data-feather="file-text" class="w-4 h-4"></i>
                                    <span>Dokumen & SOP</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Slider Controls: Prev & Next Buttons -->
        @if($banners->count() > 1)
            <div class="absolute inset-x-0 top-1/2 -translate-y-1/2 z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between pointer-events-none">
                <button id="slider-btn-prev"
                    type="button"
                    aria-label="Slide sebelumnya"
                    class="pointer-events-auto p-3 rounded-full bg-black/30 backdrop-blur-md text-white border border-white/20 hover:bg-[#0BB5CB] hover:border-transparent transition-all duration-300 focus:outline-hidden cursor-pointer">
                    <i data-feather="chevron-left" class="w-5 h-5"></i>
                </button>
                <button id="slider-btn-next"
                    type="button"
                    aria-label="Slide berikutnya"
                    class="pointer-events-auto p-3 rounded-full bg-black/30 backdrop-blur-md text-white border border-white/20 hover:bg-[#0BB5CB] hover:border-transparent transition-all duration-300 focus:outline-hidden cursor-pointer">
                    <i data-feather="chevron-right" class="w-5 h-5"></i>
                </button>
            </div>

            <!-- Dots Indicator & Progress Container -->
            <div class="absolute bottom-6 inset-x-0 z-20 flex items-center justify-center gap-2.5">
                @foreach($banners as $index => $banner)
                    <button type="button"
                        aria-label="Menuju slide {{ $index + 1 }}"
                        class="slider-dot h-2.5 rounded-full transition-all duration-300 cursor-pointer {{ $index === 0 ? 'w-8 bg-[#0BB5CB]' : 'w-2.5 bg-white/40 hover:bg-white/70' }}"
                        data-slide-target="{{ $index }}">
                    </button>
                @endforeach
            </div>
        @endif
    @else
        <!-- Fallback Default Hero (When no banner exists) -->
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 flex flex-col justify-center">
            <div class="max-w-3xl space-y-6">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-[#0BB5CB]/20 border border-[#0BB5CB]/40 backdrop-blur-md text-[#0BB5CB] text-xs font-semibold tracking-wide uppercase">
                    Pusat Penjaminan Mutu
                </div>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white leading-tight tracking-tight">
                    Mengawal Standar Mutu Pendidikan Kesehatan Berkelanjutan
                </h1>
                <p class="text-slate-300 text-base sm:text-lg leading-relaxed max-w-2xl">
                    Portal transparansi Sistem Penjaminan Mutu Internal (SPMI) Politeknik Kesehatan Kementerian Kesehatan Medan menuju institusi unggul dan terakreditasi internasional.
                </p>
                <div class="flex flex-wrap items-center gap-4 pt-2">
                    <a href="{{ route('frontend.documents.index') }}"
                        class="rounded-xl bg-linear-to-r from-[#0BB5CB] to-[#028DA9] px-6 py-3 text-sm font-semibold text-white shadow-lg transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
                        Jelajahi Dokumen Mutu
                    </a>
                    <a href="{{ route('frontend.profile') }}"
                        class="rounded-xl border border-white/30 bg-white/10 backdrop-blur-md px-6 py-3 text-sm font-semibold text-white transition-all duration-300 hover:bg-white/20">
                        Profil Organisasi
                    </a>
                </div>
            </div>
        </div>
    @endif
</section>
