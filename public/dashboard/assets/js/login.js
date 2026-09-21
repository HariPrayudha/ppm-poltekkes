/**
 * Login Page Scripts
 * PPM Poltekkes Kemenkes Medan
 */
document.addEventListener('DOMContentLoaded', () => {
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
});
