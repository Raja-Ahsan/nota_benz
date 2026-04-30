{{-- Editable variation rows; expects $product with attributeItems, $variationAttributes collection --}}
@foreach ($product->attributeItems as $index => $item)
    <div class="variation-option-row border rounded p-3 mb-3 js-variation-row" data-index="{{ $index }}">
        <div class="row align-items-end">
            <div class="col-xl-3 col-md-6 mb-3">
                <label class="form-label">Variation <span class="text-danger">*</span></label>
                <select class="form-control js-variation-select" name="variation_items[{{ $index }}][product_attribute_id]" required>
                    <option value="" disabled>— Select variation —</option>
                    @foreach ($variationAttributes as $va)
                        <option value="{{ $va->id }}" @selected((int) $item->product_attribute_id === (int) $va->id)>{{ $va->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-xl-3 col-md-6 mb-3">
                <label class="form-label">Option label <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="variation_items[{{ $index }}][name]" value="{{ old('variation_items.'.$index.'.name', $item->name) }}" placeholder="e.g. Small" required />
            </div>
            <div class="col-xl-2 col-md-6 mb-3">
                <label class="form-label">Price <span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="variation_items[{{ $index }}][price]" step="0.01" min="0" placeholder="0.00"
                    value="{{ old('variation_items.'.$index.'.price', $item->price) }}" required />
            </div>
            <div class="col-xl-3 col-md-6 mb-3">
                <label class="form-label">Option image</label>
                <input type="file" class="form-control" name="variation_items[{{ $index }}][image]" accept="image/jpeg,image/png,image/jpg,image/webp,image/gif" />
                @if ($item->image)
                    @php $optSrc = $item->image->publicUrl(); @endphp
                    @if ($optSrc !== '')
                        <small class="text-muted d-block mt-1">Current:</small>
                        <img src="{{ $optSrc }}" alt="" class="img-thumbnail mt-1" style="max-height: 56px;" loading="lazy">
                    @else
                        <small class="text-warning d-block mt-1">Saved path missing or invalid.</small>
                    @endif
                @endif
            </div>
            <div class="col-xl-1 col-md-12 mb-3 text-xl-end">
                <button type="button" class="btn btn-link text-danger btn-sm p-0 btn-remove-variation-row">Remove</button>
            </div>
        </div>
    </div>
@endforeach
