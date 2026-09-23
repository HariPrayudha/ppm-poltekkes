/**
 * Frontend Core JavaScript | PPM Poltekkes Kemenkes Medan
 * Handles Feather Icons, Mobile Navbar, Scroll Reveal, Back-to-Top, and Global Image Zoom Modal
 */

document.addEventListener('DOMContentLoaded', () => {
    // 1. Feather Icons
    if (typeof feather !== 'undefined') {
        feather.replace();
    }

    // 2. Mobile Navbar Menu Toggle
    initMobileMenu();

    // 3. Navbar Scroll Shrink & Back-to-Top
    initScrollInteractions();

    // 4. Scroll Reveal Observer
    initScrollReveal();

    // 5. Global Image Lightbox Preview Modal with Gesture Zoom & Pan Engine
    initFrontendImagePreviewModal();
});

/* ==========================================================================
   Mobile Navbar Menu Toggle
   ========================================================================== */
function initMobileMenu() {
    const btn = document.getElementById('mobile-menu-btn');
    const menu = document.getElementById('mobile-menu');
    const backdrop = document.getElementById('mobile-menu-backdrop');
    if (!btn || !menu) return;

    const openMenu = () => {
        btn.classList.add('is-active');
        btn.setAttribute('aria-expanded', 'true');
        menu.classList.remove('pointer-events-none', 'opacity-0');
        menu.classList.add('pointer-events-auto', 'opacity-100');
        const drawer = menu.querySelector('div.bg-white');
        if (drawer) {
            drawer.classList.remove('translate-x-full');
            drawer.classList.add('translate-x-0');
        }
        if (backdrop) backdrop.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    };

    const closeMenu = () => {
        btn.classList.remove('is-active');
        btn.setAttribute('aria-expanded', 'false');
        const drawer = menu.querySelector('div.bg-white');
        if (drawer) {
            drawer.classList.remove('translate-x-0');
            drawer.classList.add('translate-x-full');
        }
        menu.classList.remove('pointer-events-auto', 'opacity-100');
        menu.classList.add('pointer-events-none', 'opacity-0');
        if (backdrop) backdrop.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    };

    btn.addEventListener('click', () => {
        const isOpen = btn.classList.contains('is-active');
        if (isOpen) {
            closeMenu();
        } else {
            openMenu();
        }
    });

    if (backdrop) {
        backdrop.addEventListener('click', closeMenu);
    }

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && btn.classList.contains('is-active')) {
            closeMenu();
        }
    });

    menu.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', () => {
            closeMenu();
        });
    });

    // Mobile Profile Submenu Accordion
    const profileToggle = document.getElementById('mobile-profile-toggle');
    const profileSubmenu = document.getElementById('mobile-profile-submenu');
    const profileChevron = document.getElementById('mobile-profile-chevron');

    if (profileToggle && profileSubmenu) {
        profileToggle.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            const isOpen = profileSubmenu.classList.contains('is-open');
            if (isOpen) {
                profileSubmenu.classList.remove('is-open');
                profileToggle.setAttribute('aria-expanded', 'false');
                if (profileChevron) profileChevron.style.transform = 'rotate(0deg)';
            } else {
                profileSubmenu.classList.add('is-open');
                profileToggle.setAttribute('aria-expanded', 'true');
                if (profileChevron) profileChevron.style.transform = 'rotate(180deg)';
                if (typeof feather !== 'undefined') feather.replace();
            }
        });
    }
}

/* ==========================================================================
   Navbar Scroll Shrink & Back-to-Top
   ========================================================================== */
function initScrollInteractions() {
    const navbar = document.getElementById('main-navbar');
    const backToTop = document.getElementById('back-to-top');

    window.addEventListener('scroll', () => {
        const scrollY = window.scrollY;

        if (navbar) {
            if (scrollY > 20) {
                navbar.classList.add('shadow-md', 'bg-white/98');
                navbar.classList.remove('shadow-xs', 'bg-white/95');
            } else {
                navbar.classList.remove('shadow-md', 'bg-white/98');
                navbar.classList.add('shadow-xs', 'bg-white/95');
            }
        }

        if (backToTop) {
            if (scrollY > 350) {
                backToTop.classList.remove('opacity-0', 'translate-y-4', 'pointer-events-none');
                backToTop.classList.add('opacity-100', 'translate-y-0');
            } else {
                backToTop.classList.add('opacity-0', 'translate-y-4', 'pointer-events-none');
                backToTop.classList.remove('opacity-100', 'translate-y-0');
            }
        }
    }, { passive: true });

    if (backToTop) {
        backToTop.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }
}

