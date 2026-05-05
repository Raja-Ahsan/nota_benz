<footer class="bg-white">
    <div class="container  py-12  sm:py-14 lg:py-16">
        <div class="grid grid-cols-1 gap-10 sm:grid-cols-2 sm:gap-12 lg:grid-cols-4 lg:gap-8 xl:gap-10">
            {{-- Brand + socials --}}
            <div class="sm:col-span-2 lg:col-span-1">
                <a href="{{ url('/') }}" class="">
                    <img
                        src="{{ asset('assets/images/logo-dark.png') }}"
                        alt="NOTaBENZ"
                        class=" max-w-[180px] mb-4"
                    
                        decoding="async"
                    />
                </a>
                <p class="max-w-[250px] leading-[1.5] italic text-dim-black text-[16px] cormorant-font">
                    Not a brand. A perspective. Stories, art, and the life that shaped them — by Mercedes A. Villamín.
                </p>
                <ul class="mt-6 flex flex-wrap items-center gap-3" role="list">
                    <li>
                        <a
                            href="#"
                            class="social-icon"
                        
                        >
                            <img src="{{ asset('assets/images/instagram-icon.png') }}" alt="" class="h-3 w-3" />
                        </a>
                    </li>
                    <li>
                        <a
                            href="#"
                            class="social-icon"
                           
                        >
                            <img src="{{ asset('assets/images/facebook-icon.png') }}" alt="" class="h-2 w-2" />
                        </a>
                    </li>
                    <li>
                        <a
                            href="#"
                            class="social-icon"
                          
                        >
                            <img src="{{ asset('assets/images/tt-icon.png') }}" alt="" class="h-2 w-2" />
                        </a>
                    </li>
                    <li>
                        <a
                            href="#"
                            class="social-icon"
                        >
                            <img src="{{ asset('assets/images/youtube-icon.png') }}" alt="" class="h-3 w-3" />
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Navigate --}}
            <div>
                <h2 class="footer-title manrope-font tracking-[2.78px]">
                    Navigate
                </h2>
                <ul class="footer-ul manrope-font tracking-[2.78px]">
                    <li><a href="#" class="footer-link">Identity</a></li>
                    <li><a href="#" class="footer-link">Journey</a></li>
                    <li><a href="#" class="footer-link">Stories</a></li>
                    <li><a href="#" class="footer-link">Artifacts</a></li>
                    <li><a href="#" class="footer-link">Connect</a></li>
                </ul>
            </div>

            {{-- Create --}}
            <div>
            <h2 class="footer-title manrope-font tracking-[2.78px]">
                    Create
                </h2>
                <ul class="footer-ul manrope-font ">
                    <li><a href="#" class="footer-link">All Stories</a></li>
                    <li><a href="#" class="footer-link">Travel Blog</a></li>
                    <li><a href="#" class="footer-link">Writers Showcase</a></li>
                    <li><a href="#" class="footer-link">Carpe Diem</a></li>
                </ul>
            </div>

            {{-- Get in touch + location --}}
            <div class="sm:col-span-2 lg:col-span-1">
            <h2 class="footer-title manrope-font tracking-[2.78px]">
                    Get in touch
                </h2>
                <ul class="footer-ul manrope-font ">
                    <li>
                        <a
                            href="mailto:info@notabenz.com"
                            class="footer-link"
                        >info@notabenz.com</a>
                    </li>
                    <li><a href="#" class="footer-link manrope-font ">Amazon Store</a></li>
                    <li><a href="{{ url('/') }}" class="footer-link manrope-font">Official site</a></li>
                </ul>
                <h2 class="mt-4 footer-title manrope-font tracking-[2.78px]">
                    Location
                </h2>
                <p class="mt-2 text-[13px] leading-[1.5] text-[var(--text-color)] font-normal manrope-font tracking-[0%]">
                    Charlottesville, VA 22902 USA
                </p>
            </div>
        </div>
    </div>

    <div class="">
    <div class="max-w-5xl mx-auto h-[1px] bg-[var(--text-color)]/10 manrope-font"></div>
        <div class="container mx-auto max-w-7xl flex flex-col gap-4 px-4 py-6 sm:flex-row sm:items-center sm:justify-between sm:px-6 lg:px-8">
            <p class="text-center text-[11px] text-[var(--text-color)] sm:text-left font-normal manrope-font tracking-[0%]">
                &copy; {{ date('Y') }} NOTaBENZ — Mercedes A. Villamín. All rights reserved.
            </p>
            <nav class="flex flex-wrap items-center justify-center gap-4 sm:justify-end sm:gap-6">
                <a href="#" class="footer-bottom-link manrope-font">Privacy</a>
                <a href="#" class="footer-bottom-link manrope-font">Terms</a>
                <a href="#" class="footer-bottom-link manrope-font">Cookies</a>
            </nav>
        </div>

</footer>

