/**
 * Frontend JavaScript - Pusat Penjaminan Mutu (PPM) Poltekkes Kemenkes Medan
 * Handles Slider, Scroll Reveal, Number Counters, Lightbox, Anti-IDM Blob PDF Preview, and AJAX Filter.
 */

document.addEventListener('DOMContentLoaded', () => {
    // 1. Initialize Feather Icons
    if (typeof feather !== 'undefined') {
        feather.replace();
    }

    // 2. Mobile Navbar Menu Toggle
    initMobileNav();

    // 3. Navbar Scroll Shrink & Back-to-Top Button
    initScrollInteractions();

    // 4. Hero Banner Slider
    initHeroSlider();

    // 5. Scroll Reveal Observer
    initScrollReveal();

    // 6. Animated Stat Counter Observer
    initStatCounters();

    // 7. Profile Tabs (Struktur Organisasi & Tupoksi)
    initProfileTabs();

    // 8. Lightbox Modal (Bagan & Galeri)
    initLightboxModal();

    // 9. Anti-IDM PDF Preview Modal
    initPdfPreviewModal();

    // 10. Document Repository AJAX Filter & Search
    initDocumentRepository();

    // 11. FAQ Accordion Toggle
    initFaqAccordion();
});

/**
 * 2. Mobile Navbar Menu Toggle
 */
function initMobileNav() {
    const btn = document.getElementById('mobile-menu-btn');
    const menu = document.getElementById('mobile-menu');
    const iconOpen = document.getElementById('menu-icon-open');
    const iconClose = document.getElementById('menu-icon-close');

    if (!btn || !menu) return;

    btn.addEventListener('click', () => {
        const isHidden = menu.classList.contains('hidden');
        if (isHidden) {
            menu.classList.remove('hidden');
            if (iconOpen) iconOpen.classList.add('hidden');
            if (iconClose) iconClose.classList.remove('hidden');
        } else {
            menu.classList.add('hidden');
            if (iconOpen) iconOpen.classList.remove('hidden');
            if (iconClose) iconClose.classList.add('hidden');
        }
        if (typeof feather !== 'undefined') feather.replace();
    });

    // Mobile Profile Accordion Submenu Toggle
    const profileToggle = document.getElementById('mobile-profile-toggle');
    const profileSubmenu = document.getElementById('mobile-profile-submenu');
    const profileChevron = document.getElementById('mobile-profile-chevron');

    if (profileToggle && profileSubmenu) {
        profileToggle.addEventListener('click', (e) => {
            e.preventDefault();
            const isOpen = !profileSubmenu.classList.contains('hidden');
            if (isOpen) {
                profileSubmenu.classList.add('hidden');
                if (profileChevron) profileChevron.style.transform = 'rotate(0deg)';
            } else {
                profileSubmenu.classList.remove('hidden');
                if (profileChevron) profileChevron.style.transform = 'rotate(180deg)';
            }
        });
    }
}

/**
 * 3. Navbar Scroll Shrink & Back-to-Top
 */
