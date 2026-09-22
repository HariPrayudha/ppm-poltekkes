<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', $title ?? 'Beranda') | Pusat Penjaminan Mutu Poltekkes Kemenkes Medan</title>
    <meta name="description" content="{{ $metaDescription ?? 'Portal Resmi Pusat Penjaminan Mutu (PPM) Poltekkes Kemenkes Medan. Menyediakan transparansi dokumen SPMI, standar mutu, instrumen akreditasi, dan layanan penjaminan mutu pendidikan tinggi kesehatan.' }}">
    <meta name="keywords" content="PPM, Poltekkes Medan, Penjaminan Mutu, SPMI, Akreditasi, Standar Mutu, SOP, Kemenkes, Kesehatan">
    <meta name="author" content="Pusat Penjaminan Mutu Poltekkes Kemenkes Medan">

    <!-- Open Graph / Meta Sosial -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $title ?? 'Portal Resmi' }} | PPM Poltekkes Kemenkes Medan">
    <meta property="og:description" content="{{ $metaDescription ?? 'Portal Resmi Pusat Penjaminan Mutu Poltekkes Kemenkes Medan. Transparansi standar mutu dan dokumen SPMI pendidikan tenaga kesehatan.' }}">
    <meta property="og:image" content="{{ asset('dashboard/assets/image/logo-text-kemnaker.png') }}">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('dashboard/assets/image/favicon-kemnaker.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('dashboard/assets/image/favicon-kemnaker.ico') }}">

    <!-- Google Fonts Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Feather Icons CDN -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>

    <!-- Font Awesome 6 (Brands & Icons) CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Tailwind CSS v4 & Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/frontend.css') }}">

    @stack('styles')
</head>

<body class="min-h-screen flex flex-col bg-white text-slate-900 font-sans antialiased selection:bg-[#0BB5CB]/20 selection:text-[#028DA9]">

    <!-- Sticky Glassmorphic Navbar -->
    <x-frontend.navbar />

    <!-- Main Content Outlet -->
    <main class="flex-1 w-full">
        @yield('content')
    </main>

    <!-- Rich Institutional Footer -->
    <x-frontend.footer :contact="$contact ?? null" />

    <!-- Floating Back-to-Top Button -->
    <button id="back-to-top"
        type="button"
        aria-label="Kembali ke atas"
        class="fixed bottom-6 right-6 z-40 p-3.5 rounded-2xl bg-linear-to-r from-[#00A99D] to-[#0BB5CB] text-white shadow-lg shadow-[#0BB5CB]/30 opacity-0 translate-y-4 pointer-events-none transition-all duration-300 hover:shadow-xl hover:shadow-[#0BB5CB]/40 hover:-translate-y-1 active:scale-95 cursor-pointer">
        <i data-feather="arrow-up" class="w-5 h-5"></i>
    </button>

    <!-- Global Modals Outlet -->
    @yield('modals')

    <!-- Frontend Interactive Script -->
    <script src="{{ asset('frontend/assets/js/frontend.js') }}" defer></script>

    @stack('scripts')
</body>

</html>
