/**
 * Login Page Scripts
 * PPM Poltekkes Kemenkes Medan
 * Custom client-side validation, password visibility toggle, and instant feedback.
 */
document.addEventListener('DOMContentLoaded', () => {
    // 1. Password Visibility Toggle
    const toggleBtn = document.getElementById('toggle-password-btn');
    const passwordInput = document.getElementById('password');
    const icon = document.getElementById('toggle-password-icon');

    if (toggleBtn && passwordInput && icon) {
        toggleBtn.addEventListener('click', (e) => {
            e.preventDefault();
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';
            icon.setAttribute('data-feather', isPassword ? 'eye-off' : 'eye');
            if (typeof feather !== 'undefined') {
                feather.replace();
            }
        });
    }

    // 2. Custom Client-Side Form Validation
    const loginForm = document.getElementById('login-form');
    const emailInput = document.getElementById('email');
    const emailErrorContainer = document.getElementById('email-error-container');
    const passwordErrorContainer = document.getElementById('password-error-container');

    if (!loginForm || !emailInput || !passwordInput) return;

    function setEmailError(message) {
        emailInput.classList.remove('border-slate-200', 'hover:border-slate-300', 'focus:border-[#0BB5CB]', 'focus:ring-[#0BB5CB]/15');
        emailInput.classList.add('border-red-500', 'ring-4', 'ring-red-500/10', 'focus:border-red-500');
        if (emailErrorContainer) {
            emailErrorContainer.innerHTML = `
                <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1 client-error-msg">
                    <i data-feather="alert-circle" class="h-3.5 w-3.5"></i>
                    <span>${message}</span>
                </p>
            `;
        }
    }

    function clearEmailError() {
        emailInput.classList.remove('border-red-500', 'ring-4', 'ring-red-500/10', 'focus:border-red-500');
        emailInput.classList.add('border-slate-200', 'hover:border-slate-300', 'focus:border-[#0BB5CB]', 'focus:ring-4', 'focus:ring-[#0BB5CB]/15');
        if (emailErrorContainer) {
            emailErrorContainer.innerHTML = '';
        }
    }

    function setPasswordError(message) {
        passwordInput.classList.remove('border-slate-200', 'hover:border-slate-300', 'focus:border-[#0BB5CB]', 'focus:ring-[#0BB5CB]/15');
        passwordInput.classList.add('border-red-500', 'ring-4', 'ring-red-500/10', 'focus:border-red-500');
        if (passwordErrorContainer) {
            passwordErrorContainer.innerHTML = `
                <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1 client-error-msg">
                    <i data-feather="alert-circle" class="h-3.5 w-3.5"></i>
                    <span>${message}</span>
                </p>
            `;
        }
    }

    function clearPasswordError() {
        passwordInput.classList.remove('border-red-500', 'ring-4', 'ring-red-500/10', 'focus:border-red-500');
        passwordInput.classList.add('border-slate-200', 'hover:border-slate-300', 'focus:border-[#0BB5CB]', 'focus:ring-4', 'focus:ring-[#0BB5CB]/15');
        if (passwordErrorContainer) {
            passwordErrorContainer.innerHTML = '';
        }
    }

    // Clear on typing
    emailInput.addEventListener('input', () => {
        if (emailInput.value.trim().length > 0) {
            clearEmailError();
        }
    });

    passwordInput.addEventListener('input', () => {
        if (passwordInput.value.length > 0) {
            clearPasswordError();
        }
    });

    // Form Submit Interception
    loginForm.addEventListener('submit', (e) => {
        let hasError = false;
        let firstInvalidField = null;

        const emailVal = emailInput.value.trim();
        const passwordVal = passwordInput.value;

        // Email validation
        if (!emailVal) {
            setEmailError('Alamat email wajib diisi.');
            hasError = true;
            if (!firstInvalidField) firstInvalidField = emailInput;
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailVal)) {
            setEmailError('Format alamat email tidak valid.');
            hasError = true;
            if (!firstInvalidField) firstInvalidField = emailInput;
        } else {
            clearEmailError();
        }

        // Password validation
        if (!passwordVal) {
            setPasswordError('Kata sandi wajib diisi.');
            hasError = true;
            if (!firstInvalidField) firstInvalidField = passwordInput;
        } else {
            clearPasswordError();
        }

        if (hasError) {
            e.preventDefault();
            e.stopPropagation();

            if (typeof feather !== 'undefined') {
                feather.replace();
            }

            if (firstInvalidField) {
                firstInvalidField.focus();
            }
        }
    });
});
