@extends('layouts.web.master')

@section('content')
<main class="inner-page artifacts-page">
    <section class="inner-banner flex items-center justify-center text-center">
        <div class="container">
            <h1 class="inner-banner-hd">Artifacts</h1>
        </div>
    </section>
    <section class="artifacts-sec py-10">
        <div class="grid grid-cols-6 px-3">
            <div>
                sidebar
            </div>
            <div class="col-span-5">
                <div class="grid grid-cols-4 gap-4">
                    @forelse ($products as $product)
                    <div class="products-card-wrapper">
                        <a
                            href="{{ route('artifacts.show', $product) }}"
                            class="product-card-link block text-inherit no-underline transition-opacity hover:opacity-90 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[var(--primary-color)]"
                        >
                            <div class="image-wrapper mb-2">
                                @php
                                $image = $product->images->where('is_primary', 1)->first();
                                @endphp

                                <img
                                    src="{{ $image ? asset($image->image) : asset('assets/images/placeholders/img-not-available.png') }}"
                                    class="product-image"
                                    alt="{{ $product->name }}">
                            </div>
                            <div class="content-wrapper flex flex-col gap-2">
                                <h3 class="product-title">{{ $product->name }}</h3>
                                <!-- <p class="product-desc">Artifact Description</p> -->
                                <span class="product-price block">{{ $product->listingPriceLabel() }}</span>
                            </div>
                        </a>
                        @if ($product->isVariable())
                            <a href="{{ route('artifacts.show', $product) }}" class="btn btn-primary btn-hover mt-2 flex w-full justify-center text-center no-underline">{{ __('Select options') }}</a>
                        @else
                            <button type="button" data-id="{{ $product->id }}" class="add-to-cart btn btn-primary btn-hover mt-2 w-full">{{ __('Add to cart') }}</button>
                        @endif
                    </div>
                    @empty
                    <div class="col-span-4">
                        <div class="flex items-center justify-center">
                            <h2 class="text-2xl font-bold">No products found</h2>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
@push('scripts')
@include('includes.ajax-requests.cart')
@endpush