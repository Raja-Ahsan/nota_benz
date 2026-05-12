@extends('layouts.web.master')

@section('title', $blog->title)

@push('body-class')
inner-site
@endpush

@section('content')
    <main id="blog-detail" class="bg-[var(--white-color)] text-[var(--text-color)]">
        <article>
            <section class="blog-banner-sec relative isolate overflow-hidden">
                <div class="container relative z-10 flex flex-col justify-end">
                    <div class="max-w-4xl pb-4">
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
            </section>

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