/* ==========================================================================
   Scroll Reveal Observer
   ========================================================================== */
function initScrollReveal() {
    const reveals = document.querySelectorAll('.reveal-on-scroll');
    if (!reveals.length) return;

    if (!('IntersectionObserver' in window)) {
        reveals.forEach((el) => el.classList.add('is-revealed'));
        return;
    }

    const observer = new IntersectionObserver((entries, obs) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-revealed');
                obs.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    reveals.forEach((el) => observer.observe(el));
}

/* ==========================================================================
   Global Image Lightbox Preview Modal with Gesture Zoom & Pan Engine
   (Desktop: Mouse Wheel Zoom + Drag Pan | Double-Click Zoom | Mobile: Pinch Zoom)
   Matches the battle-tested engine in Admin Dashboard
   ========================================================================== */
let frontendZoomScale = 1;
let frontendPanX = 0;
let frontendPanY = 0;
let frontendIsDragging = false;
let frontendStartDragX = 0;
let frontendStartDragY = 0;
let frontendIsClosing = false;

function applyFrontendImageTransform(animated = false) {
    const wrapper = document.getElementById('frontend-img-zoom-wrapper');
    const container = document.getElementById('frontend-img-zoom-container');
    if (!wrapper) return;

    if (animated) {
        wrapper.style.transition = 'transform 0.2s cubic-bezier(0.16, 1, 0.3, 1)';
    } else {
        wrapper.style.transition = 'none';
    }

    wrapper.style.transform = `translate3d(${frontendPanX}px, ${frontendPanY}px, 0) scale(${frontendZoomScale})`;

    if (container) {
        if (frontendZoomScale > 1.05) {
            container.style.cursor = frontendIsDragging ? 'grabbing' : 'grab';
        } else {
            container.style.cursor = 'default';
        }
    }
}

function resetFrontendImageZoomAndPan(animated = false) {
    frontendZoomScale = 1;
    frontendPanX = 0;
    frontendPanY = 0;
    frontendIsDragging = false;
    applyFrontendImageTransform(animated);
}

function initFrontendImagePreviewModal() {
    // Trigger from any element with [data-preview-image]
    document.addEventListener('click', (e) => {
        const trigger = e.target.closest('[data-preview-image]');
        if (trigger) {
            e.preventDefault();
            const imageUrl = trigger.getAttribute('data-preview-image');
            const imageTitle = trigger.getAttribute('data-preview-title') || 'Pratinjau Foto';
            openFrontendImagePreview(imageUrl, imageTitle);
        }
    });

    const modal = document.getElementById('frontend-image-modal');
    const container = document.getElementById('frontend-img-zoom-container');
    const closeBtn = document.getElementById('frontend-image-modal-close');
    if (!modal || !container) return;

    // 1. Mouse Wheel Zoom In / Out
    container.addEventListener('wheel', (e) => {
        e.preventDefault();
        const zoomFactor = e.deltaY < 0 ? 1.15 : 0.87;
        const newZoom = Math.min(Math.max(frontendZoomScale * zoomFactor, 1), 4);

        if (newZoom === 1) {
            frontendPanX = 0;
            frontendPanY = 0;
        } else if (newZoom !== frontendZoomScale) {
            const rect = container.getBoundingClientRect();
            const mouseX = e.clientX - rect.left - rect.width / 2;
            const mouseY = e.clientY - rect.top - rect.height / 2;
            const scaleRatio = newZoom / frontendZoomScale;
            frontendPanX = mouseX - (mouseX - frontendPanX) * scaleRatio;
            frontendPanY = mouseY - (mouseY - frontendPanY) * scaleRatio;
        }

        frontendZoomScale = newZoom;
        applyFrontendImageTransform(true);
    }, { passive: false });

    // 2. Mouse Drag Pan
    container.addEventListener('mousedown', (e) => {
        if (e.button !== 0) return;
        if (frontendZoomScale <= 1.05) return;

        frontendIsDragging = true;
        frontendStartDragX = e.clientX - frontendPanX;
        frontendStartDragY = e.clientY - frontendPanY;
        applyFrontendImageTransform(false);
    });

    window.addEventListener('mousemove', (e) => {
        if (!frontendIsDragging) return;
        e.preventDefault();
        frontendPanX = e.clientX - frontendStartDragX;
        frontendPanY = e.clientY - frontendStartDragY;
        applyFrontendImageTransform(false);
    });

    window.addEventListener('mouseup', () => {
        if (frontendIsDragging) {
            frontendIsDragging = false;
            applyFrontendImageTransform(true);
        }
    });

    // 3. Double-Click Zoom Toggle (1x <-> 2x)
    container.addEventListener('dblclick', (e) => {
        e.preventDefault();
        if (frontendZoomScale > 1.2) {
            resetFrontendImageZoomAndPan(true);
        } else {
            frontendZoomScale = 2;
            frontendPanX = 0;
            frontendPanY = 0;
            applyFrontendImageTransform(true);
        }
    });

    // 4. Touch Gestures (2-Finger Pinch Zoom & 1-Finger Pan)
    let initialTouchDist = 0;
    let initialTouchZoom = 1;
    let touchStartX = 0;
    let touchStartY = 0;

    container.addEventListener('touchstart', (e) => {
        if (e.touches.length === 2) {
            e.preventDefault();
            frontendIsDragging = false;
            initialTouchDist = Math.hypot(
                e.touches[0].clientX - e.touches[1].clientX,
                e.touches[0].clientY - e.touches[1].clientY
            );
            initialTouchZoom = frontendZoomScale;
        } else if (e.touches.length === 1 && frontendZoomScale > 1.05) {
            frontendIsDragging = true;
            touchStartX = e.touches[0].clientX - frontendPanX;
            touchStartY = e.touches[0].clientY - frontendPanY;
        }
    }, { passive: false });

    container.addEventListener('touchmove', (e) => {
        if (e.touches.length === 2) {
            e.preventDefault();
            const currentDist = Math.hypot(
                e.touches[0].clientX - e.touches[1].clientX,
                e.touches[0].clientY - e.touches[1].clientY
            );
            if (initialTouchDist > 0) {
                const factor = currentDist / initialTouchDist;
                frontendZoomScale = Math.min(Math.max(initialTouchZoom * factor, 1), 4);
                if (frontendZoomScale === 1) {
                    frontendPanX = 0;
                    frontendPanY = 0;
                }
                applyFrontendImageTransform(false);
            }
        } else if (e.touches.length === 1 && frontendIsDragging) {
            e.preventDefault();
            frontendPanX = e.touches[0].clientX - touchStartX;
            frontendPanY = e.touches[0].clientY - touchStartY;
            applyFrontendImageTransform(false);
        }
    }, { passive: false });

    container.addEventListener('touchend', (e) => {
        if (e.touches.length === 0) {
            frontendIsDragging = false;
            if (frontendZoomScale <= 1.05) {
                resetFrontendImageZoomAndPan(true);
            } else {
                applyFrontendImageTransform(true);
            }
        }
    });

    // Close Button & Backdrop Listeners
    if (closeBtn) {
        closeBtn.addEventListener('click', closeFrontendImagePreview);
    }

    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            closeFrontendImagePreview();
        }
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeFrontendImagePreview();
        }
    });
}

