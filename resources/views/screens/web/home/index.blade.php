@extends('layouts.web.master')

@section('content')
<main class="">
    {{-- Hero: video background; header (fixed) is visually on top of this section --}}
    <section class="relative isolate min-h-svh overflow-hidden" aria-label="{{ __('Hero') }}">
        {{-- Background video --}}
        <div class="pointer-events-none absolute inset-0 -z-10">
            <video
                class="absolute inset-0 h-full w-full object-cover"
                autoplay
                muted
                loop
                playsinline
                preload="auto">
                <source src="{{ asset('assets/video/hero-section-bg-video.mp4') }}" type="video/mp4" />
            </video>
            <div class="absolute inset-0 bg-gradient-to-r from-black/75 via-black/55 to-black/35" aria-hidden="true"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
        </div>

        {{-- LIVE badge (top-right of hero) --}}
        <p class="pointer-events-none border border-white/10 rounded-full px-4 py-2 absolute right-4 top-20 z-20 text-[10px] font-medium uppercase tracking-wide text-white/40 sm:right-6 sm:top-24 lg:right-8 lg:top-28">
            <span class="mr-1.5 inline-block h-2 w-2 animate-pulse rounded-full bg-emerald-400 align-middle" aria-hidden="true"></span>
            LIVE NOW <br>

        </p>
        <span class="text-white/10 text-[10px] font-semibold absolute right-5 md:top-38 z-20 top-30">Mercedes A. Villamán</span>

        <div
            class="container relative z-10 flex  min-h-svh flex-col justify-center py-20 sm:px-6 sm:py-24 md:py-28 lg:px-8 lg:py-36">
            {{-- Extra top space so copy clears the fixed header --}}
            <div class="max-w-3xl space-y-8 pt-16 sm:pt-20 lg:pt-8">
                {{-- Scene label --}}
                <div class="flex items-center gap-3">
                    <span class="h-px w-8 shrink-0 bg-[var(--primary-color)] " aria-hidden="true"></span>
                    <p class=" italic text-white text-[16px]">
                        <span class="text-secondary manrope-font tracking-[3.6px]">SCENE <span class="text-primary mx-2 ">I</span></span> <span class="text-white/60 cormorant-font tracking-[1.38px]">— Identity Moment</span>
                    </p>
                </div>

                {{-- Headline --}}
                <h1 class="banner-hd text-[40px] font-extrabold uppercase leading-[1.05] tracking-tight text-white  md:text-[80px] syne-font tracking-[4.16px]">
                    <span class="block">MY LIFE.</span>
                    <span class="block">MY</span>
                    <span class="block text-[var(--primary-color)] plarfair-font">OPUS.</span>
                </h1>

                {{-- Subcopy --}}
                <div class="space-y-1 font-sans text-[11px] text-white/50  md:text-[20px]">
                    <p class="font-medium italic tracking-wide cormorant-font tracking-[1.25px]">NOTABENZ — A Story In Motion</p>
                    <p class="font-medium uppercase text-[14px] text-primary manrope-font tracking-[3.7px]">
                        NOT A BRAND. A PERSPECTIVE.
                    </p>
                </div>

                {{-- CTAs --}}
                <div class="flex flex-col gap-4 pt-2 sm:flex-row sm:flex-wrap sm:items-center sm:gap-5">
                    <a
                        href="#"
                        class="btn btn-primary">
                        Enter the journey
                        <span class="pl-[20px] text-[15px]" aria-hidden="true">→</span>
                    </a>
                    <a
                        href="#"
                        class="btn border-btn secondary-btn">
                        Explore artifacts
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- slider section -->
    @php
    $tickerWords = [
    __('Writer'),
    __('Traveler'),
    __('Artist'),
    __('Pilgrim'),
    __('Storyteller'),
    __('Explorer'),
    __('Creator'),
    __('Dreamer'),
    __('Writer'),
    __('Traveler'),
    __('Artist'),
    __('Pilgrim'),
    __('Storyteller'),
    __('Explorer'),
    __('Creator'),
    __('Dreamer'),
    ];
    @endphp
    <section
        class="home-ticker overflow-hidden bg-secondary py-4 shadow-inner"
        aria-label="{{ __('Tagline scroll') }}">
        <div class="home-ticker-track" role="presentation">
            @foreach (['a', 'b'] as $copy)
            <div
                class="flex shrink-0 items-center justify-center gap-10 whitespace-nowrap px-2  text-[18px] italic tracking-wide text-white  @if ($copy === 'b') select-none @endif cormorant-font tracking-[0.91px]"
                @if ($copy==='b' ) aria-hidden="true" @endif>
                @foreach ($tickerWords as $i => $word)
                @if ($i > 0)
                <span class="text-[28px] leading-none text-primary" aria-hidden="true">•</span>
                @endif
                <span>{{ $word }}</span>
                @endforeach
            </div>
            @endforeach
        </div>
    </section>

    @php
    $storySlides = [
    [
    'kicker_line' => '— ' . __('CHAPTER I') ,
    'kicker_title' => ' — ' . __('The Origin'),
    'line1' => __('Born from a '),
    'em' => __('single desire'),
    'line2' => __(' — to be undeniable.'),
    'body' => [
    __('Dominican roots. World-wandering spirit. A name that
    refuses the ordinary. NOTaBENZ did not arrive as a brand
    — it arrived as a reckoning.'),
    __('Mercedes A. Villamán began writing long before she knew
    she was a writer. Between continents and contradictions, she
    found her voice — precise, poetic, and uncompromising.'),
    ],
    'progress' => __('SCENE II') . ' — ' . __('CHAPTER I of IV'),
    ],
    [
    'kicker_line' => '— ' . __('CHAPTER II') ,
    'kicker_title' => ' — ' . __('The Road'),
    'line1' => __(' 32 countries. One'),
    'em' => __(' relentless question.'),
    'line2' => __(),
    'body' => [
    __('The Camino de Santiago. The streets of Havana. A notebook
    in Lisbon. Every road walked is a sentence written — not in
    metaphor, but in method.'),
    __('Travel was never tourism. It was research. Evidence-
    gathering. A study in how different people hold the same
    desire to be fully alive.'),
    ],
    'progress' => __('SCENE II') . ' — ' . __('CHAPTER II of IV'),
    ],
    [
    'kicker_line' => '— ' . __('CHAPTER III') ,
    'kicker_title' => ' — ' . __('The Art'),
    'line1' => __('Street art.
    Conceptual work. '),
    'em' => __('Language as canvas.'),
    'line2' => __(''),
    'body' => [
    __('Not all art lives in galleries. Some lives on walls, in margins,
    in the gap between what is said and what is meant. This is
    the territory NOTaBENZ claims.'),
    __('From urban murals to written essays, the creative philosophy
    is constant: '),
    ],
    'progress' => __('SCENE II') . ' — ' . __('CHAPTER III of IV'),
    ],
    [
        'kicker_line' => '— ' . __('CHAPTER IV') ,
    'kicker_title' => ' — ' . __('The Philosophy'),
    'line1' => __('Identity is not'),
    'em' => __(' given'),
    'line2' => __('. It is built —
    word by deliberate word.'),
    'body' => [
    __('The name says it all. NOTaBENZ is a refusal. A declaration.
    A signal that your worth was never determined by what you
    drove, wore, or inherited.'),
    __('This is the world we are building, one story at a time. You
    are either in it, or you are still deciding. Both are fine. The
    door is always open.'),
    ],
    'progress' => __('SCENE 04') . ' — ' . __('CHAPTER IV of IV'),
    ],
    ];
    @endphp
    <section
        id="scroll-story"
        class="scroll-story relative h-[400svh] bg-white"
        aria-label="{{ __('Story gallery') }}"
        data-story-count="4">
        <div
            class="scroll-story__sticky sticky top-0 z-0 flex min-h-svh w-full flex-col overflow-hidden">
            {{-- Full-viewport image stack (background) --}}
            <div class="pointer-events-none absolute inset-0 z-0" aria-hidden="true">
                <div class="absolute inset-0 overflow-hidden">
                    <div
                        data-story-img
                        data-index="0"
                        role="img"
                        aria-label="{{ __('Story image') }} 1"
                        class="absolute inset-0 bg-cover bg-center bg-no-repeat transition-[opacity,transform] duration-700 ease-out motion-reduce:transition-none"
                        style="background-image: url('{{ asset('assets/images/slider-img-01.png') }}'); will-change: opacity; opacity: 1;"></div>
                    <div
                        data-story-img
                        data-index="1"
                        role="img"
                        aria-label="{{ __('Story image') }} 2"
                        class="absolute inset-0 bg-cover bg-center bg-no-repeat transition-[opacity,transform] duration-700 ease-out motion-reduce:transition-none"
                        style="background-image: url('{{ asset('assets/images/slider-img-02.png') }}'); will-change: opacity; opacity: 0;"></div>
                    <div
                        data-story-img
                        data-index="2"
                        role="img"
                        aria-label="{{ __('Story image') }} 3"
                        class="absolute inset-0 bg-cover bg-center bg-no-repeat transition-[opacity,transform] duration-700 ease-out motion-reduce:transition-none"
                        style="background-image: url('{{ asset('assets/images/slider-img-03.png') }}'); will-change: opacity; opacity: 0;"></div>
                    <div
                        data-story-img
                        data-index="3"
                        role="img"
                        aria-label="{{ __('Story image') }} 4"
                        class="absolute inset-0 bg-cover bg-center bg-no-repeat transition-[opacity,transform] duration-700 ease-out motion-reduce:transition-none"
                        style="background-image: url('{{ asset('assets/images/slider-img-04.png') }}'); will-change: opacity; opacity: 0;"></div>
                </div>
            </div>

            {{-- Readability: white fade on the left; stronger on small screens (text below) --}}


            {{-- Left: copy (editorial) over background --}}
            <div
                class="relative z-20 flex w-full max-w-2xl flex-1 flex-col self-start pl-4 pr-5 pt-20 sm:pl-6 sm:pr-8 sm:pt-24 md:max-w-[min(100%,32rem)] lg:min-h-svh lg:max-w-[min(100%,40rem)] lg:justify-center lg:pl-8 lg:pt-20 xl:max-w-[40rem] xl:pl-14 2xl:pl-20">
                <div class="relative min-h-[50svh] w-full sm:min-h-[58svh] lg:min-h-svh">
                    @foreach ($storySlides as $index => $slide)
                    <div
                        class="scroll-story__panel @if ($index > 0) pointer-events-none opacity-0 @else pointer-events-auto opacity-100 @endif absolute inset-0 flex flex-col justify-center overflow-y-auto transition-opacity duration-700 ease-out"
                        data-story-panel
                        data-index="{{ $index }}"
                        @if ($index> 0) inert @endif
                        @if ($index > 0) aria-hidden="true" @endif
                        >
                        <p class=" manrope-font text-[16px] font-bold text-secondary">
                            <span class="uppercase tracking-widest">{{ $slide['kicker_line'] }}</span>
                            <span class="cormorant-font mt-0.5 block pl-0.5  text-[16px]  italic normal-case tracking-wide text-[#333333] font-normal sm:mt-0 sm:ml-2 sm:inline sm:pl-0 md:text-lg">{{ $slide['kicker_title'] }}</span>
                        </p>
                        <h2 class="mt-2 max-w-[400px]  text-[20px] font-bold leading-[1.2] text-[var(--text-color)] md:text-[40px] plarfair-font">
                            {{ $slide['line1'] }}<em class=" font-normal italic text-secondary">{{ $slide['em'] }}</em>{{ $slide['line2'] }}
                        </h2>
                        <div class="mt-6 max-w-[400px] space-y-4 font-normal text-[16px] leading-[35.52pz] text-[var(--text-color)]/ cormorant-font tracking-[0%]">
                            @foreach ($slide['body'] as $para)
                            <p>{{ $para }}</p>
                            @endforeach
                        </div>
                        <p
                            class="mt-8 flex flex-wrap items-center gap-x-2 text-[16px] font-medium uppercase text-secondary manrope-font tracking-[2.4px]"
                            data-story-step>
                            <span class="shrink-0 text-[28px] leading-none text-primary" aria-hidden="true">•</span>
                            <span>{{ $slide['progress'] }}</span>
                        </p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Editorial quote banner (styles: resources/css/app.css `.quote-banner*`) --}}
    <section class="quote-banner" aria-label="Featured quote">
        <div class="quote-banner__inner">
            <blockquote class="quote-banner__quote">
                <p class="quote-banner__text">
                    "Every road walked is a sentence written. Every city crossed is a paragraph earned."
                </p>
                <footer class="quote-banner__attribution tracking-[2.98px]">— Mercedes A. Villamán</footer>
            </blockquote>
        </div>
    </section>

    {{-- Stories from the Field (styles: resources/css/app.css `.stories-field*`) --}}
    <section class="stories-field" aria-labelledby="stories-field-heading">
        <div class="container">
            <div class="stories-field__inner">
                <div class="stories-field__header">
                    <div class="stories-field__intro">
                        <p class="sec-hd-light">
                            <span class="primary-span">SCENE III</span>
                            <span class="secondary-span">The Writing</span>
                        </p>
                        <h2 id="stories-field-heading" class="stories-field__title">
                            <span class="stories-field__title-line">Stories from</span>
                            <span class="stories-field__title-line stories-field__title-line--accent  "> the Field</span>
                        </h2>
                    </div>
                    <a href="#" class="stories-field__all-link">All stories <span aria-hidden="true">→</span></a>
                </div>

                <div class="stories-field__grid">
                    <div class="stories-field__card stories-field__card--feature">
                        <div
                            class="stories-field__card-media"
                            style="--stories-field-card-bg: url('{{ asset('assets/images/stories-img-01.png') }}')"
                            role="img"
                            aria-hidden="true"></div>
                        <div class="stories-field__card-overlay" aria-hidden="true"></div>
                        <div class="stories-field__card-body">
                            <p class="text-primary font-manrope tracking-[2.4px] uppercase font-bold"><span class="stories-field__category-label flex items-center gap-2">Manifesto</span></p>
                            <h3 class="stories-field__card-title">Don’t Let the Bastards Grind You Down</h3>
                            <div class="stories-field__card-meta-row">
                                <p class="stories-field__meta">Dec 30, 2025 · 2 min</p>
                                <a href="#" class="text-primary manrope-font tracking-[2.4px] uppercase font-bold">Read <span aria-hidden="true">→</span></a>
                            </div>
                        </div>
                    </div>

                    <div class="stories-field__card stories-field__card--compact">
                        <div
                            class="stories-field__card-media"
                            style="--stories-field-card-bg: url('{{ asset('assets/images/stories-img-02.png') }}')"
                            role="img"
                            aria-hidden="true"></div>
                        <div class="stories-field__card-overlay" aria-hidden="true"></div>
                        <div class="stories-field__card-body">
                            <p class="text-primary font-manrope tracking-[2.4px] uppercase font-bold"><span class="stories-field__category-label">Personal</span></p>
                            <h3 class="stories-field__card-title stories-field__card-title--sm">Letters I Never Sent</h3>
                            <div class="stories-field__card-meta-row">
                                <p class="stories-field__meta">Dec 30, 2025 · 1 min</p>
                                <a href="#" class="text-primary manrope-font tracking-[2.4px] uppercase font-bold">Read <span aria-hidden="true">→</span></a>
                            </div>
                        </div>
                    </div>

                    <div class="stories-field__card stories-field__card--compact">
                        <div
                            class="stories-field__card-media"
                            style="--stories-field-card-bg: url('{{ asset('assets/images/stories-img-03.png') }}')"
                            role="img"
                            aria-hidden="true"></div>
                        <div class="stories-field__card-overlay" aria-hidden="true"></div>
                        <div class="stories-field__card-body">
                            <p class="text-primary font-manrope tracking-[2.4px] uppercase font-bold"><span class="stories-field__category-label">Travel</span></p>
                            <h3 class="stories-field__card-title stories-field__card-title--sm">The Camino: Walking Into Myself</h3>
                            <div class="stories-field__card-meta-row">
                                <p class="stories-field__meta">Nov 12, 2025 · 5 min</p>
                                <a href="#" class="text-primary manrope-font tracking-[2.4px] uppercase font-bold">Read <span aria-hidden="true">→</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- SCENE IV — Identity Artifacts (styles: resources/css/app.css `.identity-artifacts*`) --}}
    <section class="identity-artifacts" aria-labelledby="identity-artifacts-heading">
        <div class="container">
            <header class="identity-artifacts__header">
                <div class="identity-artifacts__intro">
                    <p class="identity-artifacts__kicker">
                        <span class="identity-artifacts__kicker-line" aria-hidden="true"></span>
                        <span class="identity-artifacts__kicker-scene manrope-font">SCENE IV</span>
                        <span class="identity-artifacts__kicker-rest cormorant-font">— Identity Artifacts</span>
                    </p>
                    <h2 id="identity-artifacts-heading" class="identity-artifacts__title plarfair-font">
                        <span class="identity-artifacts__title-line">Not a store.</span>
                        <span class="identity-artifacts__title-line identity-artifacts__title-line--accent">A Gallery.</span>
                    </h2>
                    <p class="identity-artifacts__sub cormorant-font">
                        Each piece is a story fragment. A personal artifact. A signal.
                    </p>
                </div>
                <a href="#" class="identity-artifacts__browse manrope-font">
                    Browse all <span class="identity-artifacts__browse-chevron" aria-hidden="true">&gt;</span>
                </a>
            </header>

            <div class="identity-artifacts__grid" role="list">
                <article class="identity-artifacts__card identity-artifacts__card--1" role="listitem">
                    <div class="identity-artifacts__media">
                        <span class="identity-artifacts__badge manrope-font">New</span>
                        <img
                            class="identity-artifacts__img"
                            src="{{ asset('assets/images/stories-img-01.png') }}"
                            width="480"
                            height="640"
                            alt="">
                    </div>
                    <div class="identity-artifacts__body">
                        <p class="identity-artifacts__category manrope-font">Book</p>
                        <h3 class="identity-artifacts__name plarfair-font">My Opus — Vol. I</h3>
                        <p class="identity-artifacts__price manrope-font"><span class="identity-artifacts__price-current">$34.99</span></p>
                    </div>
                </article>

                <article class="identity-artifacts__card identity-artifacts__card--2" role="listitem">
                    <div class="identity-artifacts__media">
                        <span class="identity-artifacts__badge identity-artifacts__badge--long manrope-font">Bestseller</span>
                        <img
                            class="identity-artifacts__img"
                            src="{{ asset('assets/images/stories-img-02.png') }}"
                            width="480"
                            height="640"
                            alt="">
                    </div>
                    <div class="identity-artifacts__body">
                        <p class="identity-artifacts__category manrope-font">Home</p>
                        <h3 class="identity-artifacts__name plarfair-font">Glass Jar Soy Candle</h3>
                        <p class="identity-artifacts__price manrope-font">
                            <span class="identity-artifacts__price-was">$28.00</span>
                            <span class="identity-artifacts__price-current">$22.00</span>
                        </p>
                    </div>
                </article>

                <article class="identity-artifacts__card identity-artifacts__card--3" role="listitem">
                    <div class="identity-artifacts__media">
                        <img
                            class="identity-artifacts__img"
                            src="{{ asset('assets/images/stories-img-03.png') }}"
                            width="480"
                            height="720"
                            alt="">
                    </div>
                    <div class="identity-artifacts__body">
                        <p class="identity-artifacts__category manrope-font">Apparel</p>
                        <h3 class="identity-artifacts__name plarfair-font">Cropped Windbreaker</h3>
                        <p class="identity-artifacts__price manrope-font"><span class="identity-artifacts__price-current">$68.00</span></p>
                    </div>
                </article>

                <article class="identity-artifacts__card identity-artifacts__card--4" role="listitem">
                    <div class="identity-artifacts__media">
                        <span class="identity-artifacts__badge manrope-font">Limited</span>
                        <img
                            class="identity-artifacts__img"
                            src="{{ asset('assets/images/slider-img-03.png') }}"
                            width="480"
                            height="640"
                            alt="">
                    </div>
                    <div class="identity-artifacts__body">
                        <p class="identity-artifacts__category manrope-font">Art print</p>
                        <h3 class="identity-artifacts__name plarfair-font">Urban Series — No. 7</h3>
                        <p class="identity-artifacts__price manrope-font"><span class="identity-artifacts__price-current">$45.00</span></p>
                    </div>
                </article>
            </div>
        </div>
    </section>

    @php
        $instaTopImages = [
            'assets/images/slider-img-01.png',
            'assets/images/slider-img-02.png',
            'assets/images/slider-images/01.png',
            'assets/images/slider-images/02.png',
            'assets/images/slider-images/03.png',
            'assets/images/slider-images/04.png',
            'assets/images/slider-images/05.png',
            'assets/images/slider-images/06.png',
            'assets/images/stories-img-01.png',
            'assets/images/image-02.png',
            'assets/images/image-03.png',
            'assets/images/image-04.png',
        ];
        $instaBottomImages = [
            'assets/images/slider-images/07.png',
            'assets/images/slider-images/08.png',
            'assets/images/slider-images/09.png',
            'assets/images/slider-images/10.png',
            'assets/images/slider-images/11.png',
            'assets/images/slider-img-03.png',
            'assets/images/slider-img-04.png',
            'assets/images/stories-img-02.png',
            'assets/images/stories-img-03.png',
            'assets/images/pen.png',
            'assets/images/image-05.png',
            'assets/images/image-06.png',
            'assets/images/image-07.png',
            'assets/images/image-08.png',
        ];
    @endphp

    {{-- Instagram gallery marquee (Slick; styles: `.insta-gallery*`) --}}
    <section class="insta-gallery overflow-hidden" aria-label="{{ __('Instagram gallery') }}">
        <div class="container insta-gallery__heading-wrap">
            <a
                href="https://www.instagram.com/villamanmercedes/"
                class="insta-gallery__handle manrope-font"
                target="_blank"
                rel="noopener noreferrer">
                <span class="insta-gallery__handle-icon" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="18" height="18" rx="5" ry="5" />
                        <circle cx="12" cy="12" r="4" />
                        <circle cx="17.5" cy="6.5" r="1.2" fill="currentColor" stroke="none" />
                    </svg>
                </span>
                <span class="insta-gallery__handle-text">@villamanmercedes</span>
            </a>
        </div>

        <div class="insta-gallery__rail insta-gallery__rail--top">
            <div class="insta-gallery__axis insta-gallery__axis--flip">
                <div class="insta-gallery__slider js-insta-slider-top">
                    @foreach ($instaTopImages as $src)
                        <div class="insta-gallery__slide">
                            <div class="insta-gallery__slide-inner">
                                <img class="insta-gallery__thumb" src="{{ asset($src) }}" width="160" height="160" loading="lazy" alt="">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="insta-gallery__rail insta-gallery__rail--bottom">
            <div class="insta-gallery__slider js-insta-slider-bottom">
                @foreach ($instaBottomImages as $src)
                    <div class="insta-gallery__slide">
                        <div class="insta-gallery__slide-inner">
                            <img class="insta-gallery__thumb" src="{{ asset($src) }}" width="160" height="160" loading="lazy" alt="">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</main>

<script>
    (function() {
        const root = document.getElementById('scroll-story');
        if (!root) return;
        const count = Math.max(1, parseInt(root.getAttribute('data-story-count') || '4', 10));
        const panels = root.querySelectorAll('[data-story-panel]');
        const bgLayers = root.querySelectorAll('[data-story-img]');

        function yOffset(el) {
            return el.getBoundingClientRect().top + window.scrollY;
        }

        function onScroll() {
            const start = yOffset(root);
            const h = root.offsetHeight;
            const hWin = window.innerHeight;
            const maxScroll = Math.max(1, h - hWin);
            const y = window.scrollY;
            const p = Math.max(0, Math.min(1, (y - start) / maxScroll));
            let i = Math.min(
                count - 1,
                Math.floor(p * count + 1e-6)
            );
            if (p >= 0.999) {
                i = count - 1;
            }

            panels.forEach((panel, j) => {
                const on = j === i;
                panel.classList.toggle('pointer-events-none', !on);
                panel.classList.toggle('opacity-0', !on);
                panel.classList.toggle('opacity-100', on);
                if (on) {
                    panel.removeAttribute('inert');
                    panel.removeAttribute('aria-hidden');
                } else {
                    panel.setAttribute('inert', '');
                    panel.setAttribute('aria-hidden', 'true');
                }
            });

            bgLayers.forEach((layer, j) => {
                const on = j === i;
                layer.style.opacity = on ? '1' : '0';
                layer.style.zIndex = on ? '2' : '0';
            });
        }

        window.addEventListener('scroll', onScroll, {
            passive: true
        });
        window.addEventListener('resize', onScroll, {
            passive: true
        });
        window.addEventListener('load', onScroll);
        onScroll();
    })();
</script>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
@endpush

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>
        (function() {
            if (typeof jQuery === 'undefined' || !jQuery.fn.slick) {
                return;
            }
            var $ = jQuery;
            var reduceMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

            function instaMarqueeOptions() {
                return {
                    infinite: true,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    variableWidth: true,
                    arrows: false,
                    dots: false,
                    autoplay: !reduceMotion,
                    autoplaySpeed: 1,
                    speed: 26000,
                    cssEase: 'linear',
                    pauseOnHover: false,
                    pauseOnFocus: false,
                    waitForAnimate: false,
                    swipe: false,
                    touchMove: false,
                    accessibility: false,
                    draggable: false,
                };
            }

            $(function() {
                var $top = $('.js-insta-slider-top');
                var $bottom = $('.js-insta-slider-bottom');
                if ($top.length) {
                    $top.slick(instaMarqueeOptions());
                }
                if ($bottom.length) {
                    $bottom.slick(instaMarqueeOptions());
                }
            });
        })();
    </script>
@endpush