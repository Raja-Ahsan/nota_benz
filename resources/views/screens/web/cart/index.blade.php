@extends('layouts.web.master')

@section('content')
<main class="inner-page cart-page bg-[var(--white-color)]">
    <section class="inner-banner inner-banner--compact flex items-center justify-center text-center">
        <div class="container text-left">
            <nav class="inner-banner-breadcrumb text-sm text-white/80" aria-label="{{ __('Breadcrumb') }}">
                <a href="{{ route('artifacts.index') }}" class="underline-offset-2 transition hover:text-white hover:underline">{{ __('Artifacts') }}</a>
                <span class="mx-2 text-white/50" aria-hidden="true">/</span>
                <span class="text-white">{{ __('Cart') }}</span>
            </nav>
        </div>
    </section>

    <section class="cart-section py-10 md:py-14">
        <div class="container">
            @if (! $cart || $cart->items->isEmpty())
            <div class="mx-auto max-w-lg">
                <x-empty-state
                    message="{{ __('Your cart is empty') }}"
                    sub-message="{{ __('Browse artifacts and add something you like.') }}" />
                <div class="mt-8 flex justify-center">
                    <a href="{{ route('artifacts.index') }}" class="btn btn-primary  inline-flex min-w-[200px] justify-center">
                        {{ __('Continue shopping') }}
                    </a>
                </div>
            </div>
            @else
            <div class="grid gap-8 lg:grid-cols-3 lg:gap-10">
                <div class="lg:col-span-2">
                    <div class="mb-6 flex flex-wrap items-end justify-between gap-3 border-b border-neutral-200 pb-4">
                        <h2 class="font-playfair text-2xl font-bold text-[var(--text-color)] md:text-3xl">{{ __('Cart items') }}</h2>
                        <span class="text-sm font-medium uppercase tracking-wide text-neutral-600">
                            {{ $cart->items->sum('qty') }} {{ __('items') }}
                        </span>
                    </div>

                    <div class="-mx-4 overflow-x-auto px-4 sm:mx-0 sm:px-0">
                        <div class="inline-block min-w-full align-middle">
                            <div class="overflow-hidden rounded-xl border border-neutral-200 bg-white shadow-sm">
                                <table class="cart-table w-full min-w-[44rem] border-collapse text-left text-sm text-[var(--text-color)]" role="grid" aria-label="{{ __('Cart items') }}">
                                    <thead>
                                        <tr class="border-b border-neutral-200 bg-neutral-50 manrope-font">
                                            <th scope="col" class="py-3 pl-4 pr-3 text-xs font-semibold uppercase tracking-wide text-neutral-600">{{ __('Product') }}</th>
                                            <th scope="col" class="hidden px-3 py-3 text-xs font-semibold uppercase tracking-wide text-neutral-600 sm:table-cell">{{ __('Unit price') }}</th>
                                            <th scope="col" class="px-3 py-3 text-xs font-semibold uppercase tracking-wide text-neutral-600">{{ __('Quantity') }}</th>
                                            <th scope="col" class="px-3 py-3 text-xs font-semibold uppercase tracking-wide text-neutral-600">{{ __('Line total') }}</th>
                                            <th scope="col" class="py-3 pl-3 pr-4 text-xs font-semibold uppercase tracking-wide text-neutral-600">
                                                <span class="sr-only">{{ __('Actions') }}</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-neutral-200">
                                        @foreach ($cart->items as $item)
                                            @php
                                                $product = $item->product;
                                                $primaryImg = $product?->images?->where('is_primary', 1)->first()
                                                    ?? $product?->images?->first();
                                                $imgSrc = $primaryImg?->publicUrl() ?: asset('assets/images/placeholders/img-not-available.png');
                                            @endphp
                                            <tr id="cart-item-{{ $item->id }}" class="cart-line-item align-middle transition-colors hover:bg-neutral-50/80">
                                                <td class="py-4 pl-4 pr-3 align-middle">
                                                    <div class="flex max-w-md items-start gap-4">
                                                        <a href="{{ $product ? route('artifacts.show', $product) : '#' }}" class="shrink-0">
                                                            <img
                                                                src="{{ $imgSrc }}"
                                                                alt="{{ $product?->name ?? __('Product') }}"
                                                                class="h-20 w-20 rounded-lg object-cover sm:h-[5.5rem] sm:w-[5.5rem]"
                                                                width="88"
                                                                height="88"
                                                                loading="lazy"
                                                            >
                                                        </a>
                                                        <div class="min-w-0">
                                                            <a href="{{ $product ? route('artifacts.show', $product) : '#' }}" class="font-playfair text-base font-semibold text-[var(--text-color)] transition hover:text-[var(--primary-color)] sm:text-lg">
                                                                {{ $product?->name ?? __('Product') }}
                                                            </a>
                                                            @if ($product?->description)
                                                                <p class="mt-1 line-clamp-2 text-xs text-neutral-600 sm:text-sm">
                                                                    {{ \Illuminate\Support\Str::limit(strip_tags($product->description), 140) }}
                                                                </p>
                                                            @endif
                                                            <p class="mt-2 text-xs text-neutral-500 sm:hidden">
                                                                {{ __('Unit price') }}:
                                                                <span class="font-semibold text-[var(--primary-color)]">${{ number_format((float) $item->price, 2) }}</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="hidden whitespace-nowrap px-3 py-4 align-middle font-medium text-[var(--primary-color)] sm:table-cell">
                                                    ${{ number_format((float) $item->price, 2) }}
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 align-middle">
                                                    <div class="inline-flex items-center gap-1 rounded-lg border border-neutral-200 bg-neutral-50 p-1">
                                                        <button
                                                            type="button"
                                                            data-id="{{ $item->id }}"
                                                            class="qty-minus inline-flex h-9 w-9 items-center justify-center rounded-md text-neutral-700 transition hover:bg-white hover:text-[var(--primary-color)]"
                                                            aria-label="{{ __('Decrease quantity') }}"
                                                        >
                                                            <i class="fa-solid fa-minus text-xs" aria-hidden="true"></i>
                                                        </button>
                                                        <span class="min-w-[2.5rem] text-center text-base font-semibold text-[var(--text-color)]" id="qty-{{ $item->id }}">{{ $item->qty }}</span>
                                                        <button
                                                            type="button"
                                                            data-id="{{ $item->id }}"
                                                            class="qty-plus inline-flex h-9 w-9 items-center justify-center rounded-md text-neutral-700 transition hover:bg-white hover:text-[var(--primary-color)]"
                                                            aria-label="{{ __('Increase quantity') }}"
                                                        >
                                                            <i class="fa-solid fa-plus text-xs" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 align-middle">
                                                    <span class="font-playfair text-lg font-bold text-[var(--primary-color)] sm:text-xl" id="item-total-{{ $item->id }}">
                                                        ${{ number_format((float) $item->subtotal, 2) }}
                                                    </span>
                                                </td>
                                                <td class="py-4 pl-3 pr-4 align-middle text-right">
                                                    <button
                                                        type="button"
                                                        class="remove-cart-item inline-flex items-center gap-2 text-sm font-medium text-red-600 transition hover:text-red-700"
                                                        data-id="{{ $item->id }}"
                                                    >
                                                        <i class="fa-solid fa-trash" aria-hidden="true"></i>
                                                        <span class="hidden sm:inline">{{ __('Remove') }}</span>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8">
                        <a href="{{ route('artifacts.index') }}" class="btn border-btn inline-flex items-center gap-2 text-[var(--text-color)]">
                            <i class="fa-solid fa-arrow-left text-sm" aria-hidden="true"></i>
                            {{ __('Continue shopping') }}
                        </a>
                    </div>
                </div>

                <aside class="lg:col-span-1">
                    <div class="sticky top-24 rounded-xl border border-neutral-200 bg-neutral-50 p-6 shadow-sm">
                        <h3 class="font-playfair text-xl font-bold text-[var(--text-color)]">{{ __('Order summary') }}</h3>
                        <div class="mt-6 space-y-4">
                            <div class="flex items-center justify-between text-neutral-700">
                                <span>{{ __('Subtotal') }}</span>
                                <span class="font-semibold text-[var(--text-color)]" id="cart-subtotal">${{ number_format((float) $cart->total(), 2) }}</span>
                            </div>
                            <div class="border-t border-neutral-200 pt-4">
                                <div class="flex items-center justify-between">
                                    <span class="font-playfair text-lg font-semibold text-[var(--text-color)]">{{ __('Total') }}</span>
                                    <span class="font-playfair text-2xl font-bold text-[var(--primary-color)]" id="cart-total">${{ number_format((float) $cart->total(), 2) }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 space-y-3">
                            @auth
                            <a href="{{ route('checkout') }}" class="btn btn-primary btn-hover flex w-full justify-center py-3 text-center">
                                <i class="fa-solid fa-credit-card me-2" aria-hidden="true"></i>
                                {{ __('Proceed to checkout') }}
                            </a>
                            @else
                            <a href="{{ route('login') }}" class="btn btn-primary flex w-full justify-center py-3 text-center">
                                <i class="fa-solid fa-right-to-bracket me-2" aria-hidden="true"></i>
                                {{ __('Log in to checkout') }}
                            </a>
                            @endauth
                            <a href="{{ route('artifacts.index') }}" class="btn border-btn flex w-full justify-center py-3 text-center">
                                {{ __('Continue shopping') }}
                            </a>
                        </div>

                        <div class="mt-8 border-t border-neutral-200 pt-6 text-sm text-neutral-600">
                            <p class="flex items-center gap-2">
                                <i class="fa-solid fa-shield-halved text-[var(--primary-color)]" aria-hidden="true"></i>
                                {{ __('Secure checkout') }}
                            </p>
                            <p class="mt-2 flex items-center gap-2">
                                <i class="fa-solid fa-truck text-[var(--primary-color)]" aria-hidden="true"></i>
                                {{ __('Fast delivery') }}
                            </p>
                        </div>
                    </div>
                </aside>
            </div>
            @endif
        </div>
    </section>
</main>
@endsection

@push('scripts')
@include('includes.ajax-requests.cart')
@endpush