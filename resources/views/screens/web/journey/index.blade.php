@extends('layouts.web.master')

@section('title', __('Journey') . ' — NOTaBENZ')

@push('body-class')
inner-site
@endpush

@section('content')
<main id="journey-main">
    {{-- Hero --}}
    <section class="relative isolate min-h-[58svh] overflow-hidden sm:min-h-[64svh] lg:min-h-[70svh]" aria-label="{{ __('Journey hero') }}">
        <div class="pointer-events-none absolute inset-0 -z-10">
            <div
                class="absolute inset-0 h-full w-full bg-cover bg-center bg-no-repeat"
                style="background-image: url('{{ asset('assets/images/slider-img-04.png') }}');"
                role="presentation"
            ></div>
            <div class="absolute inset-0 bg-gradient-to-r from-black/82 via-black/58 to-black/35" aria-hidden="true"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/78 via-transparent to-black/35"></div>
        </div>

        <div class="container relative z-10 flex min-h-[58svh] flex-col justify-center py-20 sm:min-h-[64svh] sm:px-6 sm:py-24 md:py-28 lg:min-h-[70svh] lg:px-8 lg:py-36">
            <div class="max-w-4xl space-y-8 pt-16 sm:pt-20 lg:pt-8">
                <p class="manrope-font text-[10px] font-semibold uppercase tracking-[0.28em] text-white/50">
                    <a href="{{ route('home') }}" class="text-white/60 transition-colors hover:text-primary">Home</a>
                    <span class="mx-2 text-white/30" aria-hidden="true">/</span>
                    <span class="text-white/90">Journey</span>
                </p>

                <div class="flex items-center gap-3">
                    <span class="h-px w-8 shrink-0 bg-[var(--primary-color)]" aria-hidden="true"></span>
                    <p class="text-[15px] italic text-white sm:text-[16px]">
                        <span class="text-secondary manrope-font tracking-[3.6px]">SCENE <span class="text-primary mx-2">II</span></span>
                        <span class="text-white/60 cormorant-font tracking-[1.38px]">— The path</span>
                    </p>
                </div>

                <h1 class="syne-font text-[36px] font-extrabold uppercase leading-[1.02] tracking-tight text-white sm:text-[50px] md:text-[64px] lg:text-[72px]">
                    <span class="block">THE</span>
                    <span class="block">LONG <span class="text-primary plarfair-font normal-case italic tracking-normal">arc</span><span class="text-white">.</span></span>
                </h1>

                <div class="max-w-2xl space-y-2 font-sans text-[13px] text-white/65 sm:text-lg">
                    <p class="font-medium leading-relaxed cormorant-font text-[17px] text-white/85 sm:text-[20px] sm:tracking-[0.03em]">
                        A guided map of how NOTaBENZ moves — from origin to philosophy — and how you can walk beside it.
                    </p>
                    <p class="manrope-font text-[11px] font-bold uppercase tracking-[0.32em] text-primary sm:text-xs">
                        Chapters · Field notes · Living archive
                    </p>
                </div>

                <div class="flex flex-col gap-4 pt-2 sm:flex-row sm:flex-wrap sm:items-center sm:gap-5">
                    <a href="#" class="btn btn-primary">
                        Explore chapters
                        <span class="pl-[20px] text-[15px]" aria-hidden="true">↓</span>
                    </a>
                    <a href="#" class="btn secondary-btn">Full scroll story</a>
                </div>
            </div>
        </div>
    </section>

    @php
        $tickerWords = [
            __('Origin'),
            __('Road'),
            __('Art'),
            __('Philosophy'),
            __('Notebook'),
            __('Border'),
            __('Return'),
            __('Light'),
            __('Origin'),
            __('Road'),
            __('Art'),
            __('Philosophy'),
            __('Notebook'),
            __('Border'),
            __('Return'),
            __('Light'),
        ];
    @endphp
    <section class="home-ticker overflow-hidden bg-secondary py-4 shadow-inner" aria-label="{{ __('Journey tagline scroll') }}">
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

    {{-- How the journey reads --}}
    <section class="border-b border-[color-mix(in_srgb,var(--text-color)_10%,transparent)] bg-white py-12 sm:py-14 md:py-16" aria-labelledby="journey-map-heading">
        <div class="container">
            <div class="mx-auto max-w-2xl text-center">
                <h2 id="journey-map-heading" class="syne-font text-xs font-extrabold uppercase tracking-[0.35em] text-secondary">
                    How this page works
                </h2>
                <p class="mt-3 text-lg leading-snug text-dim-black sm:text-xl md:text-2xl plarfair-font">
                    The home page tells the story in motion. Here, the same arc is
                    <em class="text-secondary not-italic">indexed and legible</em>
                    — built for return visits and deep dives.
                </p>
            </div>
            <ul class="mt-12 grid gap-6 md:grid-cols-3">
                <li class="rounded-2xl border border-[color-mix(in_srgb,var(--text-color)_10%,transparent)] bg-[color-mix(in_srgb,var(--secondary-color)_5%,white)] p-6 sm:p-8">
                    <p class="syne-font text-2xl font-extrabold text-primary">01</p>
                    <h3 class="mt-2 syne-font text-sm font-extrabold uppercase tracking-tight text-[var(--text-color)]">Orient</h3>
                    <p class="mt-3 text-sm leading-relaxed text-[var(--text-color)]/85 cormorant-font sm:text-[15px]">
                        Start with origin and intent — who speaks, why it matters, and what “NOTaBENZ” refuses.
                    </p>
                </li>
                <li class="rounded-2xl border border-[color-mix(in_srgb,var(--text-color)_10%,transparent)] bg-[color-mix(in_srgb,var(--secondary-color)_5%,white)] p-6 sm:p-8">
                    <p class="syne-font text-2xl font-extrabold text-primary">02</p>
                    <h3 class="mt-2 syne-font text-sm font-extrabold uppercase tracking-tight text-[var(--text-color)]">Traverse</h3>
                    <p class="mt-3 text-sm leading-relaxed text-[var(--text-color)]/85 cormorant-font sm:text-[15px]">
                        Follow the road and the studio — miles, margins, murals, and the discipline of showing up.
                    </p>
                </li>
                <li class="rounded-2xl border border-[color-mix(in_srgb,var(--text-color)_10%,transparent)] bg-[color-mix(in_srgb,var(--secondary-color)_5%,white)] p-6 sm:p-8">
                    <p class="syne-font text-2xl font-extrabold text-primary">03</p>
                    <h3 class="mt-2 syne-font text-sm font-extrabold uppercase tracking-tight text-[var(--text-color)]">Anchor</h3>
                    <p class="mt-3 text-sm leading-relaxed text-[var(--text-color)]/85 cormorant-font sm:text-[15px]">
                        Land on philosophy and next steps — identity as practice, and where to read or collaborate next.
                    </p>
                </li>
            </ul>
        </div>
    </section>

    {{-- Chapters (mirrors home narrative, editorial layout) --}}
    <section id="journey-chapters" class="scroll-mt-24 bg-[color-mix(in_srgb,var(--secondary-color)_6%,white)] py-14 sm:py-16 md:py-20 lg:py-28" aria-labelledby="journey-chapters-heading">
        <div class="container">
            <div class="mb-12 max-w-2xl md:mb-16">
                <p class="manrope-font text-[11px] font-bold uppercase tracking-[0.3em] text-secondary">Chapters</p>
                <h2 id="journey-chapters-heading" class="mt-2 syne-font text-2xl font-extrabold uppercase leading-tight tracking-tight text-[var(--text-color)] sm:text-3xl md:text-4xl">
                    Four beats. One spine.
                </h2>
                <p class="mt-4 text-base leading-relaxed text-[var(--text-color)]/80 cormorant-font sm:text-lg">
                    Each chapter matches the scroll story on the home page — use this view when you want the narrative without the long scroll.
                </p>
            </div>

            @php
                $chapters = [
                    [
                        'n' => 'I',
                        'title' => __('The Origin'),
                        'summary' => __('Dominican roots, a refusal of the ordinary, and a voice sharpened between continents.'),
                        'img' => 'slider-img-01.png',
                    ],
                    [
                        'n' => 'II',
                        'title' => __('The Road'),
                        'summary' => __('Travel as research — evidence from the Camino, Havana, Lisbon, and every line walked on purpose.'),
                        'img' => 'slider-img-02.png',
                    ],
                    [
                        'n' => 'III',
                        'title' => __('The Art'),
                        'summary' => __('Street and conceptual work — language as canvas, meaning in the gap between said and meant.'),
                        'img' => 'slider-img-03.png',
                    ],
                    [
                        'n' => 'IV',
                        'title' => __('The Philosophy'),
                        'summary' => __('Identity built word by word — an open door to the world NOTaBENZ is building with readers.'),
                        'img' => 'slider-img-04.png',
                    ],
                ];
            @endphp

            <ol class="grid gap-8 lg:grid-cols-2 lg:gap-10">
                @foreach ($chapters as $i => $ch)
                    <li class="group flex flex-col overflow-hidden rounded-2xl border border-[color-mix(in_srgb,var(--text-color)_12%,transparent)] bg-white shadow-sm transition-shadow hover:shadow-xl lg:flex-row">
                        <div class="relative aspect-[16/11] shrink-0 overflow-hidden lg:aspect-auto lg:w-[42%] lg:min-h-[280px]">
                            <img
                                src="{{ asset('assets/images/' . $ch['img']) }}"
                                alt="{{ __('Chapter :num — :title', ['num' => $ch['n'], 'title' => $ch['title']]) }}"
                                class="h-full w-full object-cover transition duration-500 group-hover:scale-[1.03]"
                                loading="{{ $i === 0 ? 'eager' : 'lazy' }}"
                                decoding="async"
                                width="800"
                                height="520"
                            />
                            <div class="absolute left-4 top-4 rounded-full bg-[var(--text-color)]/90 px-3 py-1 manrope-font text-[10px] font-bold uppercase tracking-[0.2em] text-primary">
                                {{ __('Chapter') }} {{ $ch['n'] }}
                            </div>
                        </div>
                        <div class="flex flex-1 flex-col justify-center p-6 sm:p-8 lg:p-10">
                            <h3 class="syne-font text-xl font-extrabold uppercase tracking-tight text-[var(--text-color)] sm:text-2xl">
                                {{ $ch['title'] }}
                            </h3>
                            <p class="mt-4 text-base leading-relaxed text-[var(--text-color)]/85 cormorant-font sm:text-[17px]">
                                {{ $ch['summary'] }}
                            </p>
                            <a href="{{ route('home') }}#scroll-story" class="mt-6 inline-flex items-center gap-2 self-start manrope-font text-[11px] font-bold uppercase tracking-[0.18em] text-secondary transition-colors hover:text-primary">
                                {{ __('Experience in scroll') }}<span aria-hidden="true">→</span>
                            </a>
                        </div>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>

    {{-- Timeline strip --}}
    <section class="bg-[var(--text-color)] py-14 text-white sm:py-16 md:py-20" aria-labelledby="journey-timeline-heading">
        <div class="container">
            <div class="max-w-xl">
                <h2 id="journey-timeline-heading" class="syne-font text-xs font-extrabold uppercase tracking-[0.35em] text-primary">Milestones</h2>
                <p class="mt-3 text-2xl font-bold leading-tight sm:text-3xl plarfair-font">
                    Rhythm of the work
                </p>
                <p class="mt-4 text-sm leading-relaxed text-white/75 cormorant-font sm:text-base">
                    Not a calendar of hype — a sequence of commitments that keep the journey honest.
                </p>
            </div>
            <ol class="relative mx-auto mt-12 max-w-3xl border-l-2 border-primary/35 pl-8 sm:pl-10">
                @foreach ([
                    ['t' => __('Archive & essays'), 'd' => __('Long-form pieces and letters published on a slow cadence — quality before volume.')],
                    ['t' => __('Field seasons'), 'd' => __('Travel windows where notebooks fill first; stories follow after reflection.')],
                    ['t' => __('Studio releases'), 'd' => __('Visual studies, prints, and artifacts when the work demands a physical echo.')],
                    ['t' => __('Community'), 'd' => __('Readers, collaborators, and fellow walkers — invitations open via the studio inbox.')],
                ] as $idx => $row)
                    <li class="relative pb-10 last:pb-0">
                        <span class="absolute -left-[21px] top-1.5 flex h-3 w-3 -translate-x-1/2 rounded-full border-2 border-[var(--text-color)] bg-primary sm:-left-[25px]" aria-hidden="true"></span>
                        <p class="manrope-font text-[10px] font-bold uppercase tracking-[0.28em] text-primary/90">{{ str_pad((string) ($idx + 1), 2, '0', STR_PAD_LEFT) }}</p>
                        <h3 class="mt-1 syne-font text-lg font-extrabold uppercase tracking-tight">{{ $row['t'] }}</h3>
                        <p class="mt-2 max-w-prose text-sm leading-relaxed text-white/78 cormorant-font sm:text-[15px]">{{ $row['d'] }}</p>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>

    {{-- Split: what to expect + CTA list --}}
    <section class="bg-white py-14 sm:py-16 md:py-20 lg:py-28" aria-labelledby="journey-expect-heading">
        <div class="container">
            <div class="grid items-start gap-12 lg:grid-cols-2 lg:gap-16">
                <div class="relative overflow-hidden rounded-2xl border border-[color-mix(in_srgb,var(--text-color)_10%,transparent)] shadow-xl">
                    <img
                        src="{{ asset('assets/images/scene-v-bg-image.png') }}"
                        alt="{{ __('Atmospheric scene from the NOTaBENZ journey') }}"
                        class="aspect-[4/3] w-full object-cover sm:aspect-[5/4] lg:min-h-[420px]"
                        loading="lazy"
                        decoding="async"
                        width="1200"
                        height="900"
                    />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent" aria-hidden="true"></div>
                    <p class="absolute bottom-6 left-6 right-6 text-sm italic leading-relaxed text-white/95 cormorant-font sm:text-base">
                        “Every road walked is a sentence written.” — carry that line with you through the scroll story.
                    </p>
                </div>
                <div>
                    <h2 id="journey-expect-heading" class="syne-font text-xs font-extrabold uppercase tracking-[0.35em] text-secondary">What you will find</h2>
                    <p class="mt-3 text-3xl font-bold leading-tight text-[var(--text-color)] sm:text-4xl plarfair-font">
                        Along the route
                    </p>
                    <ul class="mt-8 space-y-5">
                        @foreach ([
                            __('Editorial narrative with cinematic pacing — not listicles.'),
                            __('Travel ethics: consent, context, and humility in every dispatch.'),
                            __('Visual and written work shown as one ecosystem, not separate “channels”.'),
                            __('Clear calls to read deeper, explore artifacts, or write the studio.'),
                        ] as $item)
                            <li class="flex gap-4">
                                <span class="mt-1.5 h-2 w-2 shrink-0 rounded-full bg-primary" aria-hidden="true"></span>
                                <span class="text-base leading-relaxed text-[var(--text-color)]/88 cormorant-font sm:text-[17px]">{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <div class="mt-10 flex flex-col gap-4 sm:flex-row sm:flex-wrap">
                        <a href="{{ route('about') }}" class="btn btn-primary">
                            Meet the studio
                            <span class="pl-[20px] text-[15px]" aria-hidden="true">→</span>
                        </a>
                        <a href="mailto:info@notabenz.com" class="inline-flex items-center justify-center border border-[color-mix(in_srgb,var(--text-color)_25%,transparent)] px-8 py-[14px] text-center text-[10px] font-bold uppercase tracking-[0.18em] text-[var(--text-color)] transition-colors hover:border-secondary hover:text-secondary manrope-font sm:text-[11px]">
                            Pitch a collaboration
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="quote-banner" aria-label="{{ __('Journey quote') }}">
        <div class="quote-banner__inner">
            <blockquote class="quote-banner__quote">
                <p class="quote-banner__text">Travel was never tourism. It was research. Evidence-gathering. A study in how different people hold the same desire to be fully alive.</p>
                <footer class="quote-banner__attribution tracking-[2.98px]">— NOTaBENZ</footer>
            </blockquote>
        </div>
    </section>

    {{-- Closing CTA --}}
    <section class="border-t border-[color-mix(in_srgb,var(--text-color)_10%,transparent)] bg-[color-mix(in_srgb,var(--secondary-color)_8%,white)] py-14 sm:py-16 md:py-20" aria-labelledby="journey-cta-heading">
        <div class="container">
            <div class="relative overflow-hidden rounded-2xl border border-[color-mix(in_srgb,var(--text-color)_10%,transparent)] bg-white px-6 py-10 shadow-lg sm:px-10 sm:py-12 md:flex md:items-center md:justify-between md:gap-10 md:py-14 lg:px-14">
                <div class="pointer-events-none absolute -right-16 -top-16 h-48 w-48 rounded-full bg-primary/10 blur-3xl" aria-hidden="true"></div>
                <div class="relative max-w-xl space-y-3">
                    <h2 id="journey-cta-heading" class="syne-font text-2xl font-extrabold uppercase leading-tight tracking-tight text-[var(--text-color) sm:text-3xl">
                        Continue the motion
                    </h2>
                    <p class="text-base text-dim-black cormorant-font sm:text-lg">
                        Re-enter the scroll story on the home page, or step into the About page for mission, values, and FAQ.
                    </p>
                </div>
                <div class="relative mt-8 flex shrink-0 flex-col gap-4 sm:flex-row md:mt-0">
                    <a href="#" class="btn btn-primary">
                        Enter the journey
                        <span class="pl-[20px] text-[15px]" aria-hidden="true">→</span>
                    </a>
                    <a href="#" class="btn secondary-btn !text-dim-black">
                        About NOTaBENZ
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
