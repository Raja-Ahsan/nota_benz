@section('title', 'Edit Product')
@extends('layouts.admin.master')
@section('content')
<div class="container-fluid">
    <div class="edit-profile">
        <form class="card ajax-form" id="editProductForm" action="{{ route('products.update', $product) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-header">
                <div class="card-options">
                    <a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i
                            class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#"
                        data-bs-toggle="card-remove"><i class="fe fe-x"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="row custom-input">
                    @include('screens.admin.products.partials.core-fields', [
                        'product' => $product,
                        'categories' => $categories,
                        'productTypes' => $productTypes,
                        'readonly' => false,
                        'lockProductType' => true,
                    ])
                    @include('screens.admin.products.partials.gallery', [
                        'readonly' => false,
                        'galleryImages' => $product->images->whereNull('product_attribute_item_id')->values(),
                    ])
                    <div class="col-12 js-variable-only" style="display: none;">
                        <hr class="border-secondary">
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
                            <label class="form-label mb-0">Variation options</label>
                            <button type="button" class="btn btn-outline-primary btn-sm" id="btn-add-variation-row">
                                <i class="fa-solid fa-plus pe-1"></i> Add row
                            </button>
                        </div>
                        @if ($variationAttributes->isEmpty())
                            <div class="alert alert-warning">
                                No variations found.
                            </div>
                        @endif
                        <div id="variation-rows-container">
                            @if ($product->productType?->slug === 'variable' && $product->attributeItems->isNotEmpty())
                                @include('screens.admin.products.partials.variation-rows-edit', [
                                    'product' => $product,
                                    'variationAttributes' => $variationAttributes,
                                ])
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="{{ route('products.show', $product) }}" class="btn btn-light me-2">View</a>
                <a href="{{ route('products.index') }}" class="btn btn-light me-2">Cancel</a>
                <button class="btn btn-primary" type="submit">
                    Save changes
                </button>
            </div>
        </form>
    </div>
</div>
@push('scripts')
@php
    $galleryCount = $product->images->whereNull('product_attribute_item_id')->count();
    $galleryDeleteBase = url('/admin/products/'.$product->slug.'/gallery-image');
