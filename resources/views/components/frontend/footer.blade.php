@props(['contact' => null])

@php
    $address = $contact?->address ?: 'Jl. Jamin Ginting KM 13,5, Kel. Lau Cih, Kec. Medan Tuntungan, Kota Medan, Sumatera Utara 20137';
    $operatingHours = $contact?->operating_hours ?: 'Senin - Kamis: 07.30 - 16.00 WIB | Jumat: 07.30 - 16.30 WIB';
    $email = $contact?->email ?: 'info@poltekkes-medan.ac.id';
    $phone = $contact?->phone ?: '+62 811-6238-633';
    $instagram = $contact?->instagram_url ?: 'https://instagram.com/poltekkesmedan';
    $youtube = $contact?->youtube_url ?: 'https://youtube.com/@poltekkeskemenkesmedanofficial';
    $facebook = $contact?->facebook_url ?: 'https://facebook.com/poltekkesmedan';
@endphp

<footer class="mt-auto bg-slate-950 text-slate-300 relative overflow-hidden border-t border-slate-800/80">
    <!-- Top Institutional Accent Divider (Gradient from Dashboard Buttons) -->
    <div class="h-1.5 w-full bg-linear-to-r from-[#00A99D] via-[#0BB5CB] to-[#46B58B]"></div>

    <!-- Ambient Gradient Background Accents -->
    <div class="absolute -top-24 right-1/4 w-96 h-96 bg-[#0BB5CB]/5 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -left-20 w-80 h-80 bg-[#00A99D]/5 rounded-full blur-3xl pointer-events-none"></div>

    <!-- Main Footer Container -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 lg:gap-12">
            <!-- Col 1: Institutional Identity & Social Media (5 cols) -->
            <div class="lg:col-span-5 space-y-4">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('dashboard/assets/image/logo-text-kemnaker.png') }}"
                        alt="Poltekkes Kemenkes Medan"
                        class="h-12 w-auto object-contain brightness-0 invert">
                </div>

                <div class="space-y-1">
                    <h3 class="text-base font-extrabold text-white tracking-tight">
                        Pusat Penjaminan Mutu (PPM)
                    </h3>
                    <p class="text-xs font-semibold tracking-wider text-[#0BB5CB] uppercase">
                        Politeknik Kesehatan Kementerian Kesehatan Medan
                    </p>
                </div>

                <p class="text-sm text-slate-400 leading-relaxed max-w-md">
                    Unit kerja pengawal standar mutu pendidikan tinggi kesehatan di lingkungan Poltekkes Kemenkes Medan. Berkomitmen menjaga keterlaksanaan siklus PPEPP demi mutu lulusan tenaga kesehatan yang kompeten dan berintegritas.
                </p>

                <!-- Social Media Links (Font Awesome 6 Brands Library) with Generous Spacing -->
                <div class="pt-3">
                    <span class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-3.5">
                        Media Sosial
                    </span>
                    <div class="flex items-center gap-3">
                        <a href="{{ $instagram }}" target="_blank" rel="noopener noreferrer"
                            class="w-10 h-10 rounded-xl bg-slate-900 border border-slate-800 flex items-center justify-center text-slate-400 hover:text-white hover:border-[#0BB5CB]/50 hover:bg-linear-to-tr hover:from-[#00A99D] hover:to-[#0BB5CB] hover:shadow-lg hover:shadow-[#0BB5CB]/20 hover:-translate-y-0.5 transition-all duration-300 group"
                            title="Instagram Resmi PPM Poltekkes Medan">
                            <i class="fa-brands fa-instagram text-base"></i>
                        </a>
                        <a href="{{ $youtube }}" target="_blank" rel="noopener noreferrer"
                            class="w-10 h-10 rounded-xl bg-slate-900 border border-slate-800 flex items-center justify-center text-slate-400 hover:text-white hover:border-[#0BB5CB]/50 hover:bg-linear-to-tr hover:from-[#00A99D] hover:to-[#0BB5CB] hover:shadow-lg hover:shadow-[#0BB5CB]/20 hover:-translate-y-0.5 transition-all duration-300 group"
                            title="YouTube Resmi PPM Poltekkes Medan">
                            <i class="fa-brands fa-youtube text-base"></i>
                        </a>
                        <a href="{{ $facebook }}" target="_blank" rel="noopener noreferrer"
                            class="w-10 h-10 rounded-xl bg-slate-900 border border-slate-800 flex items-center justify-center text-slate-400 hover:text-white hover:border-[#0BB5CB]/50 hover:bg-linear-to-tr hover:from-[#00A99D] hover:to-[#0BB5CB] hover:shadow-lg hover:shadow-[#0BB5CB]/20 hover:-translate-y-0.5 transition-all duration-300 group"
                            title="Facebook Resmi PPM Poltekkes Medan">
                            <i class="fa-brands fa-facebook-f text-base"></i>
                        </a>
                        <a href="https://wa.me/6281260000000" target="_blank" rel="noopener noreferrer"
                            class="w-10 h-10 rounded-xl bg-slate-900 border border-slate-800 flex items-center justify-center text-slate-400 hover:text-white hover:border-[#0BB5CB]/50 hover:bg-linear-to-tr hover:from-[#00A99D] hover:to-[#0BB5CB] hover:shadow-lg hover:shadow-[#0BB5CB]/20 hover:-translate-y-0.5 transition-all duration-300 group"
                            title="WhatsApp Layanan SPMI">
                            <i class="fa-brands fa-whatsapp text-base"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Col 2: Navigation Links (3 cols) -->
            <div class="lg:col-span-3 space-y-4">
                <div class="space-y-1">
                    <h4 class="text-sm font-bold uppercase tracking-wider text-white">
                        Navigasi Portal
                    </h4>
                    <div class="h-0.5 w-10 bg-linear-to-r from-[#00A99D] to-[#0BB5CB] rounded-full"></div>
                </div>

                <ul class="space-y-2.5 text-sm">
                    <li>
                        <a href="{{ route('frontend.home') }}" class="text-slate-400 hover:text-[#0BB5CB] hover:translate-x-1 transition-all duration-200 flex items-center gap-2">
                            <i data-feather="chevron-right" class="w-3.5 h-3.5 text-[#00A99D]"></i>
                            <span>Beranda</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('frontend.profile.structure') }}" class="text-slate-400 hover:text-[#0BB5CB] hover:translate-x-1 transition-all duration-200 flex items-center gap-2">
                            <i data-feather="chevron-right" class="w-3.5 h-3.5 text-[#00A99D]"></i>
                            <span>Struktur Organisasi</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('frontend.profile.duties') }}" class="text-slate-400 hover:text-[#0BB5CB] hover:translate-x-1 transition-all duration-200 flex items-center gap-2">
                            <i data-feather="chevron-right" class="w-3.5 h-3.5 text-[#00A99D]"></i>
                            <span>Tugas & Fungsi</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('frontend.documents.index') }}" class="text-slate-400 hover:text-[#0BB5CB] hover:translate-x-1 transition-all duration-200 flex items-center gap-2">
                            <i data-feather="chevron-right" class="w-3.5 h-3.5 text-[#00A99D]"></i>
                            <span>Dokumen & SOP</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('frontend.gallery.index') }}" class="text-slate-400 hover:text-[#0BB5CB] hover:translate-x-1 transition-all duration-200 flex items-center gap-2">
                            <i data-feather="chevron-right" class="w-3.5 h-3.5 text-[#00A99D]"></i>
                            <span>Galeri Kegiatan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('frontend.contact.index') }}" class="text-slate-400 hover:text-[#0BB5CB] hover:translate-x-1 transition-all duration-200 flex items-center gap-2">
                            <i data-feather="chevron-right" class="w-3.5 h-3.5 text-[#00A99D]"></i>
                            <span>Kontak Kami</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Col 3: Official Contact & Hours (4 cols) -->
            <div class="lg:col-span-4 space-y-4">
                <div class="space-y-1">
                    <h4 class="text-sm font-bold uppercase tracking-wider text-white">
                        Kontak & Layanan
                    </h4>
                    <div class="h-0.5 w-10 bg-linear-to-r from-[#00A99D] to-[#0BB5CB] rounded-full"></div>
                </div>

                <div class="space-y-3.5 text-sm text-slate-400">
                    <div class="flex items-start gap-3">
                        <div class="w-7 h-7 rounded-lg bg-slate-900 border border-slate-800 flex items-center justify-center shrink-0 mt-0.5 text-[#00A99D]">
                            <i data-feather="map-pin" class="w-3.5 h-3.5"></i>
                        </div>
                        <span class="leading-relaxed text-xs">{{ $address }}</span>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="w-7 h-7 rounded-lg bg-slate-900 border border-slate-800 flex items-center justify-center shrink-0 text-[#00A99D]">
                            <i data-feather="mail" class="w-3.5 h-3.5"></i>
                        </div>
                        <a href="mailto:{{ $email }}" class="text-xs hover:text-[#0BB5CB] transition-colors truncate">{{ $email }}</a>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="w-7 h-7 rounded-lg bg-slate-900 border border-slate-800 flex items-center justify-center shrink-0 text-[#00A99D]">
                            <i data-feather="phone" class="w-3.5 h-3.5"></i>
                        </div>
                        <a href="tel:{{ $phone }}" class="text-xs hover:text-[#0BB5CB] transition-colors">{{ $phone }}</a>
                    </div>

                    <!-- Operational Hours Box (Paling Bawah) -->
                    <div class="p-3 rounded-xl bg-slate-900/90 border border-slate-800/80 space-y-1 mt-1">
                        <div class="flex items-center gap-2 text-xs font-semibold text-slate-200">
                            <span class="w-2 h-2 rounded-full bg-[#46B58B] animate-pulse"></span>
                            <span>Jam Operasional Layanan</span>
                        </div>
                        <p class="text-xs text-slate-400 pl-4">{{ $operatingHours }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Copyright Bar -->
    <div class="border-t border-slate-800/90 bg-slate-950 py-5 relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-400">
            <p>
                &copy; {{ date('Y') }} Pusat Penjaminan Mutu | Poltekkes Kemenkes Medan. Hak Cipta Dilindungi.
            </p>
            <div class="flex items-center gap-2.5">
                <span class="inline-block w-2 h-2 rounded-full bg-linear-to-r from-[#00A99D] to-[#46B58B]"></span>
                <span class="font-medium text-slate-300">Kementerian Kesehatan Republik Indonesia</span>
            </div>
        </div>
    </div>
</footer>