function openFrontendImagePreview(imageUrl, title = 'Pratinjau Foto') {
    if (!imageUrl) return;

    const modal = document.getElementById('frontend-image-modal');
    const dialog = document.getElementById('frontend-image-modal-dialog');
    const imgElem = document.getElementById('frontend-image-modal-img');
    const titleElem = document.getElementById('frontend-image-modal-title');
    const linkElem = document.getElementById('frontend-image-modal-link');

    if (!modal) return;

    resetFrontendImageZoomAndPan(false);

    if (imgElem) {
        imgElem.src = imageUrl;
        imgElem.alt = title;
    }
    if (titleElem) {
        titleElem.textContent = title;
    }
    if (linkElem) {
        linkElem.href = imageUrl;
    }

    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.classList.add('overflow-hidden');

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

function closeFrontendImagePreview() {
    const modal = document.getElementById('frontend-image-modal');
    const dialog = document.getElementById('frontend-image-modal-dialog');
    const imgElem = document.getElementById('frontend-image-modal-img');

    if (!modal || frontendIsClosing) return;
    frontendIsClosing = true;

    modal.classList.remove('opacity-100');
    modal.classList.add('opacity-0');
    if (dialog) {
        dialog.classList.remove('scale-100', 'opacity-100');
        dialog.classList.add('scale-95', 'opacity-0');
    }

    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        if (imgElem) imgElem.src = '';
        resetFrontendImageZoomAndPan(false);
        // Only remove body scroll lock if no other modal is currently open
        const otherOpenModal = document.querySelector('#lightbox-modal:not(.hidden), #pdf-modal:not(.hidden)');
        if (!otherOpenModal) {
            document.body.classList.remove('overflow-hidden');
        }
        frontendIsClosing = false;
    }, 260);
}

// Global Exports
window.openFrontendImagePreview = openFrontendImagePreview;
window.closeFrontendImagePreview = closeFrontendImagePreview;
