import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

// ==========================================================================
// High-End Bidirectional Scroll Animations (Scroll Down & Up)
// ==========================================================================
document.addEventListener('DOMContentLoaded', () => {
    // Check if user prefers reduced motion
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (prefersReducedMotion) return;

    const observerOptions = {
        root: null,
        rootMargin: '0px 0px -60px 0px',
        threshold: [0, 0.1, 0.25]
    };

    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-revealed');
            } else {
                // When scrolling back up, re-trigger if element is scrolled far below viewport
                const rect = entry.target.getBoundingClientRect();
                if (rect.top > window.innerHeight + 50) {
                    entry.target.classList.remove('is-revealed');
                }
            }
        });
    }, observerOptions);

    // Auto-detect and register sections, cards, and editorial containers
    const autoTargets = document.querySelectorAll(
        'section:not(.no-reveal), article, .stagger-item'
    );

    autoTargets.forEach((el) => {
        if (!el.classList.contains('reveal-on-scroll') && 
            !el.classList.contains('reveal-fade') && 
            !el.classList.contains('reveal-scale')) {
            el.classList.add('reveal-on-scroll');
        }
        revealObserver.observe(el);
    });

    // Auto-stagger grid child elements for cascade entrance effect
    document.querySelectorAll('.grid').forEach(grid => {
        Array.from(grid.children).forEach((child, index) => {
            if (!child.classList.contains('no-reveal')) {
                if (!child.classList.contains('reveal-on-scroll')) {
                    child.classList.add('reveal-on-scroll');
                }
                child.style.transitionDelay = `${(index % 4) * 90}ms`;
                revealObserver.observe(child);
            }
        });
    });
});
