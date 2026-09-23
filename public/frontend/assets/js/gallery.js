/**
 * Frontend Gallery Module JavaScript | PPM Poltekkes Kemenkes Medan
 * Handles Gallery Detail Modal & Triggering Global Image Zoom Modal
 */

document.addEventListener('DOMContentLoaded', () => {
    initGalleryDetailModal();
});

function initGalleryDetailModal() {
    const modal = document.getElementById('lightbox-modal');
    if (!modal) return;

    const dialog = document.getElementById('lightbox-dialog');
    const img = document.getElementById('lightbox-img');
    const imgTrigger = document.getElementById('lightbox-img-trigger');
    const headerTitle = document.getElementById('lightbox-header-title');
    const title = document.getElementById('lightbox-title');
    const dateEl = document.getElementById('lightbox-date');
    const metaContainer = document.getElementById('lightbox-meta-container');
    const descEl = document.getElementById('lightbox-desc');
    const descContainer = document.getElementById('lightbox-desc-container');
    const closeBtn = document.getElementById('lightbox-close');

    let currentSrc = '';
    let currentCaption = '';
    let isClosingModal = false;

    function openLightbox(src, caption, date, desc) {
        if (!img) return;
        currentSrc = src;
        currentCaption = caption || '';

        img.src = src;
        if (title) title.textContent = caption || '';
        if (headerTitle) headerTitle.textContent = caption || '';

        // Handle Date metadata
        if (dateEl && metaContainer) {
            if (date && date.trim() !== '') {
                dateEl.textContent = date;
                metaContainer.classList.remove('hidden');
            } else {
                metaContainer.classList.add('hidden');
            }
        }

        // Handle Description block
        if (descEl && descContainer) {
            if (desc && desc.trim() !== '') {
                descEl.textContent = desc;
                descContainer.classList.remove('hidden');
            } else {
                descContainer.classList.add('hidden');
            }
        }

        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.classList.add('overflow-hidden');

        // Smooth Entrance Animation
        requestAnimationFrame(() => {
            requestAnimationFrame(() => {
                modal.classList.remove('opacity-0');
                modal.classList.add('opacity-100');
                if (dialog) {
                    dialog.classList.remove('scale-95', 'opacity-0');
                    dialog.classList.add('scale-100', 'opacity-100');
                }
            });
        });

        if (typeof feather !== 'undefined') {
            feather.replace();
        }
    }

    function closeLightbox() {
        if (isClosingModal) return;
        isClosingModal = true;

        modal.classList.remove('opacity-100');
        modal.classList.add('opacity-0');
        if (dialog) {
            dialog.classList.remove('scale-100', 'opacity-100');
            dialog.classList.add('scale-95', 'opacity-0');
        }

        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            if (img) img.src = '';
            if (title) title.textContent = '';
            if (headerTitle) headerTitle.textContent = '';
            if (dateEl) dateEl.textContent = '';
            if (descEl) descEl.textContent = '';
            // Only release scroll lock if zoom modal isn't open
            const zoomModal = document.getElementById('frontend-image-modal');
            if (!zoomModal || zoomModal.classList.contains('hidden')) {
                document.body.classList.remove('overflow-hidden');
            }
            isClosingModal = false;
        }, 260);
    }

    // Card Trigger Delegation
    document.addEventListener('click', (e) => {
        const trigger = e.target.closest('.lightbox-trigger');
        if (trigger) {
            e.preventDefault();
            const src = trigger.dataset.image;
            const caption = trigger.dataset.title;
            const date = trigger.dataset.date || '';
            const desc = trigger.dataset.description || '';
            if (src) openLightbox(src, caption, date, desc);
        }
    });

    // Clicking image showcase inside modal opens full gesture zoom & pan engine
    if (imgTrigger) {
        imgTrigger.addEventListener('click', (e) => {
            e.stopPropagation();
            if (currentSrc && typeof window.openFrontendImagePreview === 'function') {
                window.openFrontendImagePreview(currentSrc, currentCaption);
            }
        });
    }

    if (closeBtn) {
        closeBtn.addEventListener('click', closeLightbox);
    }

    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            closeLightbox();
        }
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            // If zoom modal is open, let zoom modal handle Escape first
            const zoomModal = document.getElementById('frontend-image-modal');
            if (zoomModal && !zoomModal.classList.contains('hidden')) {
                return;
            }
            if (!modal.classList.contains('hidden')) {
                closeLightbox();
            }
        }
    });
}
