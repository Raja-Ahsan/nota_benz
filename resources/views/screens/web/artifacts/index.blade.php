@extends('layouts.web.master')

@section('content')
<main class="inner-page artifacts-page">
    <section class="inner-banner flex items-center justify-center text-center">
        <div class="container">
            <h1 class="inner-banner-hd">Artifacts</h1>
        </div>
    </section>
    <section class="artifacts-sec py-10">
        <div class="grid grid-cols-6 gap-6 px-3">
            <aside class="artifacts-filter col-span-6 md:col-span-1">
                <form
                    id="artifacts-filter-form"
                    class="flex flex-col gap-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm"
                    data-filter-url="{{ route('artifacts.filter') }}"
                    action="{{ route('artifacts.filter') }}"
                    method="get"
                    novalidate>
                    <div class="flex items-center justify-between gap-2">
                        <h2 class="text-lg font-semibold">{{ __('Filters') }}</h2>
                        <button type="button" id="artifacts-filter-clear" class="text-sm text-[var(--primary-color)] underline-offset-2 hover:underline">
                            {{ __('Clear') }}
                        </button>
                    </div>

                    <label class="flex flex-col gap-1 text-sm font-medium text-gray-700">
                        {{ __('Search') }}
                        <input
                            type="search"
                            name="search"
                            value="{{ request('search') }}"
                            autocomplete="off"
                            class="rounded border border-gray-300 px-3 py-2 text-base font-normal"
                            placeholder="{{ __('Name…') }}">
                    </label>

                    <label class="flex flex-col gap-1 text-sm font-medium text-gray-700">
                        {{ __('Category') }}
                        <select name="category_id" class="rounded border border-gray-300 px-3 py-2 text-base font-normal">
                            <option value="">{{ __('All categories') }}</option>
                            @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" @selected((string) request('category_id')===(string) $cat->id)>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </label>

                    <label class="flex flex-col gap-1 text-sm font-medium text-gray-700">
                        {{ __('Product type') }}
                        <select name="type" class="rounded border border-gray-300 px-3 py-2 text-base font-normal">
                            <option value="all" @selected(request('type', 'all' )==='all' )>{{ __('All') }}</option>
                            <option value="simple" @selected(request('type')==='simple' )>{{ __('Simple') }}</option>
                            <option value="variable" @selected(request('type')==='variable' )>{{ __('Variable') }}</option>
                        </select>
                    </label>

                    <fieldset class="flex flex-col gap-2 border-0 p-0">
                        <legend class="text-sm font-medium text-gray-700">{{ __('Price (USD)') }}</legend>
                        <div class="grid grid-cols-2 gap-2">
                            <label class="flex flex-col gap-1 text-xs text-gray-600">
                                {{ __('Min') }}
                                <input type="number" name="price_min" min="0" step="0.01" value="{{ request('price_min') }}" class="rounded border border-gray-300 px-2 py-2 text-sm">
                            </label>
                            <label class="flex flex-col gap-1 text-xs text-gray-600">
                                {{ __('Max') }}
                                <input type="number" name="price_max" min="0" step="0.01" value="{{ request('price_max') }}" class="rounded border border-gray-300 px-2 py-2 text-sm">
                            </label>
                        </div>
                    </fieldset>

                    <p class="text-xs text-gray-500">
                        {{ __('Showing') }}
                        <span data-artifacts-count>{{ $products->total() }}</span>
                        {{ __('results') }}
                    </p>
                </form>
            </aside>

            <div class="col-span-6 md:col-span-5">
                <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4 transition-opacity" data-artifacts-grid>
                    @include('screens.web.artifacts.partials.product-grid', ['products' => $products])
                </div>

                @if ($products->hasMorePages())
                    <div class="mt-10 text-center">
                        <button
                            type="button"
                            class="btn btn-primary load-more-btn"
                            data-artifacts-load-more
                            data-page="{{ $products->currentPage() + 1 }}"
                            data-last-page="{{ $products->lastPage() }}"
                            data-url="{{ route('artifacts.filter') }}"
                        >
                            {{ __('Load More') }}
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </section>
</main>
@endsection
@push('scripts')
@include('includes.ajax-requests.cart')
@endpush