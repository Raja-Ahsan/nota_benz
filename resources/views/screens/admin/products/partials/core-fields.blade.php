{{--
    Shared product fields (create / edit / show).
    Expects: $categories, $productTypes, optional $product, boolean $readonly, boolean $lockProductType
--}}
@php
    $p = $product ?? null;
    $ro = ! empty($readonly);
    $lockType = ! empty($lockProductType);
@endphp

<div class="col-sm-6 col-md-6">
    <div class="mb-3">
        <label class="form-label" for="name">Product name @if (! $ro)<span class="text-danger">*</span>@endif</label>
        <input class="form-control" id="name" type="text" placeholder="Enter name" name="name"
            value="{{ old('name', $p->name ?? '') }}" @if ($ro) disabled @else required @endif />
    </div>
</div>
<div class="col-sm-6 col-md-6">
    <div class="mb-3">
        <label class="form-label" for="slug">Slug</label>
        <input class="form-control" id="slug" type="text" placeholder="e.g. blue-t-shirt (auto from name if empty on create)"
            name="slug" value="{{ old('slug', $p->slug ?? '') }}" @if ($ro) disabled @endif />
        @if (! $ro && ! $p)
            <small class="text-muted">Leave blank to generate from product name.</small>
        @endif
    </div>
</div>
<div class="col-sm-6 col-md-6">
    <div class="mb-3">
        <label class="form-label" for="category_id">Category @if (! $ro)<span class="text-danger">*</span>@endif</label>
        <select class="form-control" id="category_id" name="category_id" @if ($ro) disabled @else required @endif>
            @if (! $ro)
                <option value="" disabled {{ old('category_id', $p->category_id ?? '') === '' ? 'selected' : '' }}>— Select category —</option>
            @endif
            @foreach ($categories as $cat)
                <option value="{{ $cat->id }}" @selected((string) old('category_id', $p->category_id ?? '') === (string) $cat->id)>{{ $cat->name }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="col-sm-6 col-md-6">
    <div class="mb-3">
        <label class="form-label" for="product_type_id">Product type @if (! $ro && ! $lockType)<span class="text-danger">*</span>@endif</label>
        <select class="form-control" id="product_type_id" name="{{ ($ro || $lockType) ? 'product_type_id_display' : 'product_type_id' }}"
            @if ($ro || $lockType) disabled @endif
            @if (! $ro && ! $lockType) required @endif>
            @foreach ($productTypes as $pt)
                <option value="{{ $pt->id }}" data-slug="{{ $pt->slug }}" @selected((string) old('product_type_id', $p->product_type_id ?? '') === (string) $pt->id)>
                    {{ $pt->name }}
                </option>
            @endforeach
        </select>
        @if ($lockType && ! $ro)
            <small class="text-muted">Product type cannot be changed after creation.</small>
        @endif
    </div>
</div>
<div class="col-sm-6 col-md-6 js-simple-only">
    <div class="mb-3">
        <label class="form-label" for="price">Price @if (! $ro)<span class="text-danger">*</span>@endif</label>
        <input class="form-control" id="price" type="number" step="0.01" min="0" placeholder="0.00" name="price"
            value="{{ old('price', $p !== null ? $p->price : '') }}" @if ($ro) disabled @endif />
    </div>
</div>
<div class="col-md-12">
    <div class="mb-3">
        <label class="form-label" for="description">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Optional description"
            @if ($ro) disabled @endif>{{ old('description', $p->description ?? '') }}</textarea>
    </div>
</div>
<div class="col-sm-6 col-md-6">
    <div class="mb-3">
        <label class="form-label" for="status">Status @if (! $ro)<span class="text-danger">*</span>@endif</label>
        <select class="form-control" id="status" name="status" @if ($ro) disabled @else required @endif>
            <option value="active" @selected(old('status', $p->status ?? 'active') === 'active')>Active</option>
            <option value="inactive" @selected(old('status', $p->status ?? '') === 'inactive')>Inactive</option>
        </select>
    </div>
</div>