@endphp
<script>
    (function() {
        const VARIATION_DEFINITIONS = @json($variationDefinitions);
        const HAS_VARIATIONS = VARIATION_DEFINITIONS.length > 0;
        let rowIndex = {{ $product->productType?->slug === 'variable' ? $product->attributeItems->count() : 0 }};

        function escapeHtml(s) {
            return String(s)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/"/g, '&quot;');
        }

        function variationRowTemplate(index) {
            let opts = '<option value="" selected disabled>— Select variation —</option>';
            VARIATION_DEFINITIONS.forEach(function(v) {
                opts += '<option value="' + String(v.id) + '">' + escapeHtml(v.name) + '</option>';
            });
            return (
                '<div class="variation-option-row border rounded p-3 mb-3 js-variation-row" data-index="' + index + '">' +
                '<div class="row align-items-end">' +
                '<div class="col-xl-3 col-md-6 mb-3">' +
                '<label class="form-label">Variation <span class="text-danger">*</span></label>' +
                '<select class="form-control js-variation-select" name="variation_items[' + index + '][product_attribute_id]" required>' +
                opts +
                '</select></div>' +
                '<div class="col-xl-3 col-md-6 mb-3">' +
                '<label class="form-label">Option label <span class="text-danger">*</span></label>' +
                '<input type="text" class="form-control" name="variation_items[' + index + '][name]" placeholder="e.g. Small" required />' +
                '</div>' +
                '<div class="col-xl-2 col-md-6 mb-3">' +
                '<label class="form-label">Price <span class="text-danger">*</span></label>' +
                '<input type="number" class="form-control" name="variation_items[' + index + '][price]" step="0.01" min="0" placeholder="0.00" required />' +
                '</div>' +
                '<div class="col-xl-3 col-md-6 mb-3">' +
                '<label class="form-label">Option image</label>' +
                '<input type="file" class="form-control" name="variation_items[' + index + '][image]" accept="image/jpeg,image/png,image/jpg,image/webp,image/gif" />' +
                '</div>' +
                '<div class="col-xl-1 col-md-12 mb-3 text-xl-end">' +
                '<button type="button" class="btn btn-link text-danger btn-sm p-0 btn-remove-variation-row">Remove</button>' +
                '</div></div></div>'
            );
        }

        function addVariationRow(focusFirst) {
            if (!HAS_VARIATIONS) {
                return;
            }
            const $wrap = $('#variation-rows-container');
            $wrap.append(variationRowTemplate(rowIndex));
            if (focusFirst) {
                $wrap.find('.js-variation-row:last .js-variation-select').trigger('focus');
            }
            rowIndex++;
        }

        function toggleSimpleVariable() {
            const slug = $('#product_type_id').find(':selected').data('slug');
            const $simple = $('.js-simple-only');
            const $variable = $('.js-variable-only');

            if (slug === 'variable') {
                $simple.hide().find('#price').prop('disabled', true).removeAttr('required');
                $variable.show().find('select, input').prop('disabled', false);
                $('#price').val('0');

                const $ctr = $('#variation-rows-container');
                if (HAS_VARIATIONS && $ctr.children('.js-variation-row').length === 0) {
                    addVariationRow(false);
                }
            } else {
                $simple.show().find('#price').prop('disabled', false).attr('required', 'required');
                $variable.hide().find('select, input').prop('disabled', true);
            }
        }

        $('#product_type_id').on('change', toggleSimpleVariable);

        $('#btn-add-variation-row').on('click', function() {
            addVariationRow(true);
        });

        $(document).on('click', '.btn-remove-variation-row', function() {
            const slug = $('#product_type_id').find(':selected').data('slug');
            const $rows = $('#variation-rows-container .js-variation-row');
            if (slug === 'variable' && $rows.length <= 1) {
                return;
            }
            $(this).closest('.js-variation-row').remove();
        });

        toggleSimpleVariable();

        ajaxCreate("{{ route('products.index') }}");
    })();

    window.existingGalleryCount = {{ (int) $galleryCount }};
    Dropzone.autoDiscover = false;
    const deleteGalleryUrlBase = @json($galleryDeleteBase);
    const maxGalleryTotal = 5;

    $(document).ready(function() {
        window.existingCount = window.existingGalleryCount || 0;
        window.allowedNew = maxGalleryTotal - window.existingCount;

        window.myDropzone = new Dropzone("#gallery_images", {
            url: "javascript:void(0)",
            autoProcessQueue: false,
            maxFiles: window.allowedNew,
            acceptedFiles: 'image/*',
            addRemoveLinks: true,
            clickable: true,
            paramName: 'images[]',

            init: function() {
                const dz = this;

                if (window.allowedNew <= 0) {
                    dz.disable();
                    $('#gallery_images').addClass('disabled');
                }

                dz.on("addedfile", function(file) {
                    const input = document.getElementById("galleryInput");
                    if (!input) {
                        return;
                    }
                    const dt = new DataTransfer();
                    Array.from(input.files).forEach(function(f) {
                        dt.items.add(f);
                    });
                    dt.items.add(file);
                    input.files = dt.files;
                });

                dz.on("removedfile", function(file) {
                    const input = document.getElementById("galleryInput");
                    if (!input) {
                        return;
                    }
                    const dt = new DataTransfer();
                    Array.from(input.files).forEach(function(f) {
                        if (f.name !== file.name || f.size !== file.size) {
                            dt.items.add(f);
                        }
                    });
                    input.files = dt.files;
                });

                dz.on("maxfilesexceeded", function() {
                    Swal.fire({
                        icon: "error",
                        title: "You can upload a maximum of " + maxGalleryTotal + " gallery images."
                    });
                });
            }
        });
    });

    $(document).on('click', '.delete-gallery-image', function() {
        const btn = $(this);
        const wrapper = btn.closest('.gallery-item');
        const imageId = wrapper.data('id');

        Swal.fire({
            title: "Remove image?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, remove"
        }).then(function(result) {
            if (!result.isConfirmed) {
                return;
            }

            $.ajax({
                url: deleteGalleryUrlBase + '/' + imageId,
                type: "DELETE",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                success: function(res) {
                    if (res.success) {
                        wrapper.remove();
                        window.existingCount = Math.max(0, (window.existingCount || 0) - 1);
                        window.allowedNew = maxGalleryTotal - window.existingCount;
                        if (window.myDropzone) {
                            window.myDropzone.options.maxFiles = window.allowedNew;
                            if (window.allowedNew > 0) {
                                window.myDropzone.enable();
                                $('#gallery_images').removeClass('disabled');
                            }
                        }
                        Swal.fire({
                            icon: "success",
                            title: res.message || 'Removed',
                            timer: 1200,
                            showConfirmButton: false
                        });
                    }
                },
                error: function(xhr) {
                    const msg = xhr.responseJSON && xhr.responseJSON.message
                        ? xhr.responseJSON.message
                        : 'Could not remove image.';
                    Swal.fire({ icon: 'error', title: 'Error', text: msg });
                }
            });
        });
    });
</script>
@endpush
@endsection
