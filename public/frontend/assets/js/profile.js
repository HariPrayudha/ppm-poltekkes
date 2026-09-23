/**
 * Frontend Profile Module JavaScript | PPM Poltekkes Kemenkes Medan
 * Handles Profile Tabs (Struktur Organisasi & Tupoksi)
 */

document.addEventListener('DOMContentLoaded', () => {
    initProfileTabs();
});

/* ==========================================================================
   Profile Tabs (Struktur Organisasi & Tupoksi)
   ========================================================================== */
function initProfileTabs() {
    const tabBtns = document.querySelectorAll('.profile-tab-btn');
    if (!tabBtns.length) return;

    tabBtns.forEach((btn) => {
        btn.addEventListener('click', () => {
            const targetId = btn.dataset.tabTarget;

            // Reset all tab buttons
            tabBtns.forEach((b) => {
                b.classList.remove('bg-[#0BB5CB]', 'text-white', 'shadow-xs', 'font-bold');
                b.classList.add('text-slate-600', 'font-semibold');
                b.setAttribute('aria-selected', 'false');
            });

            // Activate clicked tab button
            btn.classList.add('bg-[#0BB5CB]', 'text-white', 'shadow-xs', 'font-bold');
            btn.classList.remove('text-slate-600');
            btn.setAttribute('aria-selected', 'true');

            // Toggle tab content panels
            document.querySelectorAll('.profile-tab-content').forEach((content) => {
                if (content.id === targetId) {
                    content.classList.remove('hidden');
                } else {
                    content.classList.add('hidden');
                }
            });

            if (typeof feather !== 'undefined') {
                feather.replace();
            }
        });
    });
}
