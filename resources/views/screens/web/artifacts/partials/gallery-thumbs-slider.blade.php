{{--
    @var list<string> $urls
    @var string $mode  alpine | simple
    @var string $defaultUrl  URL of initially selected thumb (main / default gallery image)
--}}
@if (count($urls) > 1)
    <div class="product-gallery-thumbs-slider" data-thumbs-slider>
        <button
            type="button"
            class="product-gallery-thumbs-slider__nav product-gallery-thumbs-slider__nav--prev"
            data-thumbs-scroll="prev"
            aria-label="{{ __('Previous images') }}"
        >
            <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
        </button>
        <div class="product-gallery-thumbs-slider__viewport">
            <ul
                class="product-gallery__thumbs product-gallery-thumbs-slider__track flex list-none flex-nowrap gap-2 p-0 pb-1"
                data-thumbs-track
                role="list"
            >
                @foreach ($urls as $url)
                    <li class="shrink-0">
                        @if ($mode === 'alpine')
                            <button
                                type="button"
                                class="product-gallery__thumb {{ $url === $defaultUrl ? 'is-active' : '' }}"
                                :class="{ 'is-active': mainImageOverride === {{ \Illuminate\Support\Js::from($url) }} || (!mainImageOverride && {{ \Illuminate\Support\Js::from($url) }} === defaultMain) }"
                                @click="pickGallery({{ \Illuminate\Support\Js::from($url) }})"
                            >
                                <img src="{{ $url }}" alt="" class="h-full w-full object-cover" width="96" height="96" loading="lazy">
                            </button>
                        @else
                            <button
                                type="button"
                                class="product-gallery__thumb {{ $url === $defaultUrl ? 'is-active' : '' }}"
                                data-full-src="{{ $url }}"
                            >
                                <img src="{{ $url }}" alt="" class="h-full w-full object-cover" width="96" height="96" loading="lazy">
                            </button>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
        <button
            type="button"
            class="product-gallery-thumbs-slider__nav product-gallery-thumbs-slider__nav--next"
            data-thumbs-scroll="next"
            aria-label="{{ __('Next images') }}"
        >
            <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
        </button>
    </div>
@endif
