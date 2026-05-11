@extends('layouts.web.master')

@section('title', $blog->title)

@push('body-class')
inner-site
@endpush

@section('content')
    <main id="blog-detail" class="bg-[var(--white-color)] text-[var(--text-color)]">
        <article>
            <header class="relative isolate min-h-[42svh] overflow-hidden sm:min-h-[48svh]">
                <div class="pointer-events-none absolute inset-0 -z-10">
                    @if ($blog->featured_image)
                        <div
                            class="absolute inset-0 bg-cover bg-center bg-no-repeat"
                            style="background-image: url('{{ $blog->featuredImageUrl() }}');"
                            role="presentation"
                        ></div>
                    @else
                        <div
                            class="absolute inset-0 bg-cover bg-center bg-no-repeat"
                            style="background-image: url('{{ asset('assets/images/slider-img-02.png') }}');"
                            role="presentation"
                        ></div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/55 to-black/35" aria-hidden="true"></div>
                </div>

                <div class="container relative z-10 flex min-h-[42svh] flex-col justify-end py-16 sm:min-h-[48svh] sm:py-20 lg:py-24">
                    <div class="max-w-4xl pb-4">
                        <p class="manrope-font text-[10px] font-semibold uppercase tracking-[0.28em] text-white/60">
                            <a href="{{ route('home') }}" class="text-white/70 transition-colors hover:text-primary-color">{{ __('Home') }}</a>
                            <span class="mx-2 text-white/35" aria-hidden="true">/</span>
                            <a href="{{ route('blog.index') }}" class="text-white/70 transition-colors hover:text-primary-color">{{ __('Journal') }}</a>
                            @if ($blog->category)
                                <span class="mx-2 text-white/35" aria-hidden="true">/</span>
                                <a
                                    href="{{ route('blog.index', ['category' => $blog->category->slug]) }}"
                                    class="text-white/70 transition-colors hover:text-primary-color">
                                    {{ $blog->category->name }}
                                </a>
                            @endif
                        </p>
                        <p class="mt-4 manrope-font text-[11px] font-bold uppercase tracking-[0.22em] text-secondary">
                            {{ $blog->category?->name ?? __('Journal') }}
                        </p>
                        <h1 class="mt-3 syne-font text-[32px] font-extrabold uppercase leading-[1.08] tracking-tight text-white sm:text-[44px] md:text-[52px]">
                            {{ $blog->title }}
                        </h1>
                        @if ($blog->published_at)
                            <p class="mt-4 manrope-font text-[11px] font-semibold uppercase tracking-[0.2em] text-white/55">
                                {{ $blog->published_at->format('F j, Y') }}
                            </p>
                        @endif
                    </div>
                </div>
            </header>

            <div class="container py-12 sm:py-16 lg:py-20">
                @php
                    $blogBodyHtml = trim((string) $blog->body);
                    $isPlain = $blogBodyHtml === '' || $blogBodyHtml === strip_tags($blogBodyHtml);
                @endphp
                <div class="prose-blog blog-body-content mx-auto max-w-3xl cormorant-font text-[18px] leading-[1.75] text-[var(--text-color)] sm:text-[20px]">
                    @if ($isPlain)
                        {!! nl2br(e($blogBodyHtml)) !!}
                    @else
                        {!! $blogBodyHtml !!}
                    @endif
                </div>

                <div class="mx-auto mt-16 max-w-3xl border-t border-black/10 pt-10">
                    <a
                        href="{{ $blog->category ? route('blog.index', ['category' => $blog->category->slug]) : route('blog.index') }}"
                        class="inline-flex items-center gap-2 manrope-font text-[11px] font-bold uppercase tracking-[0.18em] text-secondary transition-colors hover:text-primary">
                        ← {{ __('Back to journal') }}
                    </a>
                </div>
            </div>
        </article>
    </main>
@endsection
