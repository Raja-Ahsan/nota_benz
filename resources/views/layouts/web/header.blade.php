<header class="absolute inset-x-0 top-0 z-50 ">
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
            <nav class="hidden items-center gap-6 lg:flex xl:gap-10 manrope-font" aria-label="{{ __('Primary') }}">
                <a href="{{ route('about') }}" class="desktop-nav-link">Identity</a>
                <a href="{{ route('journey') }}" class="desktop-nav-link">Journey</a>
                <a href="#" class="desktop-nav-link">Stories</a>
                <a href="{{ route('artifacts.index') }}" class="desktop-nav-link">Artifacts</a>
            </nav>
            <a href="{{ route('cart.index') }}" class="cart-icon-wrapper inline-block no-underline" aria-label="{{ __('Shopping cart') }}">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="100%" viewBox="0 0 105.5 126.1" preserveAspectRatio="xMinYMax meet" data-hook="svg-icon-1"><path d="M102.143 118.16L93.812 48.2067C93.386 44.66 90.3566 42 86.7591 42H79.1382V56H74.4047V42H31.8032V56H27.0697V42H19.4488C15.8513 42 12.8219 44.66 12.3959 48.16L4.06489 118.16C3.78088 120.167 4.44357 122.173 5.76895 123.667C7.14167 125.16 9.0824 126 11.0705 126H95.1374C97.1255 126 99.0662 125.16 100.439 123.667C101.764 122.173 102.427 120.167 102.143 118.16Z"></path><path d="M32.0594 25.6667C32.0594 14.0933 41.506 4.66667 53.1039 4.66667C64.7018 4.66667 74.1485 14.0933 74.1485 25.6667V42H78.825V25.6667C78.825 11.5267 67.2739 0 53.1039 0C38.9339 0 27.3828 11.5267 27.3828 25.6667V42H32.0594V25.6667Z"></path><text id="cart-count" x="53" y="85.5" dy=".35em" text-anchor="middle" class="uxskpx" data-hook="items-count" aria-live="polite">{{ (int) ($cartItemCount ?? 0) }}</text></svg>
            </a>
            @guest
                <div class="hidden items-center gap-3 lg:flex">
                    <a href="{{ route('login') }}" class="desktop-nav-button manrope-font">{{ __('Login') }}</a>
                    <a href="{{ route('register') }}" class="desktop-nav-button manrope-font">{{ __('Sign Up') }}</a>
                </div>
            @endguest

            @auth
                <div class="group relative hidden lg:block">
                    <button
                        type="button"
                        class="desktop-nav-button manrope-font inline-flex items-center gap-2"
                        aria-haspopup="true"
                        aria-expanded="false"
                    >
                        {{ __('Dashboard') }}
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div class="invisible absolute right-0 top-full z-50 mt-2 w-52 rounded-md border border-white/20 bg-black/95 py-2 opacity-0 shadow-lg transition-all duration-150 group-hover:visible group-hover:opacity-100">
                        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-white hover:bg-white/10">{{ __('Dashboard') }}</a>
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-white hover:bg-white/10">{{ __('Profile Update') }}</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full px-4 py-2 text-left text-sm text-white hover:bg-white/10">
                                {{ __('Logout') }}
                            </button>
                        </form>
                    </div>
                </div>
            @endauth
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
        <nav class="main-container px-4 py-4 sm:px-6 lg:px-8 manrope-font">
            <a href="{{ route('about') }}" class="mobile-nav-link">About</a>
            <a href="{{ route('journey') }}" class="mobile-nav-link">Journey</a>
            <a href="#" class="mobile-nav-link">Stories</a>
            <a href="{{ route('artifacts.index') }}" class="mobile-nav-link">Artifacts</a>

            @guest
                <a
                    href="{{ route('login') }}"
                    class="mt-3 flex w-full items-center justify-center border border-[var(--primary-color)] px-5 py-3 text-sm font-semibold uppercase tracking-wider text-[var(--primary-color)] transition-colors hover:bg-[color-mix(in_srgb,var(--primary-color)_12%,transparent)] manrope-font"
                >{{ __('Login') }}</a>
                <a
                    href="{{ route('register') }}"
                    class="mt-3 flex w-full items-center justify-center border border-[var(--primary-color)] px-5 py-3 text-sm font-semibold uppercase tracking-wider text-[var(--primary-color)] transition-colors hover:bg-[color-mix(in_srgb,var(--primary-color)_12%,transparent)] manrope-font"
                >{{ __('Sign Up') }}</a>
            @endguest

            @auth
                <a href="{{ route('admin.dashboard') }}" class="mobile-nav-link">{{ __('Dashboard') }}</a>
                <a href="{{ route('profile.edit') }}" class="mobile-nav-link">{{ __('Profile Update') }}</a>
                <form method="POST" action="{{ route('logout') }}" class="mt-3">
                    @csrf
                    <button
                        type="submit"
                        class="flex w-full items-center justify-center border border-[var(--primary-color)] px-5 py-3 text-sm font-semibold uppercase tracking-wider text-[var(--primary-color)] transition-colors hover:bg-[color-mix(in_srgb,var(--primary-color)_12%,transparent)] manrope-font"
                    >
                        {{ __('Logout') }}
                    </button>
                </form>
            @endauth
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
