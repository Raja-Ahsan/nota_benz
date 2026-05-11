@if ($blogs->isEmpty())
    <p class="mt-14 text-center cormorant-font text-lg text-[var(--text-color)]/70">{{ __('Nothing published here yet. Check back soon.') }}</p>
@else
    <ul class="mt-12 grid list-none gap-10 sm:grid-cols-2 lg:grid-cols-3 lg:gap-12" role="list">
        @foreach ($blogs as $post)
            <li>
                <article class="group flex h-full flex-col overflow-hidden rounded-sm border border-black/10 bg-white shadow-sm transition-shadow hover:shadow-md">
                    <a href="{{ route('blog.show', $post->slug) }}" class="block shrink-0 overflow-hidden">
                        @if ($post->featured_image)
                            <img
                                src="{{ $post->featuredImageUrl() }}"
                                alt=""
                                class="aspect-[16/10] w-full object-cover transition-transform duration-500 group-hover:scale-[1.02]"
                                loading="lazy"
                            />
                        @else
                            <div
                                class="aspect-[16/10] w-full bg-cover bg-center bg-no-repeat opacity-90"
                                style="background-image: url('{{ asset('assets/images/slider-img-01.png') }}');"
                                role="presentation"></div>
                        @endif
                    </a>
                    <div class="flex flex-1 flex-col px-5 pb-6 pt-5 sm:px-6">
                        <p class="manrope-font text-[10px] font-bold uppercase tracking-[0.22em] text-secondary">
                            {{ $post->category?->name ?? __('Uncategorized') }}
                        </p>
                        <h2 class="mt-2 font-['Playfair_Display',serif] text-[22px] font-bold leading-snug text-[var(--text-color)] sm:text-[24px]">
                            <a href="{{ route('blog.show', $post->slug) }}" class="transition-colors hover:text-secondary">
                                {{ $post->title }}
                            </a>
                                    </h2>
                                    <p class="mt-5 manrope-font text-[10px] font-semibold uppercase tracking-[0.18em] text-[var(--text-color)]/45">
                            {{ optional($post->published_at)->format('M j, Y') }}
                        </p>
                        <a
                            href="{{ route('blog.show', $post->slug) }}"
                            class="mt-4 inline-flex items-center gap-2 self-start manrope-font text-[11px] font-bold uppercase tracking-[0.18em] text-secondary transition-colors hover:text-primary">
                            {{ __('Read') }}
                            <span aria-hidden="true">→</span>
                        </a>
                    </div>
                </article>
            </li>
        @endforeach
    </ul>

    <div class="blog-index-pagination mt-14 flex justify-center">
        {{ $blogs->onEachSide(1)->links() }}
    </div>
@endif