function initScrollInteractions() {
    const navbar = document.getElementById('main-navbar');
    const backToTop = document.getElementById('back-to-top');

    window.addEventListener('scroll', () => {
        const scrollY = window.scrollY;

        // Navbar shadow / shrink
        if (navbar) {
            if (scrollY > 30) {
                navbar.classList.add('shadow-sm', 'bg-white/95');
                navbar.classList.remove('bg-white/90');
            } else {
                navbar.classList.remove('shadow-sm', 'bg-white/95');
                navbar.classList.add('bg-white/90');
            }
        }

        // Back to top button visibility
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

/**
 * 4. Hero Banner Slider Carousel
 */
function initHeroSlider() {
    const track = document.getElementById('hero-slider-track');
    if (!track) return;

    const slides = track.querySelectorAll('.hero-slide');
    const dots = document.querySelectorAll('.slider-dot');
    const prevBtn = document.getElementById('slider-btn-prev');
    const nextBtn = document.getElementById('slider-btn-next');
    const container = document.getElementById('hero-slider-container');

    if (slides.length <= 1) return;

    let currentIndex = 0;
    let autoSlideTimer = null;
    const intervalTime = 6000;

    function goToSlide(index) {
        if (index < 0) index = slides.length - 1;
        if (index >= slides.length) index = 0;

        slides.forEach((slide, idx) => {
            if (idx === index) {
                slide.classList.remove('opacity-0', 'pointer-events-none', 'z-0');
                slide.classList.add('opacity-100', 'z-10');
            } else {
                slide.classList.remove('opacity-100', 'z-10');
                slide.classList.add('opacity-0', 'pointer-events-none', 'z-0');
            }
        });

        dots.forEach((dot, idx) => {
            if (idx === index) {
                dot.classList.remove('w-2.5', 'bg-white/40');
                dot.classList.add('w-8', 'bg-[#0BB5CB]');
            } else {
                dot.classList.remove('w-8', 'bg-[#0BB5CB]');
                dot.classList.add('w-2.5', 'bg-white/40');
            }
        });

        currentIndex = index;
    }

    function startAutoSlide() {
        stopAutoSlide();
        autoSlideTimer = setInterval(() => {
            goToSlide(currentIndex + 1);
        }, intervalTime);
    }

    function stopAutoSlide() {
        if (autoSlideTimer) {
            clearInterval(autoSlideTimer);
            autoSlideTimer = null;
        }
    }

    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            goToSlide(currentIndex - 1);
            startAutoSlide();
        });
    }

    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            goToSlide(currentIndex + 1);
            startAutoSlide();
        });
    }

    dots.forEach((dot, idx) => {
        dot.addEventListener('click', () => {
            goToSlide(idx);
            startAutoSlide();
        });
    });

    if (container) {
        container.addEventListener('mouseenter', stopAutoSlide);
        container.addEventListener('mouseleave', startAutoSlide);

        // Touch Swipe Support
        let startX = 0;
        let endX = 0;
        container.addEventListener('touchstart', (e) => {
            startX = e.changedTouches[0].screenX;
        }, { passive: true });

        container.addEventListener('touchend', (e) => {
            endX = e.changedTouches[0].screenX;
            const diff = startX - endX;
            if (Math.abs(diff) > 40) {
                if (diff > 0) {
                    goToSlide(currentIndex + 1);
                } else {
                    goToSlide(currentIndex - 1);
                }
                startAutoSlide();
            }
        }, { passive: true });
    }

    startAutoSlide();
}

/**
 * 5. Scroll Reveal Observer
 */
function initScrollReveal() {
    const revealItems = document.querySelectorAll('.reveal-on-scroll');
    if (!revealItems.length || !('IntersectionObserver' in window)) {
        revealItems.forEach(item => item.classList.add('is-revealed'));
        return;
    }

    const observer = new IntersectionObserver((entries, obs) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-revealed');
                obs.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.12,
        rootMargin: '0px 0px -40px 0px'
    });

    revealItems.forEach(item => observer.observe(item));
}

/**
 * 6. Animated Stat Counters
 */
function initStatCounters() {
    const counters = document.querySelectorAll('.stat-counter-number');
    if (!counters.length || !('IntersectionObserver' in window)) return;

    const observer = new IntersectionObserver((entries, obs) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const el = entry.target;
                const target = parseInt(el.dataset.target, 10) || 0;
                animateCount(el, target);
                obs.unobserve(el);
            }
        });
    }, { threshold: 0.2 });

    counters.forEach(counter => observer.observe(counter));
}

function animateCount(el, target) {
    if (target === 0) {
        el.textContent = '0';
        return;
    }

    const duration = 1400;
    const startTime = performance.now();

    function update(currentTime) {
        const elapsed = currentTime - startTime;
        const progress = Math.min(elapsed / duration, 1);
        // Easing out cubic
        const easeOut = 1 - Math.pow(1 - progress, 3);
        const currentCount = Math.floor(easeOut * target);

        el.textContent = currentCount.toLocaleString('id-ID');

        if (progress < 1) {
            requestAnimationFrame(update);
        } else {
            el.textContent = target.toLocaleString('id-ID');
        }
    }

    requestAnimationFrame(update);
}

/**
 * 7. Profile Tabs (Struktur Organisasi & Tupoksi)
 */
function initProfileTabs() {
    const tabBtns = document.querySelectorAll('.profile-tab-btn');
    if (!tabBtns.length) return;

    tabBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const targetId = btn.dataset.tabTarget;

            // Reset all tab buttons
            tabBtns.forEach(b => {
                b.classList.remove('bg-[#0BB5CB]', 'text-white', 'shadow-xs', 'font-bold');
                b.classList.add('text-slate-600', 'font-semibold');
                b.setAttribute('aria-selected', 'false');
            });

            // Activate clicked tab button
            btn.classList.add('bg-[#0BB5CB]', 'text-white', 'shadow-xs', 'font-bold');
            btn.classList.remove('text-slate-600');
            btn.setAttribute('aria-selected', 'true');

            // Toggle tab content panels
            document.querySelectorAll('.profile-tab-content').forEach(content => {
                if (content.id === targetId) {
                    content.classList.remove('hidden');
                } else {
                    content.classList.add('hidden');
                }
            });

            if (typeof feather !== 'undefined') feather.replace();
        });
    });
}

