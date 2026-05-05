{{-- Admin: aggregate storefront metrics. Staff: personal order summary. --}}

@extends('layouts.admin.master')
@section('title', __('Dashboard'))

@section('content')
<div class="container-fluid row-gap-20 default-dashboard">
    @if ($isAdmin ?? false)
    <div class="row widget-grid">
        <div class="col-xxl-auto col-xl-3 col-sm-6 box-col-3">
            <a href="{{ route('users.index') }}">
            <div class="card widget-1">
                <div class="card-body">
                    <div class="widget-content">
                        <div class="widget-round secondary">
                            <div class="bg-round">
                                <svg aria-hidden="true">
                                    <use href="{{ asset('/assets/libs/svg/icon-sprite.svg#c-customer') }}"></use>
                                </svg>
                                <svg class="half-circle svg-fill" aria-hidden="true">
                                    <use href="{{ asset('/assets/libs/svg/icon-sprite.svg#halfcircle') }}"></use>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <span class="f-light">{{ __('Total users') }}</span>
                            <h4 class="mb-0">
                                <span>{{ number_format((int) ($stats['totalUsers'] ?? 0)) }}</span>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>
        <div class="col-xxl-auto col-xl-3 col-sm-6 box-col-3">
            <a href="{{ route('orders.index') }}">
            <div class="card widget-1">
                <div class="card-body">
                    <div class="widget-content">
                        <div class="widget-round secondary">
                            <div class="bg-round">
                                <svg aria-hidden="true">
                                    <use href="{{ asset('/assets/libs/svg/icon-sprite.svg#c-invoice') }}"></use>
                                </svg>
                                <svg class="half-circle svg-fill" aria-hidden="true">
                                    <use href="{{ asset('/assets/libs/svg/icon-sprite.svg#halfcircle') }}"></use>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <span class="f-light">{{ __('Total orders') }}</span>
                            <h4 class="mb-0">
                                <span>{{ number_format((int) ($stats['totalOrders'] ?? 0)) }}</span>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>
        <div class="col-xxl-auto col-xl-3 col-sm-6 box-col-3">
            <a href="{{ route('products.index') }}">
            <div class="card widget-1">
                <div class="card-body">
                    <div class="widget-content">
                        <div class="widget-round secondary">
                            <div class="bg-round">
                                <svg aria-hidden="true">
                                    <use href="{{ asset('/assets/libs/svg/icon-sprite.svg#c-revenue') }}"></use>
                                </svg>
                                <svg class="half-circle svg-fill" aria-hidden="true">
                                    <use href="{{ asset('/assets/libs/svg/icon-sprite.svg#halfcircle') }}"></use>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <span class="f-light">{{ __('Total products') }}</span>
                            <h4 class="mb-0">
                                <span>{{ number_format((int) ($stats['totalProducts'] ?? 0)) }}</span>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>
        <div class="col-xxl-auto col-xl-3 col-sm-6 box-col-3">
            <a href="{{ route('product-categories.index') }}">
                <div class="card widget-1">
                    <div class="card-body">
                        <div class="widget-content">
                            <div class="widget-round secondary">
                                <div class="bg-round">
                                    <svg aria-hidden="true">
                                        <use href="{{ asset('/assets/libs/svg/icon-sprite.svg#c-profit') }}"></use>
                                    </svg>
                                    <svg class="half-circle svg-fill" aria-hidden="true">
                                        <use href="{{ asset('/assets/libs/svg/icon-sprite.svg#halfcircle') }}"></use>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <span class="f-light">{{ __('Total categories') }}</span>
                                <h4 class="mb-0">
                                    <span>{{ number_format((int) ($stats['totalCategories'] ?? 0)) }}</span>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    @else
    <div class="row widget-grid">
        <div class="col-xxl-auto col-xl-4 col-lg-6 col-sm-12 box-col-12">
            <a href="{{ route('orders.index') }}">
                <div class="card widget-1">
                    <div class="card-body">
                        <div class="widget-content flex-wrap gap-3">
                            <div class="widget-round secondary">
                                <div class="bg-round">
                                    <svg aria-hidden="true">
                                        <use href="{{ asset('/assets/libs/svg/icon-sprite.svg#c-invoice') }}"></use>
                                    </svg>
                                    <svg class="half-circle svg-fill" aria-hidden="true">
                                        <use href="{{ asset('/assets/libs/svg/icon-sprite.svg#halfcircle') }}"></use>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <span class="f-light">{{ __('My orders') }}</span>
                                <h4 class="mb-1">
                                    <span>{{ number_format((int) ($stats['myOrdersCount'] ?? 0)) }}</span>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    @endif
</div>
@endsection