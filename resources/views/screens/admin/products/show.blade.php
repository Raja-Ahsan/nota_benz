@section('title', $product->name)
@extends('layouts.admin.master')
@section('content')
<div class="container-fluid">
    <div class="edit-profile">
        <div class="card">
            <div class="card-header">
                <div class="card-options">
                    <a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i
                            class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#"
                        data-bs-toggle="card-remove"><i class="fe fe-x"></i></a>
                </div>
            </div>
            <div class="card-body">
                <fieldset disabled class="border-0 p-0 m-0">
                    <div class="row custom-input">
                        @include('screens.admin.products.partials.core-fields', [
                            'product' => $product,
                            'categories' => $categories,
                            'productTypes' => $productTypes,
                            'readonly' => true,
                            'lockProductType' => false,
                        ])
                        @include('screens.admin.products.partials.gallery', [
                            'readonly' => true,
                            'galleryImages' => $galleryImages,
                        ])
                        @if ($product->productType?->slug === 'variable')
                            <div class="col-12">
                                <hr class="border-secondary">
                                <label class="form-label mb-3 d-block">{{ __('SKU variations') }}</label>
                                @if ($product->variations->isEmpty())
                                    <p class="text-muted">{{ __('No variation rows.') }}</p>
                                @else
                                    @include('screens.admin.products.partials.variation-rows-static', [
                                        'variations' => $product->variations,
                                    ])
                                @endif
                            </div>
                        @endif
                    </div>
                </fieldset>
            </div>
            <div class="card-footer text-end">
                <a href="{{ route('products.index') }}" class="btn btn-light me-2">Back to list</a>
                <a href="{{ route('products.edit', $product) }}" class="btn btn-primary">Edit</a>
            </div>
        </div>
    </div>
</div>
@endsection