/**
 * 8. Lightbox Modal
 */
function initLightboxModal() {
    const modal = document.getElementById('lightbox-modal');
    if (!modal) return;

    const img = document.getElementById('lightbox-img');
    const title = document.getElementById('lightbox-title');
    const closeBtn = document.getElementById('lightbox-close');

    function openLightbox(src, caption) {
        if (!img) return;
        img.src = src;
        if (title) title.textContent = caption || '';
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.classList.add('overflow-hidden');
    }

    function closeLightbox() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        if (img) img.src = '';
        document.body.classList.remove('overflow-hidden');
    }

    document.addEventListener('click', (e) => {
        const trigger = e.target.closest('.lightbox-trigger');
        if (trigger) {
            e.preventDefault();
            const src = trigger.dataset.image;
            const caption = trigger.dataset.title;
            if (src) openLightbox(src, caption);
        }
    });

    if (closeBtn) {
        closeBtn.addEventListener('click', closeLightbox);
    }

    modal.addEventListener('click', (e) => {
        if (e.target === modal) closeLightbox();
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeLightbox();
        }
    });
}

/**
 * 9. Anti-IDM Blob PDF Preview Modal
 */
let currentBlobUrl = null;

function initPdfPreviewModal() {
    const modal = document.getElementById('pdf-preview-modal');
    if (!modal) return;

    const titleEl = document.getElementById('pdf-modal-title');
    const codeEl = document.getElementById('pdf-modal-code');
    const downloadBtn = document.getElementById('pdf-modal-download');
    const closeBtn = document.getElementById('pdf-modal-close');
    const frame = document.getElementById('pdf-modal-frame');
    const loadingEl = document.getElementById('pdf-modal-loading');
    const errorEl = document.getElementById('pdf-modal-error');
    const errorMsgEl = document.getElementById('pdf-modal-error-msg');

    function closeModal() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.classList.remove('overflow-hidden');

        if (frame) {
            frame.src = 'about:blank';
            frame.classList.add('hidden');
        }

        if (currentBlobUrl) {
            URL.revokeObjectURL(currentBlobUrl);
            currentBlobUrl = null;
        }
    }

    async function openPdfPreview(previewUrl, downloadUrl, title, code) {
        if (titleEl) titleEl.textContent = title || 'Pratinjau Dokumen';
        if (codeEl) codeEl.textContent = code ? `Kode: ${code}` : 'Dokumen SPMI Poltekkes Kemenkes Medan';
        if (downloadBtn) downloadBtn.href = downloadUrl || previewUrl;

        // Reset state
        if (loadingEl) loadingEl.classList.remove('hidden');
        if (errorEl) errorEl.classList.add('hidden');
        if (frame) frame.classList.add('hidden');

        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.classList.add('overflow-hidden');

        try {
            // Anti-IDM Strategy: fetch as binary blob with X-Preview-Request header
            const response = await fetch(previewUrl, {
                headers: {
                    'X-Preview-Request': '1',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            if (!response.ok) {
                throw new Error(`HTTP ${response.status}: Berkas tidak dapat diakses.`);
            }

            const blob = await response.blob();
            if (currentBlobUrl) {
                URL.revokeObjectURL(currentBlobUrl);
            }

            currentBlobUrl = URL.createObjectURL(blob);
            if (frame) {
                frame.src = currentBlobUrl;
                frame.classList.remove('hidden');
            }
            if (loadingEl) loadingEl.classList.add('hidden');
        } catch (err) {
            console.error('[PDF Preview Error]', err);
            if (loadingEl) loadingEl.classList.add('hidden');
            if (errorEl) {
                errorEl.classList.remove('hidden');
                if (errorMsgEl) errorMsgEl.textContent = err.message || 'Terjadi kesalahan saat mengunduh berkas.';
            }
        }
    }

    document.addEventListener('click', (e) => {
        const btn = e.target.closest('.btn-preview-pdf');
        if (btn) {
            e.preventDefault();
            const previewUrl = btn.dataset.previewUrl;
            const downloadUrl = btn.dataset.downloadUrl;
            const title = btn.dataset.title;
            const code = btn.dataset.code;

            if (previewUrl) {
                openPdfPreview(previewUrl, downloadUrl, title, code);
            }
        }
    });

    if (closeBtn) {
        closeBtn.addEventListener('click', closeModal);
    }

    modal.addEventListener('click', (e) => {
        if (e.target === modal) closeModal();
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeModal();
        }
    });
}

/**
 * 10. Document Repository AJAX Filter & Search
 */
function initDocumentRepository() {
    const container = document.getElementById('document-table-container');
    if (!container) return;

    const searchInput = document.getElementById('doc-search-input');
    const yearSelect = document.getElementById('doc-year-select');
    const categoryPills = document.querySelectorAll('.doc-category-pill');
    const tableBody = document.getElementById('doc-table-body');
    const loadingOverlay = document.getElementById('doc-table-loading');
    const fetchUrl = container.dataset.fetchUrl;

    let selectedCategory = '';
    let searchDebounceTimer = null;

    async function fetchDocuments(pageUrl = null) {
        if (loadingOverlay) loadingOverlay.classList.remove('hidden');

        const params = new URLSearchParams();
        if (searchInput && searchInput.value.trim()) {
            params.set('search', searchInput.value.trim());
        }
        if (yearSelect && yearSelect.value) {
            params.set('year', yearSelect.value);
        }
        if (selectedCategory) {
            params.set('category_id', selectedCategory);
        }

        const url = pageUrl || `${fetchUrl}?${params.toString()}`;

        try {
            const response = await fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            if (!response.ok) throw new Error('Gagal memuat data');

            const html = await response.text();
            if (tableBody) {
                tableBody.innerHTML = html;
            }

            if (typeof feather !== 'undefined') feather.replace();
        } catch (err) {
            console.error('[Document Fetch Error]', err);
        } finally {
            if (loadingOverlay) loadingOverlay.classList.add('hidden');
        }
    }

    // Debounced Search Input
    if (searchInput) {
        searchInput.addEventListener('input', () => {
            clearTimeout(searchDebounceTimer);
            searchDebounceTimer = setTimeout(() => {
                fetchDocuments();
            }, 300);
        });
    }

    // Year Dropdown
    if (yearSelect) {
        yearSelect.addEventListener('change', () => {
            fetchDocuments();
        });
    }

    // Category Pills
    categoryPills.forEach(pill => {
        pill.addEventListener('click', () => {
            selectedCategory = pill.dataset.categoryId || '';

            // Update UI classes
            categoryPills.forEach(p => {
                p.classList.remove('bg-[#0BB5CB]', 'text-white', 'shadow-2xs');
                p.classList.add('bg-slate-100', 'text-slate-600');
            });

            pill.classList.add('bg-[#0BB5CB]', 'text-white', 'shadow-2xs');
            pill.classList.remove('bg-slate-100', 'text-slate-600');

            fetchDocuments();
        });
    });

    // Pagination Click Interception (AJAX pagination)
    if (tableBody) {
        tableBody.addEventListener('click', (e) => {
            const paginationLink = e.target.closest('.pagination a, [rel="next"], [rel="prev"]');
            if (paginationLink && paginationLink.href) {
                e.preventDefault();
                fetchDocuments(paginationLink.href);
            }
        });
    }
}

/**
 * 11. FAQ Accordion Toggle
 */
function initFaqAccordion() {
    const accordion = document.getElementById('faq-accordion');
    if (!accordion) return;

    accordion.addEventListener('click', (e) => {
        const trigger = e.target.closest('.faq-trigger');
        if (!trigger) return;

        const item = trigger.closest('.faq-item');
        const content = item.querySelector('.faq-content');
        const icon = trigger.querySelector('[data-feather="chevron-down"]');

        const isCurrentlyOpen = !content.classList.contains('hidden');

        // Close all items
        accordion.querySelectorAll('.faq-item').forEach(otherItem => {
            const otherContent = otherItem.querySelector('.faq-content');
            const otherIcon = otherItem.querySelector('[data-feather="chevron-down"]');
            if (otherContent) otherContent.classList.add('hidden');
            if (otherIcon) otherIcon.style.transform = 'rotate(0deg)';
        });

        // If it was closed, open it
        if (!isCurrentlyOpen) {
            content.classList.remove('hidden');
            if (icon) icon.style.transform = 'rotate(180deg)';
        }
    });
}
