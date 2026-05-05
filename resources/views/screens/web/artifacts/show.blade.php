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
                        @if ($galleryImages->count() > 1)
                            <ul class="product-gallery__thumbs mt-3 flex list-none flex-wrap gap-2 p-0" role="list">
                                @foreach ($galleryImages as $img)
                                    @php $thumbSrc = $img->publicUrl(); @endphp
                                    @if ($thumbSrc !== '')
                                        <li>
                                            <button
                                                type="button"
                                                class="product-gallery__thumb {{ $thumbSrc === $defaultMainImage ? 'is-active' : '' }}"
                                                :class="{ 'is-active': mainImageOverride === '{{ $thumbSrc }}' || (!mainImageOverride && '{{ $thumbSrc }}' === defaultMain) }"
                                                @click="pickGallery('{{ $thumbSrc }}')"
                                            >
                                                <img src="{{ $thumbSrc }}" alt="" class="h-full w-full object-cover" width="96" height="96" loading="lazy">
                                            </button>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        @endif
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
                                    <legend class="variation-legend mb-2 text-sm font-semibold uppercase tracking-wide text-neutral-900" x-text="d.name"></legend>
                                    <div class="variation-options flex flex-wrap gap-2" role="radiogroup" :aria-label="d.name">
                                        <template x-for="val in optionsForDimension(d.id)" :key="String(d.id) + ':' + val">
                                            <label class="variation-label cursor-pointer">
                                                <input
                                                    type="radio"
                                                    class="variation-input sr-only"
                                                    :name="'matrix-' + d.id"
                                                    :value="val"
                                                    :checked="isSelected(d.id, val)"
                                                    @change="selectValue(d.id, val)"
                                                >
                                                <span class="variation-pill" :class="{ 'is-selected': isSelected(d.id, val) }" x-text="val"></span>
                                            </label>
                                        </template>
                                    </div>
                                </fieldset>
                            </template>
                        </div>

                        <div class="product-price-row flex flex-wrap items-baseline gap-2 border-t border-neutral-200 pt-6">
                            <span class="text-sm font-medium uppercase tracking-wide text-neutral-600">{{ __('Price') }}</span>
                            <span class="product-price text-2xl font-bold text-primary md:text-[24px]" x-text="'$' + totalPrice.toFixed(2)" aria-live="polite"></span>
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
                        @if ($galleryImages->count() > 1)
                            <ul class="product-gallery__thumbs mt-3 flex list-none flex-wrap gap-2 p-0" role="list">
                                @foreach ($galleryImages as $img)
                                    <li>
                                        <button
                                            type="button"
                                            class="product-gallery__thumb {{ $img->publicUrl() === $defaultMainImage ? 'is-active' : '' }}"
                                            data-full-src="{{ $img->publicUrl() }}"
                                        >
                                            <img src="{{ $img->publicUrl() }}" alt="" class="h-full w-full object-cover" width="96" height="96" loading="lazy">
                                        </button>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
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