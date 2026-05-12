@extends('layouts.web.master')

@section('content')
<main class="inner-page artifacts-page">
    <section class="inner-banner inner-banner--compact flex items-center justify-center text-center">
        <div class="container text-left">
            <nav class="inner-banner-breadcrumb text-sm text-white/80" aria-label="{{ __('Breadcrumb') }}">
                <a href="{{ route('artifacts.index') }}" class="underline-offset-2 transition hover:text-white hover:underline">{{ __('Artifacts') }}</a>
                <span class="mx-2 text-white/50" aria-hidden="true">/</span>
                <span class="text-white">{{ $product->name }}</span>
            </nav>
        </div>
    </section>

    <section class="product-detail-sec py-10">
        <div class="container">
            @php
                $galleryThumbUrls = $galleryImages
                    ->map(fn ($img) => $img->publicUrl())
                    ->filter(fn ($u) => trim((string) $u) !== '')
                    ->values()
                    ->all();
            @endphp
            @if ($isVariable)
                <div
                    class="product-detail-layout grid grid-cols-1 gap-8 lg:grid-cols-2 lg:gap-12"
                    x-data="storeProductMatrix(@js($matrixPayload))"
                >
                    <div class="product-gallery">
                        <div class="product-gallery__main aspect-square w-full overflow-hidden rounded-lg bg-neutral-100">
                            <img
                                x-bind:src="displayMainImage"
                                src="{{ $defaultMainImage }}"
                                class="product-gallery__main-img h-full w-full object-cover"
                                width="800"
                                height="800"
                                alt="{{ $product->name }}"
                            >
                        </div>
                        <div x-show="activeGalleryUrls.length > 1" x-cloak class="product-gallery-thumbs-slider" data-thumbs-slider>
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
                                    <template x-for="url in activeGalleryUrls" :key="url">
                                        <li class="shrink-0">
                                            <button
                                                type="button"
                                                class="product-gallery__thumb"
                                                :class="{ 'is-active': url === displayMainImage }"
                                                @click="pickGallery(url)"
                                            >
                                                <img :src="url" alt="" class="h-full w-full object-cover" width="96" height="96" loading="lazy">
                                            </button>
                                        </li>
                                    </template>
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
                    </div>

                    <div class="product-buy-box flex flex-col gap-6">
                        <header>
                            <h1 class="product-title text-3xl font-bold font-playfair text-primary md:text-[40px]">{{ $product->name }}</h1>
                            @if ($product->category)
                                <p class="mt-1 text-sm text-neutral-600">{{ $product->category->name }}</p>
                            @endif
                        </header>

                        @if ($product->description)
                            <div class="product-desc prose prose-neutral max-w-none text-neutral-700">
                                {!! nl2br(e($product->description)) !!}
                            </div>
                        @endif

                        <div class="variation-stack space-y-6" role="group" aria-label="{{ __('Options') }}">
                            <template x-for="d in dimensions" :key="d.id">
                                <fieldset class="variation-fieldset border-0 p-0">
                                    <label class="variation-legend mb-2 block text-sm font-semibold uppercase tracking-wide text-neutral-900" :for="'matrix-select-' + d.id" x-text="d.name"></label>
                                    <select
                                        :id="'matrix-select-' + d.id"
                                        class="variation-select w-full max-w-xs rounded-md border border-neutral-300 bg-white px-3 py-2.5 text-sm text-neutral-900 shadow-sm transition focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary"
                                        :name="'matrix-' + d.id"
                                        :aria-label="d.name"
                                        :value="selections[k(d.id)]"
                                        @change="selectValue(d.id, $event.target.value)"
                                    >
                                        <option value="">{{ __('Choose') }}…</option>
                                        <template x-for="val in optionsForDimension(d.id)" :key="String(d.id) + ':' + val">
                                            <option :value="val" x-text="val"></option>
                                        </template>
                                    </select>
                                </fieldset>
                            </template>
                        </div>

                        <div class="product-price-row flex flex-wrap items-baseline gap-2 border-t border-neutral-200 pt-6">
                            <span class="text-sm font-medium uppercase tracking-wide text-neutral-600">{{ __('Price') }}</span>
                            <span class="product-price text-2xl font-bold text-primary md:text-[24px]" x-text="priceLine" aria-live="polite"></span>
                        </div>

                        <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                            <label class="flex items-center gap-2 text-sm font-medium text-neutral-800">
                                <span>{{ __('Quantity') }}</span>
                                <input
                                    type="number"
                                    name="quantity"
                                    min="1"
                                    value="1"
                                    class="qty-input w-20 rounded border border-neutral-300 px-2 py-1.5 text-center text-sm"
                                >
                            </label>
                        </div>

                        <button type="button" data-id="{{ $product->id }}" class="add-to-cart btn btn-primary btn-hover mt-2 w-full">{{ __('Add to cart') }}</button>
                    </div>
                </div>
            @else
                <div class="product-detail-layout grid grid-cols-1 gap-8 lg:grid-cols-2 lg:gap-12">
                    <div class="product-gallery" data-simple-gallery>
                        <div class="product-gallery__main aspect-square w-full overflow-hidden rounded-lg bg-neutral-100">
                            <img
                                src="{{ $defaultMainImage }}"
                                class="product-gallery__main-img h-full w-full object-cover"
                                width="800"
                                height="800"
                                alt="{{ $product->name }}"
                            >
                        </div>
                        @include('screens.web.artifacts.partials.gallery-thumbs-slider', [
                            'urls' => $galleryThumbUrls,
                            'mode' => 'simple',
                            'defaultUrl' => $defaultMainImage,
                        ])
                    </div>

                    <div class="product-buy-box flex flex-col gap-6">
                        <header>
                            <h1 class="product-title text-3xl font-bold font-playfair text-primary md:text-[40px]">{{ $product->name }}</h1>
                            @if ($product->category)
                                <p class="mt-1 text-sm text-neutral-600">{{ $product->category->name }}</p>
                            @endif
                        </header>

                        @if ($product->description)
                            <div class="product-desc prose prose-neutral max-w-none text-neutral-700">
                                {!! nl2br(e($product->description)) !!}
                            </div>
                        @endif

                        <div class="product-price-row flex flex-wrap items-baseline gap-2 border-t border-neutral-200 pt-6">
                            <span class="text-sm font-medium uppercase tracking-wide text-neutral-600">{{ __('Price') }}</span>
                            <span class="product-price text-2xl font-bold text-primary md:text-[24px]">${{ number_format((float) $product->price, 2) }}</span>
                        </div>

                        <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                            <label class="flex items-center gap-2 text-sm font-medium text-neutral-800">
                                <span>{{ __('Quantity') }}</span>
                                <input
                                    type="number"
                                    name="quantity"
                                    min="1"
                                    value="1"
                                    class="qty-input w-20 rounded border border-neutral-300 px-2 py-1.5 text-center text-sm"
                                >
                            </label>
                        </div>

                        <button type="button" data-id="{{ $product->id }}" class="add-to-cart btn btn-primary btn-hover mt-2 w-full">{{ __('Add to cart') }}</button>
                    </div>
                </div>
            @endif
        </div>
    </section>
</main>
@endsection
@push('scripts')
@include('includes.ajax-requests.cart')
@endpush