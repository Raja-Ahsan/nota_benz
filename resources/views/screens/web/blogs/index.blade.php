@extends('layouts.web.master')
<!-- blog page for jumps -->

@section('title', 'Jumps')

@push('body-class')
inner-site
@endpush

@section('content')
    <main
        id="blog-index"
        class="bg-[var(--white-color)] text-[var(--text-color)]"
        data-posts-url="{{ route('blog.posts', [], false) }}"
        data-index-url="{{ route('blog.index', [], false) }}">
        <section class="relative isolate overflow-hidden border-b border-black/5" aria-label="{{ __('Journal hero') }}">
            <div class="pointer-events-none absolute inset-0 -z-10">
                <div
                    class="absolute inset-0 h-full w-full bg-cover bg-center bg-no-repeat opacity-90"
                    style="background-image: url('{{ asset('assets/images/slider-img-03.png') }}');"
                    role="presentation"
                ></div>
                <div class="absolute inset-0 bg-gradient-to-r from-black/75 via-black/55 to-black/35" aria-hidden="true"></div>
            </div>

            <div class="container relative z-10 py-24 sm:py-28 lg:py-32">
                <div class="max-w-3xl space-y-6 pt-12 sm:pt-16 lg:pt-10">
                    <!-- <p class="manrope-font text-[10px] font-semibold uppercase tracking-[0.28em] text-white/60">
                        <a href="{{ route('home') }}" class="text-white/70 transition-colors hover:text-primary-color">{{ __('Home') }}</a>
                        <span class="mx-2 text-white/35" aria-hidden="true">/</span>
                        <span class="text-white/90">Jumps</span>
                    </p> -->
                    <h1 class="syne-font text-[34px] font-extrabold uppercase leading-[1.05] tracking-tight text-white sm:text-[48px] md:text-[56px]">
                        Jumps
                    </h1>
                </div>
            </div>
        </section>

        <section class="container py-12 sm:py-16 lg:py-20" aria-label="{{ __('Posts') }}">
            <div
                id="blog-category-filters"
                class="flex flex-wrap items-center justify-center gap-3 border-b border-black/10 pb-8 manrope-font"
                role="tablist"
                aria-label="{{ __('Filter by category') }}">
                @php
                    $allActive = ! $activeCategory || $activeCategory === 'all';
                @endphp
                <a
                    href="{{ route('blog.index') }}"
                    data-blog-filter="all"
                    data-category=""
                    class="@if ($allActive) inline-flex items-center rounded-full border border-secondary bg-secondary/10 px-4 py-2 text-[11px] font-bold uppercase tracking-[0.2em] text-secondary transition-colors sm:text-xs @else inline-flex items-center rounded-full border border-black/15 px-4 py-2 text-[11px] font-bold uppercase tracking-[0.2em] text-[var(--text-color)] transition-colors hover:border-secondary hover:text-secondary sm:text-xs @endif">
                    {{ __('All posts') }}
                </a>
                @foreach ($categories as $cat)
                    @php $catOn = $activeCategory === $cat->slug; @endphp
                    <a
                        href="{{ route('blog.index', ['category' => $cat->slug]) }}"
                        data-blog-filter="category"
                        data-category="{{ $cat->slug }}"
                        class="@if ($catOn) inline-flex items-center rounded-full border border-secondary bg-secondary/10 px-4 py-2 text-[11px] font-bold uppercase tracking-[0.2em] text-secondary transition-colors sm:text-xs @else inline-flex items-center rounded-full border border-black/15 px-4 py-2 text-[11px] font-bold uppercase tracking-[0.2em] text-[var(--text-color)] transition-colors hover:border-secondary hover:text-secondary sm:text-xs @endif">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>

            <div id="blog-posts-results">
                @include('screens.web.blogs.partials.posts-results', ['blogs' => $blogs])
            </div>
        </section>
    </main>
@endsection

@push('scripts')
    <script>
        (function () {
            var root = document.getElementById('blog-index');
            if (!root) return;
            var results = document.getElementById('blog-posts-results');
            var filters = document.getElementById('blog-category-filters');
            var postsUrl = root.getAttribute('data-posts-url');
            var indexUrl = root.getAttribute('data-index-url');
            if (!results || !filters || !postsUrl || !indexUrl) return;

            var postsPath = (function () {
                try {
                    return new URL(postsUrl, window.location.origin).pathname;
                } catch (e) {
                    return '/blogs/posts';
                }
            })();

            function pillClasses(active) {
                var base =
                    'inline-flex items-center rounded-full border px-4 py-2 text-[11px] font-bold uppercase tracking-[0.2em] transition-colors sm:text-xs ';
                return (
                    base +
                    (active
                        ? 'border-secondary bg-secondary/10 text-secondary'
                        : 'border-black/15 text-[var(--text-color)] hover:border-secondary hover:text-secondary')
                );
            }

            function syncPills(activeCategory) {
                filters.querySelectorAll('[data-blog-filter]').forEach(function (el) {
                    var mode = el.getAttribute('data-blog-filter');
                    var cat = el.getAttribute('data-category') || '';
                    var isAll = mode === 'all';
                    var on = isAll
                        ? !activeCategory || activeCategory === '' || activeCategory === 'all'
                        : activeCategory === cat;
                    el.className = pillClasses(on);
                });
            }

            function loadPosts(queryString, pushHistory) {
                var url = postsUrl + (queryString ? '?' + queryString : '');
                fetch(url, {
                    headers: {
                        Accept: 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    credentials: 'same-origin',
                })
                    .then(function (r) {
                        if (!r.ok) throw new Error('bad status');
                        return r.json();
                    })
                    .then(function (data) {
                        results.innerHTML = data.html;
                        syncPills(data.activeCategory);
                        if (pushHistory) {
                            var listUrl = indexUrl + (queryString ? '?' + queryString : '');
                            window.history.pushState({ blogFilter: queryString }, '', listUrl);
                        }
                    })
                    .catch(function () {
                        window.location.href = indexUrl + (queryString ? '?' + queryString : '');
                    });
            }

            filters.addEventListener('click', function (e) {
                var a = e.target.closest('[data-blog-filter]');
                if (!a || !filters.contains(a)) return;
                e.preventDefault();
                var mode = a.getAttribute('data-blog-filter');
                var cat = a.getAttribute('data-category') || '';
                var qs = mode === 'all' ? '' : 'category=' + encodeURIComponent(cat);
                loadPosts(qs, true);
            });

            results.addEventListener('click', function (e) {
                var a = e.target.closest('a');
                if (!a || !results.contains(a)) return;
                var href = a.getAttribute('href');
                if (!href) return;
                var u;
                try {
                    u = new URL(a.href, window.location.origin);
                } catch (err) {
                    return;
                }
                if (u.pathname !== postsPath) return;
                e.preventDefault();
                loadPosts(u.searchParams.toString(), true);
            });

            window.addEventListener('popstate', function () {
                loadPosts(new URLSearchParams(window.location.search).toString(), false);
            });
        })();
    </script>
@endpush
