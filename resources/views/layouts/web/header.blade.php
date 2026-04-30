<header class="fixed inset-x-0 top-0 z-50 ">
    <div class="container  flex  items-center justify-between gap-4 py-4 px-4 sm:px-6  lg:px-8">
        {{-- Logo --}}
        <a
            href="{{ url('/') }}"
            class=""
        >
            <img
                src="{{ asset('assets/images/logo.png') }}"
                alt="NOTaBENZ Logo"
                class=" max-w-[400px] object-contain object-left"
                width="180"
                height="40"
                decoding="async"
            />
        </a>

        <div class="flex flex-1 items-center justify-end gap-6 lg:gap-12 xl:gap-20">
            {{-- Desktop nav --}}
            <nav class="hidden items-center gap-6 lg:flex xl:gap-10" aria-label="{{ __('Primary') }}">
                <a href="#" class="desktop-nav-link">Identity</a>
                <a href="#" class="desktop-nav-link">Journey</a>
                <a href="#" class="desktop-nav-link">Stories</a>
                <a href="#" class="desktop-nav-link">Artifacts</a>
            </nav>


            <a  href="#" class="desktop-nav-button">Enter</a>

            {{-- Mobile toggle --}}
            <button
                id="menuBtn"
                type="button"
                class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded border border-[var(--white-color)] text-[var(--primary-color)] transition-colors hover:border-[var(--primary-color)] hover:text-[var(--primary-color)] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[var(--primary-color)] lg:hidden"
                aria-controls="mobileMenu"
                aria-expanded="false"
                aria-label="{{ __('Toggle menu') }}"
            >
                <span aria-hidden="true" class="menu-icon-open">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </span>
                <span aria-hidden="true" class="menu-icon-close hidden">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </span>
            </button>
        </div>
    </div>

    {{-- Mobile panel --}}
    <div
        id="mobileMenu"
        class="hidden border-t border-white/10 bg-black/95 backdrop-blur-lg lg:hidden"
        role="dialog"
        aria-label="{{ __('Mobile navigation') }}"
    >
        <nav class="main-container px-4 py-4 sm:px-6 lg:px-8">
            <a href="#" class="mobile-nav-link">Identity</a>
            <a href="#" class="mobile-nav-link">Journey</a>
            <a href="#" class="mobile-nav-link">Stories</a>
            <a href="#" class="mobile-nav-link">Artifacts</a>
            <a
                href="#"
                class="mt-3 flex w-full items-center justify-center border border-[var(--primary-color)] px-5 py-3 text-sm font-semibold uppercase tracking-wider text-[var(--primary-color)] transition-colors hover:bg-[color-mix(in_srgb,var(--primary-color)_12%,transparent)]"
            >Enter</a>
        </nav>
    </div>
</header>

<script>
(function () {
    const menuBtn = document.getElementById('menuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    const iconOpen = menuBtn && menuBtn.querySelector('.menu-icon-open');
    const iconClose = menuBtn && menuBtn.querySelector('.menu-icon-close');

    if (!menuBtn || !mobileMenu) return;

    menuBtn.addEventListener('click', function () {
        const added = mobileMenu.classList.toggle('hidden');
        const expanded = !added;
        menuBtn.setAttribute('aria-expanded', expanded ? 'true' : 'false');
        if (iconOpen && iconClose) {
            iconOpen.classList.toggle('hidden', expanded);
            iconClose.classList.toggle('hidden', !expanded);
        }
    });
})();
</script>
