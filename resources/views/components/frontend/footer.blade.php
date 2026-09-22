@props(['contact' => null])

@php
    $address = $contact?->address ?: 'Jl. Jamin Ginting KM. 13,5 Kel. Lau Cih, Kec. Medan Tuntungan, Kota Medan, Sumatera Utara 20137';
    $operatingHours = $contact?->operating_hours ?: 'Senin - Jumat: 08.00 - 16.00 WIB';
    $email = $contact?->email ?: 'mutu@poltekkes-medan.ac.id';
    $phone = $contact?->phone ?: '(061) 8368633';
    $instagram = $contact?->instagram_url ?: 'https://instagram.com';
    $youtube = $contact?->youtube_url ?: 'https://youtube.com';
    $facebook = $contact?->facebook_url ?: 'https://facebook.com';
@endphp

<footer class="mt-auto bg-slate-900 text-slate-300 border-t border-slate-800">
    <!-- Top Footer Info Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 lg:gap-8">
            <!-- Col 1: Institutional Identity (5 cols) -->
            <div class="lg:col-span-5 space-y-4">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('dashboard/assets/image/logo-text-kemnaker.png') }}"
                        alt="Poltekkes Kemenkes Medan"
                        class="h-12 w-auto object-contain brightness-0 invert">
                </div>
                <h3 class="text-base font-bold text-white tracking-tight">
                    Pusat Penjaminan Mutu (PPM)
                </h3>
                <p class="text-sm text-slate-400 leading-relaxed max-w-md">
                    Unit kerja pengawal standar mutu akademik dan non-akademik di lingkungan Politeknik Kesehatan Kementerian Kesehatan Medan, berdedikasi mewujudkan pendidikan tinggi kesehatan yang bermutu, unggul, dan berdaya saing.
                </p>
                <!-- Social Media Links -->
                <div class="flex items-center gap-3 pt-2">
                    <a href="{{ $instagram }}" target="_blank" rel="noopener noreferrer"
                        class="w-10 h-10 rounded-xl bg-slate-800 flex items-center justify-center text-slate-400 hover:text-white hover:bg-[#0BB5CB] transition-all duration-200"
                        title="Instagram PPM">
                        <i data-feather="instagram" class="w-4 h-4"></i>
                    </a>
                    <a href="{{ $youtube }}" target="_blank" rel="noopener noreferrer"
                        class="w-10 h-10 rounded-xl bg-slate-800 flex items-center justify-center text-slate-400 hover:text-white hover:bg-[#0BB5CB] transition-all duration-200"
                        title="YouTube PPM">
                        <i data-feather="youtube" class="w-4 h-4"></i>
                    </a>
                    <a href="{{ $facebook }}" target="_blank" rel="noopener noreferrer"
                        class="w-10 h-10 rounded-xl bg-slate-800 flex items-center justify-center text-slate-400 hover:text-white hover:bg-[#0BB5CB] transition-all duration-200"
                        title="Facebook PPM">
                        <i data-feather="facebook" class="w-4 h-4"></i>
                    </a>
                </div>
            </div>

            <!-- Col 2: Quick Links (3 cols) -->
            <div class="lg:col-span-3 space-y-4">
                <h4 class="text-sm font-bold uppercase tracking-wider text-white border-b border-slate-800 pb-2 inline-block">
                    Tautan Cepat
                </h4>
                <ul class="space-y-2.5 text-sm">
                    <li>
                        <a href="{{ route('frontend.home') }}" class="hover:text-[#0BB5CB] transition-colors duration-200 flex items-center gap-2">
                            <i data-feather="chevron-right" class="w-3.5 h-3.5 text-slate-500"></i>
                            <span>Beranda</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('frontend.profile.structure') }}" class="hover:text-[#0BB5CB] transition-colors duration-200 flex items-center gap-2">
                            <i data-feather="chevron-right" class="w-3.5 h-3.5 text-slate-500"></i>
                            <span>Struktur Organisasi</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('frontend.profile.duties') }}" class="hover:text-[#0BB5CB] transition-colors duration-200 flex items-center gap-2">
                            <i data-feather="chevron-right" class="w-3.5 h-3.5 text-slate-500"></i>
                            <span>Tugas & Fungsi</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('frontend.documents.index') }}" class="hover:text-[#0BB5CB] transition-colors duration-200 flex items-center gap-2">
                            <i data-feather="chevron-right" class="w-3.5 h-3.5 text-slate-500"></i>
                            <span>Dokumen & SOP</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('frontend.gallery.index') }}" class="hover:text-[#0BB5CB] transition-colors duration-200 flex items-center gap-2">
                            <i data-feather="chevron-right" class="w-3.5 h-3.5 text-slate-500"></i>
                            <span>Galeri</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('frontend.contact.index') }}" class="hover:text-[#0BB5CB] transition-colors duration-200 flex items-center gap-2">
                            <i data-feather="chevron-right" class="w-3.5 h-3.5 text-slate-500"></i>
                            <span>Kontak</span>
                        </a>
                    </li>
                    <li class="pt-2 border-t border-slate-800/80">
                        <a href="{{ route('login') }}" class="text-slate-400 hover:text-[#0BB5CB] transition-colors duration-200 flex items-center gap-2 text-xs">
                            <i data-feather="lock" class="w-3.5 h-3.5 text-slate-500"></i>
                            <span>Login Admin</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Col 3: Contact Details (4 cols) -->
            <div class="lg:col-span-4 space-y-4">
                <h4 class="text-sm font-bold uppercase tracking-wider text-white border-b border-slate-800 pb-2 inline-block">
                    Kontak Resmi
                </h4>
                <div class="space-y-3 text-sm text-slate-400">
                    <div class="flex items-start gap-3">
                        <i data-feather="map-pin" class="w-4 h-4 text-[#0BB5CB] shrink-0 mt-0.5"></i>
                        <span class="leading-relaxed">{{ $address }}</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i data-feather="clock" class="w-4 h-4 text-[#0BB5CB] shrink-0"></i>
                        <span>{{ $operatingHours }}</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i data-feather="mail" class="w-4 h-4 text-[#0BB5CB] shrink-0"></i>
                        <a href="mailto:{{ $email }}" class="hover:text-white transition-colors">{{ $email }}</a>
                    </div>
                    <div class="flex items-center gap-3">
                        <i data-feather="phone" class="w-4 h-4 text-[#0BB5CB] shrink-0"></i>
                        <a href="tel:{{ $phone }}" class="hover:text-white transition-colors">{{ $phone }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Copyright Bar -->
    <div class="border-t border-slate-800/80 bg-slate-950/60 py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-400">
            <p>
                &copy; {{ date('Y') }} Pusat Penjaminan Mutu | Poltekkes Kemenkes Medan. Hak Cipta Dilindungi.
            </p>
            <p class="flex items-center gap-2">
                <span class="inline-block w-2 h-2 rounded-full bg-[#46B58B]"></span>
                Kementerian Kesehatan Republik Indonesia
            </p>
        </div>
    </div>
</footer>
