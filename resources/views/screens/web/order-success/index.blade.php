@extends('layouts.web.master')
@section('title', 'Order Success')
@section('content')

    <section class="inner-banner about-banner">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="hd-lg">Order Confirmed</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="w-full bg-[var(--bg-color)] py-[40px] pb-[64px] md:py-[48px] md:pb-[80px]">
        <div class="mx-auto w-full max-w-[1280px] px-[16px] sm:px-[24px]">
            <div class="mx-auto w-full max-w-[720px]">
                {{-- Main card --}}
                <div
                    class="order-success-card rounded-[16px] border-[1px] border-[rgba(28,84,136,0.12)] bg-white p-[32px] text-center shadow-[0_8px_30px_rgba(12,79,159,0.08)] md:p-[40px]">
                    {{-- Success icon (sizes fixed in app.css so global svg rules cannot stretch it) --}}
                    <div class="order-success-icon-wrap mb-[24px] text-white">
                        <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>

                    <h2 class="style-poppines mb-[12px] text-[26px] font-bold leading-tight text-[var(--text-color)] md:text-[32px]">
                        Thank you!
                    </h2>
                    <p class="style-inter mb-[8px] text-[16px] leading-[1.5] text-[#555555]">
                        Your order has been placed successfully.
                    </p>
                    <p class="style-inter mb-[24px] text-[15px] leading-[1.5] text-[#777777]">
                        We appreciate your business. You can view your order details anytime from your account.
                    </p>

                    {{-- Order meta --}}
                    <div
                        class="mb-[28px] rounded-[12px] border-[1px] border-[rgba(28,84,136,0.1)] bg-[rgba(11,79,159,0.06)] px-[20px] py-[18px]">
                        <p class="style-inter mb-[6px] text-[13px] font-medium uppercase tracking-[0.5px] text-[#666666]">
                            Order number
                        </p>
                        <p class="style-poppines text-[24px] font-bold text-[var(--primary-color)] md:text-[28px]">
                            #{{ $order->id }}
                        </p>
                        <p class="style-inter mt-[12px] text-[16px] font-semibold text-[var(--text-color)]">
                            Total paid:
                            <span class="text-[var(--primary-color)]">${{ number_format((float) $order->total, 2) }}</span>
                        </p>
                        @if (filled($order->order_status ?? null))
                            <p class="style-inter mt-[10px] text-[14px] text-[#555555]">
                                Status:
                                <span class="font-semibold capitalize text-[var(--primary-color)]">{{ $order->order_status }}</span>
                            </p>
                        @endif
                    </div>

                    <a href="{{ route('orders.show', $order) }}"
                        class="btn btn-primary btn-hover">
                        View order details
                    </a>
                </div>

                {{-- Secondary actions --}}
                <div
                    class="order-success-actions mt-[24px] flex w-full max-w-[720px] flex-col items-stretch gap-[12px] sm:mx-auto sm:flex-row sm:items-center sm:justify-center">
                    <a href="{{ route('artifacts.index') }}"
                        class="btn btn-primary btn-hover">
                        <span class="mr-2"><i class="fa-solid fa-bag-shopping"></i></span>
                        Continue shopping
                    </a>
                    <a href="{{ route('home') }}"
                        class="btn btn-primary btn-hover">
                        <span class="mr-2"><i class="fa-regular fa-house"></i></span>
                        Back to home
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection
