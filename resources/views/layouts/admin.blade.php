<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Admin Panel' }} | PPM Poltekkes Kemenkes Medan</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('dashboard/assets/image/favicon-kemnaker.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('dashboard/assets/image/favicon-kemnaker.ico') }}">

    <!-- Google Fonts Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- jQuery Vendor -->
    <script src="{{ asset('dashboard/assets/vendor/jquery/jquery.min.js') }}"></script>

    <!-- Feather Icons CDN -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/dashboard.css') }}?v={{ file_exists(public_path('dashboard/assets/css/dashboard.css')) ? filemtime(public_path('dashboard/assets/css/dashboard.css')) : time() }}">

    @stack('styles')
</head>

<body class="h-screen overflow-hidden bg-[#f8fafc] text-slate-900 antialiased flex">

    <!-- Floating Toast Notification Container (Fixed Top-Right) -->
    <div id="toast-container"
        class="fixed right-4 top-4 z-9999 flex flex-col gap-2 pointer-events-none"
        @if(session('success')) data-toast-success="{{ session('success') }}" @endif
        @if(session('error')) data-toast-error="{{ session('error') }}" @endif
        @if(session('warning')) data-toast-warning="{{ session('warning') }}" @endif
        @if(session('info')) data-toast-info="{{ session('info') }}" @endif
        @if(session('toast_success')) data-toast-success="{{ session('toast_success') }}" @endif
        @if(session('toast_error')) data-toast-error="{{ session('toast_error') }}" @endif
        @if(session('toast_warning')) data-toast-warning="{{ session('toast_warning') }}" @endif
        @if(session('toast_info')) data-toast-info="{{ session('toast_info') }}" @endif
        @if($errors->any()) data-toast-error="{{ $errors->first() }}" @endif>
    </div>

    <!-- Admin Sidebar -->
    <x-layouts.admin-sidebar />

    <!-- Main Content Wrapper (Fixed Height Viewport) -->
    <div class="flex flex-1 flex-col lg:pl-64 min-w-0 h-screen overflow-hidden transition-all">
        <!-- Admin Header -->
        <x-layouts.admin-header />

        <!-- Main Scrollable Body -->
        <main class="flex-1 overflow-y-auto w-full">
            <div class="max-w-7xl w-full mx-auto px-4 py-6 sm:px-6 sm:py-7 lg:px-8 lg:py-8">
                @yield('content')
                {{ $slot ?? '' }}
            </div>
        </main>

        <!-- Admin Footer (Pinned at Bottom, Non-scrolling) -->
        <footer class="shrink-0 border-t border-slate-200/80 bg-white py-3 px-4 sm:px-6 text-center text-[11px] sm:text-xs text-slate-400 z-20">
            &copy; {{ date('Y') }} Pusat Penjaminan Mutu (PPM) Poltekkes Kemenkes Medan. Seluruh hak cipta dilindungi.
        </footer>
    </div>

    <!-- Modals Outlet -->
    @yield('modals')

    <!-- Global Image Preview Lightbox Modal -->
    <x-admin.image-modal />

    <!-- Global Date Picker Modal -->
    <x-admin.date-modal />

    <!-- Global PDF Preview Modal -->
    <x-admin.pdf-modal />

    <!-- Dashboard Core JS -->
    <script src="{{ asset('dashboard/assets/js/dashboard.js') }}?v={{ file_exists(public_path('dashboard/assets/js/dashboard.js')) ? filemtime(public_path('dashboard/assets/js/dashboard.js')) : time() }}"></script>

    @stack('scripts')
</body>

</html>