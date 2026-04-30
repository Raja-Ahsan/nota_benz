{{--
    Read-only variation rows (show page).
    Expects $items: iterable of ProductAttributeItem with productAttribute + image loaded
--}}
@foreach ($items as $index => $item)
    <div class="variation-option-row border rounded p-3 mb-3 js-variation-row">
        <div class="row align-items-end">
            <div class="col-xl-3 col-md-6 mb-3">
                <label class="form-label">Variation</label>
                <select class="form-control" disabled>
                    <option>{{ $item->productAttribute?->name ?? '—' }}</option>
                </select>
            </div>
            <div class="col-xl-3 col-md-6 mb-3">
                <label class="form-label">Option label</label>
                <input type="text" class="form-control" value="{{ $item->name }}" disabled />
            </div>
            <div class="col-xl-2 col-md-6 mb-3">
                <label class="form-label">Price</label>
                <input type="text" class="form-control" value="{{ number_format((float) $item->price, 2) }}" disabled />
            </div>
            <div class="col-xl-4 col-md-6 mb-3">
                <label class="form-label">Option image</label>
                @if ($item->image)
                    @php $vSrc = $item->image->publicUrl(); @endphp
                    @if ($vSrc !== '')
                        <div>
                            <a href="{{ $vSrc }}" target="_blank" rel="noopener">
                                <img src="{{ $vSrc }}" alt="" class="img-thumbnail mt-1" style="max-height: 80px;">
                            </a>
                        </div>
                    @else
                        <p class="text-muted small mb-0">Invalid path</p>
                    @endif
                @else
                    <p class="text-muted small mb-0">—</p>
                @endif
            </div>
        </div>
    </div>
@endforeach
