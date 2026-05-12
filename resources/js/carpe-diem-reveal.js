import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

function initCarpeDiemReveal() {
    const section = document.querySelector('.parallax-reveal-section');
    if (! section) {
        return;
    }

    const scroll = section.querySelector('.parallax-reveal-scroll');
    const sticky = section.querySelector('.parallax-reveal-sticky');
    const frame = section.querySelector('.js-parallax-reveal-frame');
    if (! scroll || ! sticky || ! frame) {
        return;
    }

    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        gsap.set(frame, { width: '100%', borderRadius: 0 });
        gsap.set(sticky, { paddingLeft: 0, paddingRight: 0 });
        return;
    }

    const mm = gsap.matchMedia();

    mm.add('(max-width: 767px)', () => {
        gsap.set(frame, { width: '100%', borderRadius: 12 });
        gsap.set(sticky, { paddingLeft: 16, paddingRight: 16 });
        return () => {
            gsap.set(frame, { clearProps: 'width,borderRadius' });
            gsap.set(sticky, { clearProps: 'paddingLeft,paddingRight' });
        };
    });

    mm.add('(min-width: 768px)', () => {
        const ctx = gsap.context(() => {
            gsap.timeline({
                defaults: { ease: 'none' },
                scrollTrigger: {
                    trigger: scroll,
                    start: 'top top',
                    end: 'bottom bottom',
                    scrub: 1.15,
                    invalidateOnRefresh: true,
                },
            })
                .fromTo(
                    frame,
                    { width: '82%', borderRadius: 24 },
                    { width: '100%', borderRadius: 0, duration: 1 },
                    0,
                )
                .fromTo(
                    sticky,
                    { paddingLeft: 32, paddingRight: 32 },
                    { paddingLeft: 0, paddingRight: 0, duration: 1 },
                    0,
                );
        }, section);
        return () => ctx.revert();
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initCarpeDiemReveal);
} else {
    initCarpeDiemReveal();
}
