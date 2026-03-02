import './bootstrap';
import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

// Initialize Alpine.js
Alpine.plugin(collapse);
window.Alpine = Alpine;
Alpine.start();

gsap.registerPlugin(ScrollTrigger);

// Make gsap available globally for inline scripts
window.gsap = gsap;
window.ScrollTrigger = ScrollTrigger;

document.addEventListener('DOMContentLoaded', () => {
    initScrollProgress();
    initNavbar();
    initScrollAnimations();
    initCounters();
    initParallax();
    initBackToTop();
    initSmoothPageTransitions();
});

/* ===== Scroll Progress Bar ===== */
function initScrollProgress() {
    const progressBar = document.getElementById('scroll-progress');
    if (!progressBar) return;

    window.addEventListener('scroll', () => {
        const scrollTop = window.scrollY;
        const docHeight = document.documentElement.scrollHeight - window.innerHeight;
        const scrollPercent = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
        progressBar.style.width = scrollPercent + '%';
    }, { passive: true });
}

/* ===== Navbar Scroll Effect ===== */
function initNavbar() {
    const nav = document.getElementById('main-nav');
    if (!nav) return;

    let lastScrollY = 0;
    let ticking = false;

    const updateNav = () => {
        const scrollY = window.scrollY;

        if (scrollY > 50) {
            nav.classList.add('nav-scrolled');
            nav.classList.remove('nav-top');
        } else {
            nav.classList.remove('nav-scrolled');
            nav.classList.add('nav-top');
        }

        // Hide navbar on scroll down, show on scroll up (only past hero)
        if (scrollY > 600) {
            if (scrollY > lastScrollY + 5) {
                nav.style.transform = 'translateY(-100%)';
            } else if (scrollY < lastScrollY - 5) {
                nav.style.transform = 'translateY(0)';
            }
        } else {
            nav.style.transform = 'translateY(0)';
        }

        lastScrollY = scrollY;
        ticking = false;
    };

    window.addEventListener('scroll', () => {
        if (!ticking) {
            requestAnimationFrame(updateNav);
            ticking = true;
        }
    }, { passive: true });

    updateNav();
}

/* ===== Scroll Animations ===== */
function initScrollAnimations() {
    // Respect reduced motion preference
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

    // Fade up elements
    gsap.utils.toArray('.gsap-fade-up').forEach(el => {
        gsap.to(el, {
            opacity: 1,
            y: 0,
            duration: 0.8,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: el,
                start: 'top 85%',
                once: true,
            },
        });
    });

    // Fade left elements
    gsap.utils.toArray('.gsap-fade-left').forEach(el => {
        gsap.to(el, {
            opacity: 1,
            x: 0,
            duration: 0.8,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: el,
                start: 'top 85%',
                once: true,
            },
        });
    });

    // Fade right elements
    gsap.utils.toArray('.gsap-fade-right').forEach(el => {
        gsap.to(el, {
            opacity: 1,
            x: 0,
            duration: 0.8,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: el,
                start: 'top 85%',
                once: true,
            },
        });
    });

    // Scale in elements
    gsap.utils.toArray('.gsap-scale-in').forEach(el => {
        gsap.to(el, {
            opacity: 1,
            scale: 1,
            duration: 0.6,
            ease: 'back.out(1.4)',
            scrollTrigger: {
                trigger: el,
                start: 'top 85%',
                once: true,
            },
        });
    });

    // Stagger children animations
    gsap.utils.toArray('[data-stagger]').forEach(container => {
        const children = container.children;
        gsap.fromTo(children,
            { opacity: 0, y: 30 },
            {
                opacity: 1,
                y: 0,
                duration: 0.6,
                stagger: 0.15,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: container,
                    start: 'top 80%',
                    once: true,
                },
            }
        );
    });

    // Gold line animations
    gsap.utils.toArray('.gold-line').forEach(el => {
        gsap.fromTo(el,
            { width: 0 },
            {
                width: '4rem',
                duration: 0.8,
                ease: 'power2.out',
                scrollTrigger: {
                    trigger: el,
                    start: 'top 90%',
                    once: true,
                },
            }
        );
    });
}

/* ===== Counter Animations ===== */
function initCounters() {
    gsap.utils.toArray('[data-counter]').forEach(el => {
        const target = parseInt(el.dataset.counter, 10);
        const suffix = el.dataset.suffix || '';

        ScrollTrigger.create({
            trigger: el,
            start: 'top 85%',
            once: true,
            onEnter: () => {
                gsap.to({ val: 0 }, {
                    val: target,
                    duration: 2,
                    ease: 'power2.out',
                    onUpdate: function() {
                        el.textContent = Math.round(this.targets()[0].val) + suffix;
                    },
                });
            },
        });
    });
}

/* ===== Parallax ===== */
function initParallax() {
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

    gsap.utils.toArray('[data-parallax]').forEach(el => {
        const speed = parseFloat(el.dataset.parallax) || 0.3;
        gsap.to(el, {
            yPercent: speed * 100,
            ease: 'none',
            scrollTrigger: {
                trigger: el.parentElement,
                start: 'top bottom',
                end: 'bottom top',
                scrub: true,
            },
        });
    });
}

/* ===== Back to Top Button ===== */
function initBackToTop() {
    const btn = document.getElementById('back-to-top');
    if (!btn) return;

    window.addEventListener('scroll', () => {
        if (window.scrollY > 500) {
            btn.classList.add('visible');
        } else {
            btn.classList.remove('visible');
        }
    }, { passive: true });

    btn.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
}

/* ===== Smooth Page Transitions ===== */
function initSmoothPageTransitions() {
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

    // Fade in page on load
    gsap.fromTo('main', { opacity: 0 }, { opacity: 1, duration: 0.4, ease: 'power2.out' });

    // Add transition on internal link clicks
    document.querySelectorAll('a[href]').forEach(link => {
        const href = link.getAttribute('href');
        if (!href || href.startsWith('#') || href.startsWith('mailto:') || href.startsWith('tel:') ||
            href.startsWith('http') || link.hasAttribute('target')) return;

        link.addEventListener('click', (e) => {
            // Skip if modifier keys are pressed
            if (e.metaKey || e.ctrlKey || e.shiftKey) return;

            e.preventDefault();
            gsap.to('main', {
                opacity: 0,
                y: -10,
                duration: 0.2,
                ease: 'power2.in',
                onComplete: () => {
                    window.location.href = href;
                }
            });
        });
    });
}
