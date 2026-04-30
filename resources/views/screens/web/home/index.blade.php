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
                        <span class="text-[var(--primary-color)]">SCENE <span class="text-[var(--primary-color)] mx-2 ">I</span></span> <span class="text-white/40">— Identity Moment</span>
                    </p>
                </div>

                {{-- Headline --}}
                <h1 class=" text-[40px] font-bold uppercase leading-[1.05] tracking-tight text-white  md:text-[80px]">
                    <span class="block">MY LIFE.</span>
                    <span class="block">MY</span>
                    <span class="block text-[var(--primary-color)]">OPUS.</span>
                </h1>

                {{-- Subcopy --}}
                <div class="space-y-1 font-sans text-[16px] text-white/50  md:text-[20px]">
                    <p class="font-medium italic tracking-wide">NOTABENZ — A Story In Motion</p>
                    <p class="font-medium uppercase tracking-wide text-[var(--primary-color)]">
                        NOT A BRAND. A PERSPECTIVE.
                    </p>
                </div>

                {{-- CTAs --}}
                <div class="flex flex-col gap-4 pt-2 sm:flex-row sm:flex-wrap sm:items-center sm:gap-5">
                    <a
                        href="#"
                        class="btn btn-primary">
                        Enter the journey
                        <span aria-hidden="true">→</span>
                    </a>
                    <a
                        href="#"
                        class="btn secondary-btn">
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
        class="home-ticker overflow-hidden bg-[#28A4BA] py-3 shadow-inner sm:py-3.5"
        aria-label="{{ __('Tagline scroll') }}">
        <div class="home-ticker-track" role="presentation">
            @foreach (['a', 'b'] as $copy)
            <div
                class="flex shrink-0 items-center justify-center gap-10 whitespace-nowrap px-2  text-[18px] italic tracking-wide text-white  @if ($copy === 'b') select-none @endif"
                @if ($copy==='b' ) aria-hidden="true" @endif>
                @foreach ($tickerWords as $i => $word)
                @if ($i > 0)
                <span class="text-[var(--primary-color)]" aria-hidden="true">·</span>
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
    'kicker_line' => '— ' . __('CHAPTER I') . ' — ',
    'kicker_title' => __('The Origin'),
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
    'progress' => '• ' . __('SCENE II') . ' — ' . __('CHAPTER I of IV'),
    ],
    [
    'kicker_line' => '— ' . __('CHAPTER II') . ' — ',
    'kicker_title' => __('The Road'),
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
    'progress' => '• ' . __('SCENE II') . ' — ' . __('CHAPTER II of IV'),
    ],
    [
    'kicker_line' => '— ' . __('CHAPTER III') . ' — ',
    'kicker_title' => __('The Art'),
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
    'progress' => '• ' . __('SCENE II') . ' — ' . __('CHAPTER III of IV'),
    ],
    [
    'kicker_line' => '— ' . __('CHAPTER IV') . ' — ',
    'kicker_title' => __('The Philosophy'),
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
    'progress' => '• ' . __('SCENE 04') . ' — ' . __('CHAPTER IV of IV'),
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
                        <p class="font-sans text-[16px] font-semibold text-[var(--primary-color)]">
                            <span class="uppercase tracking-widest">{{ $slide['kicker_line'] }}</span>
                            <span class="mt-0.5 block pl-0.5  text-[16px] font-medium italic normal-case tracking-wide text-[#333333]/80 sm:mt-0 sm:ml-2 sm:inline sm:pl-0 md:text-lg">{{ $slide['kicker_title'] }}</span>
                        </p>
                        <h2 class="mt-2 max-w-[400px] font-serif text-[20px] font-bold leading-[1.2] text-[var(--text-color)] md:text-[40px]">
                            {{ $slide['line1'] }}<em class="font-serif font-semibold italic text-[#28A4BA]">{{ $slide['em'] }}</em>{{ $slide['line2'] }}
                        </h2>
                        <div class="mt-6 max-w-[400px] space-y-4 font-serif text-[16px] leading-relaxed text-[var(--text-color)]/70">
                            @foreach ($slide['body'] as $para)
                            <p>{{ $para }}</p>
                            @endforeach
                        </div>
                        <p
                            class="mt-8  text-[16px] font-medium uppercase tracking-[0.2em] text-[var(--primary-color)]"
                            data-story-step>
                            {{ $slide['progress'] }}
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
                    Every road walked is a sentence written. Every city crossed is a paragraph earned.
                </p>
                <footer class="quote-banner__attribution">— Mercedes A. Villamán</footer>
            </blockquote>
        </div>
    </section>

    {{-- Stories from the Field (styles: resources/css/app.css `.stories-field*`) --}}
    <section class="stories-field" aria-labelledby="stories-field-heading">
        <div class="container">
            <div class="stories-field__inner">
                <header class="stories-field__header">
                    <div class="stories-field__intro">
                        <p class="stories-field__kicker">
                            <span class="stories-field__kicker-scene">SCENE III</span>
                            <span class="stories-field__kicker-rest">— The Writing</span>
                        </p>
                        <h2 id="stories-field-heading" class="stories-field__title">
                            <span class="stories-field__title-line">Stories</span>
                            <span class="stories-field__title-line stories-field__title-line--accent">from the Field</span>
                        </h2>
                    </div>
                    <a href="#" class="stories-field__all-link">All stories <span aria-hidden="true">→</span></a>
                </header>

                <div class="stories-field__grid">
                    <article class="stories-field__card stories-field__card--feature">
                        <div
                            class="stories-field__card-media"
                            style="--stories-field-card-bg: url('/assets/images/slider-img-01.png')"
                            role="img"
                            aria-hidden="true"></div>
                        <div class="stories-field__card-overlay" aria-hidden="true"></div>
                        <div class="stories-field__card-body">
                            <p class="stories-field__category"><span class="stories-field__category-label">Manifesto</span></p>
                            <h3 class="stories-field__card-title">Don’t Let the Bastards Grind You Down</h3>
                            <div class="stories-field__card-meta-row">
                                <p class="stories-field__meta">Dec 30, 2025 · 2 min</p>
                                <a href="#" class="stories-field__read-link">Read <span aria-hidden="true">→</span></a>
                            </div>
                        </div>
                    </article>

                    <article class="stories-field__card stories-field__card--compact">
                        <div
                            class="stories-field__card-media"
                            style="--stories-field-card-bg: url('/assets/images/pen.png')"
                            role="img"
                            aria-hidden="true"></div>
                        <div class="stories-field__card-overlay" aria-hidden="true"></div>
                        <div class="stories-field__card-body">
                            <p class="stories-field__category"><span class="stories-field__category-label">Personal</span></p>
                            <h3 class="stories-field__card-title stories-field__card-title--sm">Letters I Never Sent</h3>
                            <div class="stories-field__card-meta-row">
                                <p class="stories-field__meta">Dec 30, 2025 · 1 min</p>
                                <a href="#" class="stories-field__read-link">Read <span aria-hidden="true">→</span></a>
                            </div>
                        </div>
                    </article>

                    <article class="stories-field__card stories-field__card--compact">
                        <div
                            class="stories-field__card-media"
                            style="--stories-field-card-bg: url('/assets/images/image-06.png')"
                            role="img"
                            aria-hidden="true"></div>
                        <div class="stories-field__card-overlay" aria-hidden="true"></div>
                        <div class="stories-field__card-body">
                            <p class="stories-field__category"><span class="stories-field__category-label">Travel</span></p>
                            <h3 class="stories-field__card-title stories-field__card-title--sm">The Camino: Walking Into Myself</h3>
                            <div class="stories-field__card-meta-row">
                                <p class="stories-field__meta">Nov 12, 2025 · 5 min</p>
                                <a href="#" class="stories-field__read-link">Read <span aria-hidden="true">→</span></a>
                            </div>
                        </div>
                    </article>
                </div>
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