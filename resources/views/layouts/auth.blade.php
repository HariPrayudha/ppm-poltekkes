<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Masuk' }} — PPM Poltekkes Kemenkes Medan</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('dashboard/assets/image/favicon-kemnaker.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('dashboard/assets/image/favicon-kemnaker.png') }}">

    <!-- Google Fonts Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/dashboard.css') }}">
</head>
<body class="min-h-screen bg-slate-50 flex items-center justify-center p-4">
    <!-- Floating Toast Container -->
    <div id="toast-container"
         class="fixed right-4 top-4 z-9999 flex flex-col gap-2 pointer-events-none"
         @if(session('toast_success')) data-toast-success="{{ session('toast_success') }}" @endif
         @if(session('toast_error')) data-toast-error="{{ session('toast_error') }}" @endif
         @if(session('toast_warning')) data-toast-warning="{{ session('toast_warning') }}" @endif
         @if(session('toast_info')) data-toast-info="{{ session('toast_info') }}" @endif>
    </div>

    <main class="w-full max-w-md">
        {{ $slot }}
    </main>

    <script src="{{ asset('dashboard/assets/js/dashboard.js') }}"></script>
</body>
</html>
