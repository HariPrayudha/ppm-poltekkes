<x-layouts.auth title="Masuk ke Panel Admin">
    <div class="rounded-3xl border border-slate-200/80 bg-white p-8 shadow-xl shadow-slate-200/40">
        <!-- Logo / Header -->
        <div class="text-center mb-8">
            <div class="mb-4 inline-flex items-center justify-center">
                <img src="{{ asset('dashboard/assets/image/logo-text-kemnaker.png') }}" alt="PPM Poltekkes Medan" class="h-14 w-auto max-w-65 object-contain">
            </div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">PPM Poltekkes Medan</h1>
            <p class="mt-1 text-sm text-slate-500">Pusat Penjaminan Mutu | Portal Masuk Admin</p>
        </div>

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email Field -->
            @php
                $emailError = $errors->has('email');
                $emailClasses = 'w-full rounded-xl border pl-10 pr-4 py-2.5 text-sm text-slate-900 placeholder:text-slate-400 transition-all focus:outline-none';
                $emailClasses .= $emailError
                    ? ' border-red-500 ring-4 ring-red-500/10 bg-white focus:border-red-500'
                    : ' border-slate-200 bg-slate-50/50 focus:bg-white focus:border-[#0BB5CB] focus:ring-4 focus:ring-[#0BB5CB]/10';
            @endphp
            <div>
                <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-2">
                    Alamat Email
                </label>
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                        <i data-feather="mail" class="h-4 w-4"></i>
                    </div>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        class="{{ $emailClasses }}"
                        placeholder="contoh@ppm.ac.id"
                    >
                </div>
                @error('email')
                    <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                        <i data-feather="alert-circle" class="h-3.5 w-3.5"></i>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Password Field -->
            @php
                $passwordError = $errors->has('password');
                $passwordClasses = 'w-full rounded-xl border pl-10 pr-10 py-2.5 text-sm text-slate-900 placeholder:text-slate-400 transition-all focus:outline-none';
                $passwordClasses .= $passwordError
                    ? ' border-red-500 ring-4 ring-red-500/10 bg-white focus:border-red-500'
                    : ' border-slate-200 bg-slate-50/50 focus:bg-white focus:border-[#0BB5CB] focus:ring-4 focus:ring-[#0BB5CB]/10';
            @endphp
            <div>
                <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-2">
                    Kata Sandi
                </label>
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                        <i data-feather="lock" class="h-4 w-4"></i>
                    </div>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        required
                        class="{{ $passwordClasses }}"
                        placeholder="••••••••"
                    >
                    <button
                        type="button"
                        id="toggle-password-btn"
                        class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-slate-600"
                        tabindex="-1"
                    >
                        <i data-feather="eye" class="h-4 w-4" id="toggle-password-icon"></i>
                    </button>
                </div>
                @error('password')
                    <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                        <i data-feather="alert-circle" class="h-3.5 w-3.5"></i>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input
                        type="checkbox"
                        name="remember"
                        id="remember"
                        value="1"
                        {{ old('remember') ? 'checked' : '' }}
                        class="h-4 w-4 rounded border-slate-300 text-[#0BB5CB] focus:ring-[#0BB5CB]"
                    >
                    <span class="text-xs font-medium text-slate-600">Ingat saya</span>
                </label>
            </div>

            <!-- Submit Button -->
            <button
                type="submit"
                class="w-full flex items-center justify-center gap-2 rounded-xl bg-linear-to-r from-[#00A99D] to-[#0BB5CB] py-3 text-sm font-semibold text-white shadow-lg shadow-[#0BB5CB]/25 hover:from-[#028DA9] hover:to-[#028DA9] transition-all focus:outline-none focus:ring-4 focus:ring-[#0BB5CB]/20"
            >
                <i data-feather="log-in" class="h-4 w-4"></i>
                Masuk ke Dashboard
            </button>
        </form>

        <div class="mt-8 border-t border-slate-100 pt-6 text-center text-xs text-slate-400">
            &copy; {{ date('Y') }} PPM Poltekkes Kemenkes Medan. Hak Cipta Dilindungi.
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggleBtn = document.getElementById('toggle-password-btn');
            const passwordInput = document.getElementById('password');
            const icon = document.getElementById('toggle-password-icon');

            if (toggleBtn && passwordInput) {
                toggleBtn.addEventListener('click', () => {
                    const isPassword = passwordInput.type === 'password';
                    passwordInput.type = isPassword ? 'text' : 'password';
                    icon.setAttribute('data-feather', isPassword ? 'eye-off' : 'eye');
                    if (typeof feather !== 'undefined') feather.replace();
                });
            }
        });
    </script>
</x-layouts.auth>
