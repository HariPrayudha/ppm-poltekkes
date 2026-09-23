@extends('layouts.frontend')

@section('title', 'Tugas dan Fungsi')

@section('content')
    <!-- Institutional Header Banner (Light & Professional, Aligned with Dokumen, Galeri, and Kontak) -->
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
                <span class="text-slate-500">Profil</span>
                <i data-feather="chevron-right" class="w-3.5 h-3.5 text-slate-300"></i>
                <span class="text-[#028DA9] font-bold">Tugas dan Fungsi</span>
            </nav>

            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-black text-slate-900 tracking-tight">
                Tugas Pokok dan Fungsi PPM
            </h1>
            <p class="mt-2 text-xs sm:text-sm text-slate-600 max-w-2xl leading-relaxed">
                Mandat, kewenangan, dan tugas operasional penjaminan mutu internal berdasarkan ketetapan statuta Poltekkes Kemenkes Medan.
            </p>
        </div>
    </div>

    <!-- Main Content: Deskripsi Lengkap Tupoksi -->
    <section class="pt-5 pb-12 sm:pt-7 sm:pb-16 bg-slate-50/60 min-h-[600px] reveal-on-scroll">
        <div class="max-w-7xl mx-auto px-3.5 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl sm:rounded-3xl border border-slate-200/80 p-5 sm:p-8 md:p-10 shadow-xs">
                @if($profile && $profile->duties_content)
                    <div class="tupoksi-content text-slate-700 text-sm sm:text-base leading-relaxed space-y-4 [&_h3]:text-base sm:[&_h3]:text-lg [&_h3]:font-bold [&_h3]:text-slate-900 [&_h3]:pt-5 [&_h3]:pb-1.5 [&_h3]:first:pt-0 [&_ol]:list-decimal [&_ol]:pl-5 sm:[&_ol]:pl-6 [&_ol]:space-y-2 [&_ul]:list-disc [&_ul]:pl-5 sm:[&_ul]:pl-6 [&_ul]:space-y-2 [&_li]:leading-relaxed [&_li]:text-slate-700 [&_p]:leading-relaxed [&_p]:text-slate-700">
                        {!! $profile->duties_content !!}
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center py-20 text-slate-400 bg-slate-50/80 rounded-2xl border border-dashed border-slate-300 text-center px-4">
                        <div class="w-14 h-14 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center border border-slate-200/80 mb-3 shadow-2xs">
                            <i data-feather="file-text" class="w-7 h-7 text-slate-400"></i>
                        </div>
                        <p class="text-sm font-bold text-slate-800">Uraian Tugas Pokok dan Fungsi Belum Diunggah</p>
                        <p class="text-xs text-slate-500 max-w-sm mt-1 leading-relaxed">
                            Uraian tugas pokok dan fungsi PPM Poltekkes Kemenkes Medan saat ini sedang dalam proses pembaruan administrasi.
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection

