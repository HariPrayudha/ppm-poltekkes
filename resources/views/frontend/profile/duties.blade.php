@extends('layouts.frontend')

@section('title', 'Tugas dan Fungsi')

@section('content')
    <!-- Header Banner Institusi -->
    <div class="bg-linear-to-b from-slate-900 via-slate-900 to-slate-800 text-white py-14 sm:py-18 border-b border-slate-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-[#0BB5CB]/20 border border-[#0BB5CB]/40 text-[#0BB5CB] text-xs font-semibold uppercase tracking-wider mb-4">
                <i data-feather="clipboard" class="w-3.5 h-3.5"></i>
                Profil Institusi
            </div>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight">
                Tugas Pokok dan Fungsi Pusat Penjaminan Mutu
            </h1>
            <p class="mt-4 text-slate-300 text-sm sm:text-base max-w-2xl mx-auto leading-relaxed">
                Mandat, kewenangan, dan tugas operasional penjaminan mutu internal berdasarkan ketetapan statuta Poltekkes Kemenkes Medan.
            </p>
        </div>
    </div>

    <!-- Main Content: Deskripsi Lengkap Tupoksi -->
    <section class="py-12 sm:py-16 bg-slate-50 min-h-[500px] reveal-on-scroll">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-12 shadow-xs">
                <div class="pb-6 border-b border-slate-100 mb-8">
                    <h2 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight">
                        Tugas dan Fungsi (Tupoksi)
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-500 mt-1">
                        Pusat Penjaminan Mutu Politeknik Kesehatan Kementerian Kesehatan Medan.
                    </p>
                </div>

                @if($profile && $profile->duties_content)
                    <div class="prose prose-slate max-w-none text-slate-700 text-sm sm:text-base leading-relaxed space-y-4 font-normal">
                        {!! $profile->duties_content !!}
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center py-20 text-slate-400 bg-slate-50/80 rounded-2xl border border-dashed border-slate-300">
                        <i data-feather="file-text" class="w-12 h-12 text-slate-300 mb-3"></i>
                        <p class="text-sm font-medium">Uraian tugas pokok dan fungsi belum diunggah.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
