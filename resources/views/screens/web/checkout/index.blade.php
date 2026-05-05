@extends('layouts.web.master')

@section('title', __('Checkout'))

@section('content')
    @php
        $inputClass =
            'manrope-font w-full rounded-lg border border-neutral-300 bg-white px-3 py-2.5 text-sm text-[var(--text-color)] shadow-none outline-none transition placeholder:text-neutral-400 focus:border-[var(--primary-color)] focus:ring-2 focus:ring-[var(--primary-color)]/25 sm:text-[15px]';
        $labelClass = 'manrope-font mb-2 block text-sm font-medium text-[var(--text-color)]';
        $cardWrap = 'rounded-xl border border-neutral-200 bg-white p-6 shadow-sm md:p-8';
        $sectionTitle = 'font-playfair mb-6 text-xl font-bold text-[var(--text-color)] md:text-2xl';
    @endphp

    <main class="inner-page checkout-page bg-[var(--white-color)]">
        <section class="inner-banner inner-banner--compact flex items-center justify-center text-center">
            <div class="container text-left">
                <nav class="inner-banner-breadcrumb text-sm text-white/80" aria-label="{{ __('Breadcrumb') }}">
                    <a href="{{ route('artifacts.index') }}" class="underline-offset-2 transition hover:text-white hover:underline">{{ __('Artifacts') }}</a>
                    <span class="mx-2 text-white/50" aria-hidden="true">/</span>
                    <a href="{{ route('cart.index') }}" class="underline-offset-2 transition hover:text-white hover:underline">{{ __('Cart') }}</a>
                    <span class="mx-2 text-white/50" aria-hidden="true">/</span>
                    <span class="text-white">{{ __('Checkout') }}</span>
                </nav>
            </div>
        </section>

        <section class="checkout-section py-10 md:py-14">
            <div class="container">
                <form id="submit-form" method="POST" action="{{ route('checkout.place-order') }}" novalidate>
                    @csrf
                    <input type="hidden" name="payment_intent_id" id="payment_intent_id">

                    <div class="grid gap-8 lg:grid-cols-3 lg:gap-10 lg:items-start">
                        <div class="lg:col-span-2 space-y-8">
                            <div class="{{ $cardWrap }}">
                                <h2 class="{{ $sectionTitle }}">{{ __('Billing information') }}</h2>
                                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                                    @guest
                                        <p class="md:col-span-2 text-sm leading-relaxed text-neutral-600">
                                            {{ __('We’ll use your email for order updates. If you don’t have an account yet, we’ll create one for you and send login details to this address.') }}
                                        </p>
                                    @endguest
                                    <div>
                                        <label for="name" class="{{ $labelClass }}">{{ __('Full name') }}</label>
                                        <input
                                            type="text"
                                            id="name"
                                            name="billing_name"
                                            class="{{ $inputClass }}"
                                            placeholder="{{ __('Enter full name') }}"
                                            required
                                            value="{{ old('billing_name', $user->name ?? '') }}"
                                        >
                                    </div>
                                    <div>
                                        <label for="email" class="{{ $labelClass }}">{{ __('Email address') }}</label>
                                        <input
                                            type="email"
                                            id="email"
                                            name="billing_email"
                                            value="{{ old('billing_email', $user->email ?? '') }}"
                                            class="{{ $inputClass }}"
                                            placeholder="{{ __('Enter email') }}"
                                            required
                                        >
                                    </div>
                                    <div class="md:col-span-2">
                                        <label for="phone" class="{{ $labelClass }}">{{ __('Phone number') }}</label>
                                        <input
                                            type="tel"
                                            id="phone"
                                            name="billing_phone"
                                            value="{{ old('billing_phone') }}"
                                            class="{{ $inputClass }}"
                                            placeholder="{{ __('Enter phone') }}"
                                            required
                                        >
                                    </div>
                                    <div class="md:col-span-2">
                                        <label for="address" class="{{ $labelClass }}">{{ __('Street address') }}</label>
                                        <input
                                            type="text"
                                            id="address"
                                            name="billing_address"
                                            class="{{ $inputClass }}"
                                            placeholder="{{ __('Enter street address') }}"
                                            value="{{ old('billing_address') }}"
                                            required
                                        >
                                    </div>
                                    <div>
                                        <label for="city" class="{{ $labelClass }}">{{ __('City') }}</label>
                                        <input
                                            type="text"
                                            id="city"
                                            name="billing_city"
                                            class="{{ $inputClass }}"
                                            placeholder="{{ __('Enter city') }}"
                                            value="{{ old('billing_city') }}"
                                            required
                                        >
                                    </div>
                                    <div>
                                        <label for="state" class="{{ $labelClass }}">{{ __('State') }}</label>
                                        <input
                                            type="text"
                                            id="state"
                                            name="billing_state"
                                            class="{{ $inputClass }}"
                                            placeholder="{{ __('Enter state') }}"
                                            value="{{ old('billing_state') }}"
                                            required
                                        >
                                    </div>
                                    <div>
                                        <label for="zipCode" class="{{ $labelClass }}">{{ __('ZIP code') }}</label>
                                        <input
                                            type="text"
                                            id="zipCode"
                                            name="billing_zip"
                                            class="{{ $inputClass }}"
                                            placeholder="{{ __('Digits only, e.g. 12345') }}"
                                            value="{{ old('billing_zip') }}"
                                            required
                                            inputmode="numeric"
                                            autocomplete="postal-code"
                                            maxlength="10"
                                            pattern="[0-9]{3,10}"
                                            title="{{ __('Digits only (3–10 characters)') }}"
                                        >
                                    </div>
                                    <div>
                                        <label for="country" class="{{ $labelClass }}">{{ __('Country') }}</label>
                                        <input
                                            type="text"
                                            id="country"
                                            name="billing_country"
                                            class="{{ $inputClass }}"
                                            placeholder="{{ __('Enter country') }}"
                                            value="{{ old('billing_country') }}"
                                            required
                                        >
                                    </div>
                                </div>
                            </div>

                            <div class="{{ $cardWrap }}">
                                <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                                    <h2 class="{{ $sectionTitle }} mb-0">{{ __('Shipping information') }}</h2>
                                    <div class="flex items-center gap-2.5">
                                        <input
                                            class="h-4 w-4 shrink-0 cursor-pointer rounded border-neutral-300 text-[var(--primary-color)] focus:ring-[var(--primary-color)]"
                                            name="same_as_billing"
                                            type="checkbox"
                                            id="same_as_billing"
                                            checked
                                        >
                                        <label class="manrope-font cursor-pointer text-sm text-[var(--text-color)]" for="same_as_billing">{{ __('Same as billing') }}</label>
                                    </div>
                                </div>
                                <div id="shipping_form" class="hidden">
                                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                                        <div>
                                            <label for="shippingFirstName" class="{{ $labelClass }}">{{ __('Full name') }}</label>
                                            <input type="text" id="shippingFirstName" name="shipping_name" class="{{ $inputClass }}" placeholder="{{ __('Enter full name') }}" value="{{ old('shipping_name') }}">
                                        </div>
                                        <div>
                                            <label for="shippingPhone" class="{{ $labelClass }}">{{ __('Phone number') }}</label>
                                            <input type="tel" id="shippingPhone" name="shipping_phone" class="{{ $inputClass }}" placeholder="{{ __('Enter phone') }}" value="{{ old('shipping_phone') }}">
                                        </div>
                                        <div class="md:col-span-2">
                                            <label for="shippingAddress" class="{{ $labelClass }}">{{ __('Street address') }}</label>
                                            <input type="text" id="shippingAddress" name="shipping_address" class="{{ $inputClass }}" placeholder="{{ __('Enter street address') }}" value="{{ old('shipping_address') }}">
                                        </div>
                                        <div>
                                            <label for="shippingCity" class="{{ $labelClass }}">{{ __('City') }}</label>
                                            <input type="text" id="shippingCity" name="shipping_city" class="{{ $inputClass }}" placeholder="{{ __('Enter city') }}" value="{{ old('shipping_city') }}">
                                        </div>
                                        <div>
                                            <label for="shippingState" class="{{ $labelClass }}">{{ __('State') }}</label>
                                            <input type="text" id="shippingState" name="shipping_state" class="{{ $inputClass }}" placeholder="{{ __('Enter state') }}" value="{{ old('shipping_state') }}">
                                        </div>
                                        <div>
                                            <label for="shippingZipCode" class="{{ $labelClass }}">{{ __('ZIP code') }}</label>
                                            <input
                                                type="text"
                                                id="shippingZipCode"
                                                name="shipping_zip"
                                                class="{{ $inputClass }}"
                                                placeholder="{{ __('Digits only, e.g. 12345') }}"
                                                value="{{ old('shipping_zip') }}"
                                                inputmode="numeric"
                                                autocomplete="shipping postal-code"
                                                maxlength="10"
                                                pattern="[0-9]{3,10}"
                                                title="{{ __('Digits only (3–10 characters)') }}"
                                            >
                                        </div>
                                        <div>
                                            <label for="shippingCountry" class="{{ $labelClass }}">{{ __('Country') }}</label>
                                            <input type="text" id="shippingCountry" name="shipping_country" class="{{ $inputClass }}" placeholder="{{ __('Enter country') }}" value="{{ old('shipping_country') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="{{ $cardWrap }}">
                                <h2 class="{{ $sectionTitle }}">{{ __('Payment method') }}</h2>
                                <div class="flex items-center gap-3">
                                    <input
                                        class="h-4 w-4 shrink-0 cursor-pointer border-neutral-300 text-[var(--primary-color)] focus:ring-[var(--primary-color)]"
                                        type="radio"
                                        name="paymentMethod"
                                        id="paymentCard"
                                        value="card"
                                        checked
                                    >
                                    <label class="manrope-font flex cursor-pointer items-center gap-3 text-[var(--text-color)]" for="paymentCard">
                                        <i class="fa-solid fa-credit-card text-xl text-[var(--primary-color)]" aria-hidden="true"></i>
                                        <span>{{ __('Stripe payment') }}</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <aside class="lg:col-span-1">
                            <div class="sticky top-24 rounded-xl border border-neutral-200 bg-neutral-50 p-6 shadow-sm">
                                <h3 class="font-playfair text-xl font-bold text-[var(--text-color)]">{{ __('Order summary') }}</h3>

                                <ul class="mt-6 divide-y divide-neutral-200">
                                    @foreach ($checkout->items as $item)
                                        @php
                                            $product = $item->product;
                                            $primaryImg = $product?->images?->where('is_primary', 1)->first()
                                                ?? $product?->images?->first();
                                            $imgSrc = $primaryImg?->publicUrl() ?: asset('assets/images/placeholders/img-not-available.png');
                                        @endphp
                                        <li class="flex gap-4 py-4 first:pt-0">
                                            <div class="h-16 w-16 shrink-0 overflow-hidden rounded-lg border border-neutral-200 bg-white">
                                                <img src="{{ $imgSrc }}" alt="{{ $product?->name ?? __('Product') }}" class="h-full w-full object-cover" loading="lazy" width="64" height="64">
                                            </div>
                                            <div class="min-w-0 flex-1">
                                                <p class="font-playfair text-sm font-semibold text-[var(--text-color)] sm:text-base">{{ $product?->name ?? __('Product') }}</p>
                                                <p class="mt-1 text-xs text-neutral-600">{{ __('Qty') }}: {{ $item->qty }}</p>
                                                @if ($item->qty > 1)
                                                    <p class="mt-0.5 text-xs text-neutral-500">{{ __('Unit') }}: ${{ number_format((float) $item->price, 2) }}</p>
                                                @endif
                                            </div>
                                            <span class="shrink-0 font-playfair text-sm font-bold text-[var(--primary-color)] sm:text-base">${{ number_format((float) $item->subtotal, 2) }}</span>
                                        </li>
                                    @endforeach
                                </ul>

                                <div class="mt-4 space-y-3 border-t border-neutral-200 pt-4">
                                    <div class="flex items-center justify-between text-neutral-700">
                                        <span>{{ __('Subtotal') }}</span>
                                        <span class="font-semibold text-[var(--text-color)]">${{ number_format((float) $checkout->total(), 2) }}</span>
                                    </div>
                                    <div class="border-t border-neutral-200 pt-4">
                                        <div class="flex items-center justify-between">
                                            <span class="font-playfair text-lg font-semibold text-[var(--text-color)]">{{ __('Total') }}</span>
                                            <span class="font-playfair text-2xl font-bold text-[var(--primary-color)]">${{ number_format((float) $checkout->total(), 2) }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-6 space-y-3">
                                    @include('includes.web.stripe-card')
                                    <button type="button" id="submit-btn" class="btn btn-primary btn-hover flex w-full justify-center gap-2 py-3 text-center disabled:cursor-not-allowed disabled:opacity-60">
                                        <i class="fa-solid fa-lock" aria-hidden="true"></i>
                                        <span id="submit-btn-label">{{ __('Place order') }}</span>
                                    </button>
                                    <a href="{{ route('cart.index') }}" class="btn border-btn flex w-full justify-center gap-2 py-3 text-center text-[var(--text-color)]">
                                        <i class="fa-solid fa-arrow-left text-sm" aria-hidden="true"></i>
                                        {{ __('Back to cart') }}
                                    </a>
                                </div>

                                <div class="mt-8 border-t border-neutral-200 pt-6 text-sm text-neutral-600">
                                    <p class="flex items-center gap-2">
                                        <i class="fa-solid fa-shield-halved text-[var(--primary-color)]" aria-hidden="true"></i>
                                        {{ __('Secure payment') }}
                                    </p>
                                    <p class="mt-2 flex items-center gap-2">
                                        <i class="fa-solid fa-lock text-[var(--primary-color)]" aria-hidden="true"></i>
                                        {{ __('Your information is safe') }}
                                    </p>
                                </div>
                            </div>
                        </aside>
                    </div>
                </form>
            </div>
        </section>
    </main>
@endsection

@push('scripts')
    <script>
        (function () {
            const sameAs = document.getElementById('same_as_billing');
            const shippingForm = document.getElementById('shipping_form');
            if (!sameAs || !shippingForm) return;

            function syncShippingVisibility() {
                if (sameAs.checked) {
                    shippingForm.classList.add('hidden');
                } else {
                    shippingForm.classList.remove('hidden');
                }
            }

            sameAs.addEventListener('change', syncShippingVisibility);
            syncShippingVisibility();
        })();

        (function () {
            ['zipCode', 'shippingZipCode'].forEach(function (id) {
                const el = document.getElementById(id);
                if (!el) return;
                el.addEventListener('input', function () {
                    el.value = el.value.replace(/\D/g, '').slice(0, 10);
                });
                el.addEventListener('blur', function () {
                    el.value = el.value.replace(/\D/g, '').slice(0, 10);
                });
            });
        })();

        const submitFormEl = document.getElementById("submit-form");
        if (submitFormEl) {
            submitFormEl.addEventListener("submit", function (e) {
                e.preventDefault();
            });
        }

        let clientSecret = null;
        let lastSucceededPaymentIntentId = null;
        let initPaymentInFlight = null;

        function normalizeZipInputs() {
            ['zipCode', 'shippingZipCode'].forEach(function (id) {
                const el = document.getElementById(id);
                if (el) {
                    el.value = el.value.replace(/\D/g, '').slice(0, 10);
                }
            });
        }

        function isZipDigitsOnly(value) {
            const z = String(value || "").trim();
            return /^[0-9]{3,10}$/.test(z);
        }

        function validateCheckoutForm() {
            normalizeZipInputs();

            const form = document.getElementById("submit-form");
            if (form && !form.reportValidity()) {
                return false;
            }

            const billingZip = document.getElementById("zipCode");
            if (!isZipDigitsOnly(billingZip?.value)) {
                Swal.fire(
                    @json(__('Check your details')),
                    @json(__('ZIP / postal code must contain digits only (3–10 characters).')),
                    "warning"
                );
                billingZip?.focus();
                return false;
            }

            const sameAs = document.getElementById("same_as_billing");
            if (sameAs && !sameAs.checked) {
                const shipFields = [
                    ["shippingFirstName", @json(__('Shipping full name'))],
                    ["shippingPhone", @json(__('Shipping phone'))],
                    ["shippingAddress", @json(__('Shipping address'))],
                    ["shippingCity", @json(__('Shipping city'))],
                    ["shippingState", @json(__('Shipping state'))],
                    ["shippingZipCode", @json(__('Shipping ZIP'))],
                    ["shippingCountry", @json(__('Shipping country'))],
                ];
                for (const [id, label] of shipFields) {
                    const el = document.getElementById(id);
                    if (!el || !String(el.value).trim()) {
                        Swal.fire(@json(__('Check your details')), @json(__('Please complete: ')) + label, "warning");
                        el?.focus();
                        return false;
                    }
                }
                const sz = document.getElementById("shippingZipCode");
                if (!isZipDigitsOnly(sz?.value)) {
                    Swal.fire(
                        @json(__('Check your details')),
                        @json(__('Shipping ZIP must contain digits only (3–10 characters).')),
                        "warning"
                    );
                    sz?.focus();
                    return false;
                }
            }

            return true;
        }

        async function initPayment() {
            if (initPaymentInFlight) {
                return initPaymentInFlight;
            }

            initPaymentInFlight = (async function () {
                try {
                    const response = await fetch("{{ route('checkout.payment-intent') }}", {
                        method: "POST",
                        credentials: "same-origin",
                        headers: {
                            "Content-Type": "application/json",
                            "Accept": "application/json",
                            "X-Requested-With": "XMLHttpRequest",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        },
                    });

                    const raw = await response.text();
                    let data = null;
                    try {
                        data = raw ? JSON.parse(raw) : null;
                    } catch (e) {
                        Swal.fire(
                            @json(__('Error')),
                            @json(__('Checkout could not start. Please refresh the page and try again.')),
                            "error"
                        );
                        return false;
                    }

                    if (!response.ok || !data?.clientSecret) {
                        Swal.fire(
                            @json(__('Error')),
                            data?.message || @json(__('Payment could not be initialized. Try again or contact support.')),
                            "error"
                        );
                        return false;
                    }

                    clientSecret = data.clientSecret;
                    lastSucceededPaymentIntentId = null;
                    return true;
                } catch (e) {
                    Swal.fire(@json(__('Error')), @json(__('Network error. Check your connection and try again.')), "error");
                    return false;
                }
            })();

            try {
                return await initPaymentInFlight;
            } finally {
                initPaymentInFlight = null;
            }
        }

        initPayment();

        function placeOrderPayload(paymentIntentId) {
            const sameAs = document.getElementById("same_as_billing")?.checked;
            const base = {
                _token: "{{ csrf_token() }}",
                payment_intent_id: paymentIntentId,
                billing_name: $("#name").val(),
                billing_email: $("#email").val(),
                billing_phone: $("#phone").val(),
                billing_address: $("#address").val(),
                billing_city: $("#city").val(),
                billing_state: $("#state").val(),
                billing_zip: $("#zipCode").val(),
                billing_country: $("#country").val(),
            };
            if (sameAs) {
                return Object.assign({}, base, {
                    shipping_name: $("#name").val(),
                    shipping_email: $("#email").val(),
                    shipping_phone: $("#phone").val(),
                    shipping_address: $("#address").val(),
                    shipping_city: $("#city").val(),
                    shipping_state: $("#state").val(),
                    shipping_zip: $("#zipCode").val(),
                    shipping_country: $("#country").val(),
                });
            }
            return Object.assign({}, base, {
                shipping_name: $("#shippingFirstName").val(),
                shipping_email: "",
                shipping_phone: $("#shippingPhone").val(),
                shipping_address: $("#shippingAddress").val(),
                shipping_city: $("#shippingCity").val(),
                shipping_state: $("#shippingState").val(),
                shipping_zip: $("#shippingZipCode").val(),
                shipping_country: $("#shippingCountry").val(),
            });
        }

        function placeOrderAjax(btn, btnLabel, paymentIntentId) {
            $.ajax({
                url: "{{ route('checkout.place-order') }}",
                method: "POST",
                dataType: "json",
                headers: {
                    Accept: "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                },
                data: placeOrderPayload(paymentIntentId),
                beforeSend: function () {
                    btn.disabled = true;
                    btnLabel.textContent = @json(__('Placing order…'));
                },
                success: function (res) {
                    lastSucceededPaymentIntentId = null;
                    if (res.login_required && res.redirect_url) {
                        Swal.fire({
                            title: @json(__('Order placed')),
                            text: res.message || @json(__('Sign in to view your order confirmation.')),
                            icon: "success",
                            confirmButtonText: @json(__('Continue')),
                        }).then(() => {
                            window.location.href = res.redirect_url;
                        });
                        return;
                    }
                    Swal.fire({
                        title: @json(__('Order placed')),
                        text: @json(__('Your order has been placed successfully.')),
                        icon: "success",
                        confirmButtonText: @json(__('Continue')),
                    }).then(() => {
                        window.location.href = @json(url('/order-success')).replace(/\/$/, "") + "/" + res.order_id;
                    });
                },
                complete: function () {
                    btnLabel.textContent = @json(__('Place order'));
                    btn.disabled = false;
                },
                error: function (xhr) {
                    let msg = @json(__('Something went wrong'));
                    if (xhr.status === 422 && xhr.responseJSON?.errors) {
                        const errs = Object.values(xhr.responseJSON.errors).flat();
                        msg = errs.join("\n");
                        Swal.fire(@json(__('Check your details')), msg, "warning");
                    } else if (xhr.responseJSON?.message) {
                        msg = xhr.responseJSON.message;
                        Swal.fire(@json(__('Order failed')), msg, "error");
                    } else {
                        Swal.fire(@json(__('Order failed')), msg, "error");
                    }
                },
            });
        }

        document.getElementById("submit-btn").addEventListener("click", async function () {
            const btn = this;
            const btnLabel = document.getElementById("submit-btn-label");

            if (!validateCheckoutForm()) {
                return;
            }

            btn.disabled = true;

            if (!clientSecret && !lastSucceededPaymentIntentId) {
                btnLabel.textContent = @json(__('Preparing payment…'));
                const ready = await initPayment();
                btnLabel.textContent = @json(__('Place order'));
                if (!ready || !clientSecret) {
                    btn.disabled = false;
                    return;
                }
            }

            let paymentIntentId = lastSucceededPaymentIntentId;

            if (!paymentIntentId) {
                const result = await stripe.confirmCardPayment(clientSecret, {
                    payment_method: {
                        card: card,
                        billing_details: {
                            name: document.getElementById("name").value,
                            email: document.getElementById("email").value,
                        },
                    },
                });

                if (result.error) {
                    const rawPi = result.error.payment_intent;
                    const erroredPiId = typeof rawPi === "string" ? rawPi : rawPi && rawPi.id;
                    const stripeSaysSucceeded =
                        typeof rawPi === "object" && rawPi && rawPi.status === "succeeded";
                    const likelyAlreadyConfirmed =
                        result.error.code === "payment_intent_unexpected_state";
                    if (erroredPiId && (stripeSaysSucceeded || likelyAlreadyConfirmed)) {
                        paymentIntentId = erroredPiId;
                        lastSucceededPaymentIntentId = paymentIntentId;
                    } else {
                        Swal.fire(@json(__('Payment failed')), result.error.message, "error");
                        btn.disabled = false;
                        await initPayment();
                        return;
                    }
                } else if (result.paymentIntent.status !== "succeeded") {
                    Swal.fire(@json(__('Payment failed')), @json(__('Payment was not completed.')), "error");
                    btn.disabled = false;
                    await initPayment();
                    return;
                } else {
                    paymentIntentId = result.paymentIntent.id;
                    lastSucceededPaymentIntentId = paymentIntentId;
                }
            }

            placeOrderAjax(btn, btnLabel, paymentIntentId);
        });
    </script>
@endpush
