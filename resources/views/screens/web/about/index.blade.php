@extends('layouts.web.master')

@section('title', __('About') . ' — NOTaBENZ')

@push('body-class')
inner-site
@endpush

@section('content')
<main id="about-main">
    {{-- Hero --}}
    <section class="relative isolate min-h-[58svh] overflow-hidden sm:min-h-[64svh] lg:min-h-[70svh]" aria-label="{{ __('About hero') }}">
        <div class="pointer-events-none absolute inset-0 -z-10">
            <div
                class="absolute inset-0 h-full w-full bg-cover bg-center bg-no-repeat"
                style="background-image: url('{{ asset('assets/images/slider-img-02.png') }}');"
                role="presentation"
            ></div>
            <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/60 to-black/40" aria-hidden="true"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-transparent to-black/40"></div>
        </div>

        <div class="container relative z-10 flex min-h-[58svh] flex-col justify-center py-20 sm:min-h-[64svh] sm:px-6 sm:py-24 md:py-28 lg:min-h-[70svh] lg:px-8 lg:py-36">
            <div class="max-w-4xl space-y-8 pt-16 sm:pt-20 lg:pt-8">
                <p class="manrope-font text-[10px] font-semibold uppercase tracking-[0.28em] text-white/50">
                    <a href="{{ route('home') }}" class="text-white/60 transition-colors hover:text-primary-color">Home</a>
                    <span class="mx-2 text-white/30" aria-hidden="true">/</span>
                    <span class="text-white/90">About</span>
                </p>

                <div class="flex items-center gap-3">
                    <span class="h-px w-8 shrink-0 bg-primary-color" aria-hidden="true"></span>
                    <p class="text-[15px] italic text-white sm:text-[16px]">
                        <span class="text-secondary manrope-font tracking-[3.6px]">NOTaBENZ</span>
                        <span class="text-primary mx-2 manrope-font" aria-hidden="true">·</span>
                        <span class="text-white/65 cormorant-font tracking-[1.02px]">Studio & story</span>
                    </p>
                </div>

                <h1 class="syne-font text-[38px] font-extrabold uppercase leading-[1.02] tracking-tight text-white sm:text-[52px] md:text-[68px] md:tracking-[3px] lg:text-[76px]">
                    <span class="block">Where words</span>
                    <span class="block">meet <span class="text-primary-color plarfair-font normal-case italic tracking-normal md:tracking-normal">wonder</span><span class="text-white">.</span></span>
                </h1>

                <div class="max-w-2xl space-y-2 font-sans text-[13px] text-white/60 sm:text-lg">
                    <p class="font-medium leading-relaxed cormorant-font text-[17px] text-white/80 sm:text-[20px] sm:tracking-[0.03em]">
                        The creative imprint of Mercedes A. Villamán — writing, travel, and visual work in one continuous voice.
                    </p>
                    <p class="manrope-font text-[11px] font-bold uppercase tracking-[0.35em] text-primary sm:text-xs">
                        Purpose-led narrative · Field-tested craft · Editorial calm
                    </p>
                </div>

                <div class="flex flex-col gap-4 pt-2 sm:flex-row sm:flex-wrap sm:items-center sm:gap-5">
                    <a href="#about-story" class="btn btn-primary">
                        Read our story
                        <span class="pl-[20px] text-[15px]" aria-hidden="true">↓</span>
                    </a>
                    <a href="mailto:info@notabenz.com" class="btn secondary-btn border-btn">Work with us</a>
                </div>
            </div>
        </div>
    </section>

    @php
        $tickerWords = [
            __('Authenticity'),
            __('Curiosity'),
            __('Craft'),
            __('Motion'),
            __('Memory'),
            __('Borderlands'),
            __('Voice'),
            __('Stillness'),
            __('Authenticity'),
            __('Curiosity'),
            __('Craft'),
            __('Motion'),
            __('Memory'),
            __('Borderlands'),
            __('Voice'),
            __('Stillness'),
        ];
    @endphp
    <section class="home-ticker overflow-hidden bg-secondary py-4 shadow-inner" aria-label="{{ __('Values scroll') }}">
        <div class="home-ticker-track" role="presentation">
            @foreach (['a', 'b'] as $copy)
                <div
                    class="flex shrink-0 items-center justify-center gap-10 whitespace-nowrap px-2 text-[17px] italic tracking-wide text-white @if ($copy === 'b') select-none @endif cormorant-font tracking-[0.91px] sm:text-[18px]"
                    @if ($copy === 'b') aria-hidden="true" @endif>
                    @foreach ($tickerWords as $i => $word)
                        @if ($i > 0)
                            <span class="text-[26px] leading-none text-primary sm:text-[28px]" aria-hidden="true">•</span>
                        @endif
                        <span>{{ $word }}</span>
                    @endforeach
                </div>
            @endforeach
        </div>
    </section>

    {{-- At a glance --}}
    <section class="border-b border-[color-mix(in_srgb,var(--text-color)_10%,transparent)] bg-white py-12 sm:py-14" aria-labelledby="about-glance-heading">
        <div class="container">
            <div class="mx-auto max-w-2xl text-center">
                <h2 id="about-glance-heading" class="syne-font text-xs font-extrabold uppercase tracking-[0.35em] text-secondary">
                    At a glance
                </h2>
                <p class="mt-3 text-lg leading-snug text-dim-black sm:text-xl md:text-2xl plarfair-font">
                    A single perspective across
                    <em class="text-secondary not-italic">language, journey, and image</em>
                    — built for readers who stay.
                </p>
            </div>
            <ul class="mt-12 grid gap-6 sm:grid-cols-3">
                <li class="rounded-2xl border border-dim-black/10 bg-secondary/5 px-6 py-8 text-center transition-shadow hover:shadow-lg hover:shadow-secondary/25">
                    <p class="syne-font text-3xl font-extrabold tabular-nums text-dim-black sm:text-4xl">01</p>
                    <p class="mt-2 manrope-font text-[11px] font-bold uppercase tracking-[0.2em] text-secondary">Discipline</p>
                    <p class="mt-3 text-sm leading-relaxed text-dim-black/85 cormorant-font sm:text-base">Long-form writing and editorial essays grounded in lived experience.</p>
                </li>
                <li class="rounded-2xl border border-dim-black/10 bg-secondary/5 px-6 py-8 text-center transition-shadow hover:shadow-lg hover:shadow-secondary/25">
                        <p class="syne-font text-3xl font-extrabold tabular-nums text-dim-black sm:text-4xl">02</p>
                    <p class="mt-2 manrope-font text-[11px] font-bold uppercase tracking-[0.2em] text-secondary">Field</p>
                    <p class="mt-3 text-sm leading-relaxed text-dim-black/85 cormorant-font sm:text-base">Travel captured as inquiry — notebooks, sketches, photographs, and place-memory.</p>
                </li>
                <li class="rounded-2xl border border-dim-black/10 bg-secondary/5 px-6 py-8 text-center transition-shadow hover:shadow-lg hover:shadow-secondary/25">
                    <p class="syne-font text-3xl font-extrabold tabular-nums text-dim-black sm:text-4xl">03</p>
                    <p class="mt-2 manrope-font text-[11px] font-bold uppercase tracking-[0.2em] text-secondary">Form</p>
                    <p class="mt-3 text-sm leading-relaxed text-dim-black/85 cormorant-font sm:text-base">Visual rhythm and tactile media — artifacts that extend the narrative off the page.</p>
                </li>
            </ul>
        </div>
    </section>

    {{-- Mission & vision --}}
    <section class="bg-[color-mix(in_srgb,var(--secondary-color)_6%,white)] py-14 sm:py-16 md:py-20 lg:py-28" aria-labelledby="about-mission-heading">
        <div class="container">
            <div class="mx-auto mb-12 max-w-2xl md:mb-16 md:text-center">
                <p class="flex flex-wrap items-center gap-3 md:justify-center">
                    <span class="hidden h-px w-10 bg-primary sm:inline-block md:hidden" aria-hidden="true"></span>
                    <span class="manrope-font text-[11px] font-bold uppercase tracking-[0.35em] text-secondary">Direction</span>
                </p>
                <h2 id="about-mission-heading" class="mt-3 syne-font text-2xl font-extrabold uppercase leading-tight tracking-tight text-dim-black sm:text-3xl md:text-4xl">
                    Mission & vision    
                </h2>
                <p class="mt-4 text-base leading-relaxed text-dim-black/80 cormorant-font sm:text-lg">
                    Clear intent keeps the work honest — for collaborators, readers, and every new border crossed.
                </p>
            </div>
            <div class="grid gap-8 lg:grid-cols-2 lg:gap-10">
                <article class="relative overflow-hidden rounded-2xl border border-dim-black/12 bg-white p-8 shadow-sm sm:p-10 lg:p-12">
                    <div class="absolute right-0 top-0 h-32 w-32 translate-x-1/3 -translate-y-1/3 rounded-full bg-primary/15 blur-3xl" aria-hidden="true"></div>
                    <p class="manrope-font text-[10px] font-bold uppercase tracking-[0.3em] text-primary">Mission</p>
                    <h3 class="mt-4 syne-font text-xl font-extrabold uppercase tracking-tight text-dim-black sm:text-2xl">
                        Connect through honest language
                    </h3>
                    <p class="mt-4 text-base leading-[1.75] text-dim-black/88 cormorant-font sm:text-[17px]">
                        NOTaBENZ exists to bring readers into contact with place, feeling, and precision — where travel is treated as research, not tourism, and art carries the same urgency as the sentence.
                    </p>
                </article>
                <article class="relative overflow-hidden rounded-2xl border border-dim-black/12 bg-white p-8 shadow-sm sm:p-10 lg:p-12">
                    <div class="absolute left-0 bottom-0 h-36 w-36 -translate-x-1/3 translate-y-1/3 rounded-full bg-secondary/20 blur-3xl" aria-hidden="true"></div>
                    <p class="manrope-font text-[10px] font-bold uppercase tracking-[0.3em] text-primary">Vision</p>
                    <h3 class="mt-4 syne-font text-xl font-extrabold uppercase tracking-tight text-dim-black sm:text-2xl">
                        Stories that carry weight
                    </h3>
                    <p class="mt-4 text-base leading-[1.75] text-dim-black/88 cormorant-font sm:text-[17px]">
                        A future where personal narrative holds the same gravity as the headline — where identity is explored with courage, slowness, and craft, and audiences expect depth as the default.
                    </p>
                </article>
            </div>
        </div>
    </section>

    {{-- Story + image --}}
    <section id="about-story" class="scroll-mt-24 bg-white py-14 sm:py-16 md:py-20 lg:py-28" aria-labelledby="about-story-heading">
        <div class="container">
            <div class="grid items-center gap-12 lg:grid-cols-2 lg:gap-16">
                <div class="relative order-2 lg:order-1">
                    <div class="aspect-[4/5] overflow-hidden rounded-2xl border border-dim-black/10 shadow-xl shadow-black/10 sm:aspect-[3/4]">
                        <img
                            src="{{ asset('assets/images/stories-img-01.png') }}"
                            alt="{{ __('Portrait and creative work collage for NOTaBENZ story section') }}"
                            class="h-full w-full object-cover"
                            width="800"
                            height="1000"
                            loading="lazy"
                            decoding="async"
                        />
                    </div>
                        <div class="absolute -bottom-4 -right-2 max-w-[220px] rounded-xl border border-white/20 bg-dim-black px-5 py-4 text-white shadow-lg sm:-bottom-6 sm:-right-4 sm:max-w-[260px] sm:px-6 sm:py-5">
                        <p class="manrope-font text-[9px] font-bold uppercase tracking-[0.28em] text-primary">Founder</p>
                        <p class="mt-1 syne-font text-base font-extrabold uppercase leading-tight sm:text-lg">Mercedes A. Villamán</p>
                        <p class="mt-2 text-xs leading-relaxed text-white/75 cormorant-font sm:text-sm">Writer · Traveler · Artist</p>
                    </div>
                </div>
                <div class="order-1 space-y-6 lg:order-2">
                    <p class="manrope-font text-[11px] font-bold uppercase tracking-[0.28em] text-secondary">
                        <span class="inline-flex items-center gap-2">
                            <span class="h-px w-8 bg-primary" aria-hidden="true"></span>
                            Our story
                        </span>
                    </p>
                    <h2 id="about-story-heading" class="text-3xl font-bold leading-[1.12] text-dim-black sm:text-4xl md:text-[2.75rem] plarfair-font">
                        Dominican roots.
                        <em class="block font-normal italic text-secondary sm:mt-1">A world-wandering creative practice.</em>
                    </h2>
                    <div class="space-y-4 text-base leading-[1.8] text-dim-black/90 cormorant-font sm:text-[17px]">
                        <p>NOTaBENZ is not a billboard — it is a record. It began as a need to weave language, geography, and image into something readers could feel beneath the skin.</p>
                        <p>Informed by Dominican heritage and sharpened across continents, the work treats every journey as material: overheard rhythms, imperfect light, the moral weight of being a guest in someone else\'s story.</p>
                        <p>Whether the output is prose, dispatch, exhibit, or letter, the mandate stays the same: respect the reader, honour the subject, leave ego at the crossing.</p>
                    </div>
                    <div class="flex flex-wrap gap-4 pt-2">
                        <a href="{{ route('home') }}#scroll-story" class="btn btn-primary text-[10px] sm:text-[11px]">
                            See the scroll story
                            <span class="pl-4 text-[14px]" aria-hidden="true">→</span>
                        </a>
                        <a
                            href="mailto:info@notabenz.com"
                            class="btn secondary-btn !text-dim-black border-btn"
                        >
                            Interview & press
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Values --}}
    <section class="border-y border-[color-mix(in_srgb,var(--text-color)_10%,transparent)] bg-[color-mix(in_srgb,var(--secondary-color)_6%,white)] py-14 sm:py-16 md:py-20" aria-labelledby="about-values-heading">
        <div class="container">
            <div class="mb-12 max-w-xl md:mb-14">
                <h2 id="about-values-heading" class="syne-font text-xs font-extrabold uppercase tracking-[0.35em] text-secondary">What we protect</h2>
                <p class="mt-3 text-2xl font-bold leading-tight text-dim-black sm:text-3xl plarfair-font">
                    Values that steer every publication and partnership
                </p>
            </div>
            <ul class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ([
                    ['title' => __('Truth over noise'), 'body' => __('Clarity wins. We cut vanity metrics and write for readers who finish the page.')],
                    ['title' => __('Place as character'), 'body' => __('Geography is never wallpaper — cities, coasts, and crossings shape the plot.')],
                    ['title' => __('Art as language'), 'body' => __('Image, colour, and material extend the essay when words need air.')],
                    ['title' => __('Reader respect'), 'body' => __('No bait, no empty urgency. If it ships, it deserves your time.')],
                ] as $value)
                    <li class="flex flex-col rounded-2xl border border-dim-black/10 bg-white p-6 transition-transform hover:-translate-y-0.5 hover:shadow-md sm:p-7">
                        <span class="syne-font text-2xl font-extrabold text-primary/90" aria-hidden="true">—</span>
                        <h3 class="mt-3 syne-font text-sm font-extrabold uppercase tracking-tight text-dim-black sm:text-base">
                            {{ $value['title'] }}
                        </h3>
                        <p class="mt-3 flex-1 text-sm leading-relaxed text-dim-black/82 cormorant-font sm:text-[15px]">
                            {{ $value['body'] }}
                        </p>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    {{-- Creative pillars --}}
    <section class="bg-white py-14 sm:py-16 md:py-20 lg:py-28" aria-labelledby="about-pillars-heading">
        <div class="container">
            <div class="mx-auto max-w-3xl text-center">
                <h2 id="about-pillars-heading" class="syne-font text-xs font-extrabold uppercase tracking-[0.35em] text-secondary">How the work shows up</h2>
                <p class="mt-4 text-3xl font-bold leading-tight text-dim-black sm:text-4xl plarfair-font">
                    Three doors into the same house
                </p>
                <p class="mt-4 text-base text-dim-black/78 cormorant-font sm:text-lg">
                    Each pillar feeds the others — none are silos. Pick an entry; the voice stays consistent.
                </p>
            </div>
            <div class="mt-14 grid gap-8 md:grid-cols-3">
                <article class="group flex flex-col overflow-hidden rounded-2xl border border-dim-black/10 bg-secondary/4 transition-shadow hover:shadow-xl">
                    <div class="aspect-[16/11] overflow-hidden">
                        <img src="{{ asset('assets/images/stories-img-02.png') }}" alt="{{ __('Writing and editorial pillar') }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-[1.03]" loading="lazy" decoding="async" />
                    </div>
                    <div class="flex flex-1 flex-col p-6 sm:p-7">
                        <p class="manrope-font text-[10px] font-bold uppercase tracking-[0.3em] text-primary">Pillar I</p>
                        <h3 class="mt-2 syne-font text-lg font-extrabold uppercase text-dim-black">Writing & essays</h3>
                        <p class="mt-3 flex-1 text-sm leading-relaxed text-dim-black/85 cormorant-font sm:text-[15px]">
                            Long-form narrative, letters, and editorial pieces that favour texture, research, and moral clarity.
                        </p>
                    </div>
                </article>
                <article class="group flex flex-col overflow-hidden rounded-2xl border border-dim-black/10 bg-secondary/4 transition-shadow hover:shadow-xl">
                    <div class="aspect-[16/11] overflow-hidden">
                        <img src="{{ asset('assets/images/slider-img-03.png') }}" alt="{{ __('Travel dispatches pillar') }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-[1.03]" loading="lazy" decoding="async" />
                    </div>
                    <div class="flex flex-1 flex-col p-6 sm:p-7">
                        <p class="manrope-font text-[10px] font-bold uppercase tracking-[0.3em] text-primary">Pillar II</p>
                        <h3 class="mt-2 syne-font text-lg font-extrabold uppercase text-dim-black">Travel dispatches</h3>
                        <p class="mt-3 flex-1 text-sm leading-relaxed text-dim-black/85 cormorant-font sm:text-[15px]">
                            Field notes from borders, cities, and quiet towns — always with consent, context, and cultural humility.
                        </p>
                    </div>
                </article>
                <article class="group flex flex-col overflow-hidden rounded-2xl border border-dim-black/10 bg-secondary/4 transition-shadow hover:shadow-xl md:col-span-1">
                    <div class="aspect-[16/11] overflow-hidden">
                        <img src="{{ asset('assets/images/stories-img-03.png') }}" alt="{{ __('Visual and mixed media pillar') }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-[1.03]" loading="lazy" decoding="async" />
                    </div>
                    <div class="flex flex-1 flex-col p-6 sm:p-7">
                        <p class="manrope-font text-[10px] font-bold uppercase tracking-[0.3em] text-primary">Pillar III</p>
                        <h3 class="mt-2 syne-font text-lg font-extrabold uppercase text-dim-black">Visual & mixed media</h3>
                        <p class="mt-3 flex-1 text-sm leading-relaxed text-[var(--text-color)]/85 cormorant-font sm:text-[15px]">
                            Photography, collage, and tactile studies that let colour and line speak when silence is stronger than syntax.
                        </p>
                    </div>
                </article>
            </div>
        </div>
    </section>

    {{-- Timeline --}}
    <section class="bg-[var(--text-color)] py-14 text-white sm:py-16 md:py-20 lg:py-28" aria-labelledby="about-timeline-heading">
        <div class="container">
            <div class="max-w-xl">
                <h2 id="about-timeline-heading" class="syne-font text-xs font-extrabold uppercase tracking-[0.35em] text-primary">The thread</h2>
                <p class="mt-3 text-2xl font-bold leading-tight sm:text-3xl md:text-4xl plarfair-font">
                    Milestones along the path
                </p>
                <p class="mt-4 text-sm leading-relaxed text-white/72 cormorant-font sm:text-base">
                    Not a résumé — a spine. Each chapter taught a different skill in listening.
                </p>
            </div>
            <ol class="relative mx-auto mt-14 max-w-3xl border-l-2 border-primary/35 pl-8 sm:pl-10">
                @foreach ([
                    ['t' => __('Roots & language'), 'd' => __('Growing up with Dominican cadence, books smuggled in backpacks, and the sense that stories could be shelter.')],
                    ['t' => __('Crossings'), 'd' => __('Travel reframed as fieldwork — collecting detail, doubt, and gratitude in equal measure.')],
                    ['t' => __('NOTaBENZ takes shape'), 'd' => __('The imprint becomes a home for one voice across essays, letters, and visual studies.')],
                    ['t' => __('Today'), 'd' => __('Ongoing projects, guest collaborations, and readers who return for the slow burn rather than the hot take.')],
                ] as $i => $item)
                    <li class="relative pb-12 last:pb-0">
                        <span class="absolute -left-[21px] top-1.5 flex h-3 w-3 -translate-x-1/2 rounded-full border-2 border-[var(--text-color)] bg-primary sm:-left-[25px] sm:top-2" aria-hidden="true"></span>
                        <p class="manrope-font text-[10px] font-bold uppercase tracking-[0.28em] text-primary/90">{{ str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) }}</p>
                        <h3 class="mt-2 syne-font text-lg font-extrabold uppercase tracking-tight sm:text-xl">{{ $item['t'] }}</h3>
                        <p class="mt-2 max-w-prose text-sm leading-relaxed text-white/78 cormorant-font sm:text-[15px]">{{ $item['d'] }}</p>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>

    <section class="quote-banner" aria-label="{{ __('Featured quote') }}">
        <div class="quote-banner__inner">
            <blockquote class="quote-banner__quote">
                <p class="quote-banner__text">Identity is not given. It is built — word by deliberate word.</p>
                <footer class="quote-banner__attribution tracking-[2.98px]">— Mercedes A. Villamán</footer>
            </blockquote>
        </div>
    </section>

    {{-- FAQ --}}
    <section class="bg-white py-14 sm:py-16 md:py-20" aria-labelledby="about-faq-heading">
        <div class="container max-w-3xl">
            <h2 id="about-faq-heading" class="text-center syne-font text-xs font-extrabold uppercase tracking-[0.35em] text-secondary">Questions</h2>
            <p class="mt-3 text-center text-2xl font-bold text-[var(--text-color)] sm:text-3xl plarfair-font">
                Before you dive in
            </p>
            <div class="mt-10 divide-y divide-[color-mix(in_srgb,var(--text-color)_12%,transparent)] border-y border-[color-mix(in_srgb,var(--text-color)_12%,transparent)]">
                @foreach ([
                    ['q' => __('What is NOTaBENZ?'), 'a' => __('A creative imprint led by Mercedes A. Villamán — a meeting point for literary work, travel narrative, and visual exploration.')],
                    ['q' => __('Is this a brand or a person?'), 'a' => __('Both, intentionally. The name holds the work; the work is inseparable from the life behind it.')],
                    ['q' => __('Do you take commissions or collaborations?'), 'a' => __('Select editorial, travel, and visual partnerships are welcome. Reach out with context, timeline, and what success looks like for you.')],
                    ['q' => __('Where should a new reader start?'), 'a' => __('Begin with the scroll story on the home page, then follow the medium that pulls you — prose, field notes, or image.')],
                ] as $faq)
                    <details class="group py-5 sm:py-6" name="about-faq">
                        <summary class="flex cursor-pointer list-none items-center justify-between gap-4 text-left manrope-font text-sm font-bold uppercase tracking-wide text-[var(--text-color)] marker:content-none [&::-webkit-details-marker]:hidden">
                            <span>{{ $faq['q'] }}</span>
                            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full border border-[color-mix(in_srgb,var(--text-color)_15%,transparent)] text-lg text-primary transition group-open:rotate-45" aria-hidden="true">+</span>
                        </summary>
                        <p class="mt-4 text-base leading-relaxed text-[var(--text-color)]/82 cormorant-font sm:pr-8">
                            {{ $faq['a'] }}
                        </p>
                    </details>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="border-t border-[color-mix(in_srgb,var(--text-color)_10%,transparent)] bg-[color-mix(in_srgb,var(--secondary-color)_8%,white)] py-14 sm:py-16 md:py-20" aria-labelledby="about-cta-heading">
        <div class="container">
            <div class="relative overflow-hidden rounded-2xl border border-[color-mix(in_srgb,var(--text-color)_10%,transparent)] bg-white px-6 py-10 shadow-lg sm:px-10 sm:py-12 md:flex md:items-center md:justify-between md:gap-10 md:py-14 lg:px-14">
                <div class="pointer-events-none absolute -right-20 -top-20 h-56 w-56 rounded-full bg-primary/10 blur-3xl" aria-hidden="true"></div>
                <div class="relative max-w-xl space-y-3">
                    <h2 id="about-cta-heading" class="syne-font text-2xl font-extrabold uppercase leading-tight tracking-tight text-[var(--text-color)] sm:text-3xl">
                        {{ __('Stay with the narrative') }}
                    </h2>
                    <p class="text-base text-[var(--text-color)]/78 cormorant-font sm:text-lg">
                        {{ __('Return to the full journey on the home page, or send a note if you\'re imagining something together.') }}
                    </p>
                </div>
                <div class="relative mt-8 flex shrink-0 flex-col gap-4 sm:flex-row md:mt-0">
                    <a href="{{ route('home') }}" class="btn btn-primary">
                        Back to home
                        <span class="pl-[20px] text-[15px]" aria-hidden="true">→</span>
                    </a>
                    <a
                        href="mailto:info@notabenz.com"
                        class="btn btn-secondary border-btn"
                    >
                        Email the studio
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@push('scripts')
    <script>
        document.querySelectorAll('#about-main details[name="about-faq"]').forEach(function (details) {
            details.addEventListener('toggle', function () {
                if (!details.open) {
                    return;
                }
                document.querySelectorAll('#about-main details[name="about-faq"]').forEach(function (other) {
                    if (other !== details) {
                        other.removeAttribute('open');
                    }
                });
            });
        });
    </script>
@endpush
