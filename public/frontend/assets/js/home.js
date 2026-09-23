/**
 * Frontend Home Page Module JavaScript | PPM Poltekkes Kemenkes Medan
 * Handles Hero Slider Carousel & Animated Stat Counters
 */

document.addEventListener('DOMContentLoaded', () => {
    initHeroSlider();
    initStatCounters();
});

/* ==========================================================================
   Hero Banner Slider Carousel
   ========================================================================== */
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
                dot.style.width = '2rem';
                dot.style.backgroundColor = '#0BB5CB';
            } else {
                dot.style.width = '0.625rem';
                dot.style.backgroundColor = 'rgba(255, 255, 255, 0.4)';
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

/* ==========================================================================
   Animated Stat Counters
   ========================================================================== */
function initStatCounters() {
    const counters = document.querySelectorAll('.stat-counter-number');
    if (!counters.length || !('IntersectionObserver' in window)) return;

    const observer = new IntersectionObserver((entries, obs) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                const el = entry.target;
                const target = parseInt(el.dataset.target, 10) || 0;
                animateCount(el, target);
                obs.unobserve(el);
            }
        });
    }, { threshold: 0.2 });

    counters.forEach((counter) => observer.observe(counter));
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
