@forelse ($products as $product)
    <div class="products-card-wrapper">
        <a
            href="{{ route('artifacts.show', $product) }}"
            class="product-card-link block text-inherit no-underline transition-opacity hover:opacity-90 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[var(--primary-color)]"
        >
            <div class="image-wrapper mb-2">
                @php
                    $image = $product->images->where('is_primary', 1)->first() ?? $product->images->first();
                    $imageSrc = $image?->publicUrl() ?: asset('assets/images/placeholders/img-not-available.png');
                @endphp

                <img
                    src="{{ $imageSrc }}"
                    class="product-image"
                    alt="{{ $product->name }}">
            </div>
            <div class="content-wrapper flex flex-col gap-2">
                <h3 class="product-title">{{ $product->name }}</h3>
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
    <div class="col-span-4 py-12 text-center">
        <p class="text-lg text-gray-600">{{ __('No products match your filters.') }}</p>
    </div>
@endforelse
