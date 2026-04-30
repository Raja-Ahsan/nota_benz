{{--
    $readonly bool
    When readonly: pass $galleryImages (collection of ProductImage)
    When editing/creating: pass optional $galleryImages for "current gallery" above Dropzone
--}}
@php
    $ro = ! empty($readonly);
    $galleryCollection = isset($galleryImages) ? $galleryImages : collect();
@endphp
<div class="col-12">
    <div class="mb-3">
        <label class="form-label">Gallery images</label>
        @if ($ro)
            @if ($galleryCollection->isNotEmpty())
                <div class="d-flex flex-wrap gap-2 mt-2">
                    @foreach ($galleryCollection as $img)
                        @php $src = $img->publicUrl(); @endphp
                        @if ($src !== '')
                            <a href="{{ $src }}" target="_blank" rel="noopener">
                                <img src="{{ $src }}" alt="" class="img-thumbnail rounded" style="max-height: 120px; width: auto;">
                            </a>
                        @endif
                    @endforeach
                </div>
            @else
                <p class="text-muted mb-0">No gallery images.</p>
            @endif
        @else
            @if ($galleryCollection->isNotEmpty())
                <small class="text-muted d-block mb-2">Current gallery</small>
                <div class="d-flex flex-wrap gap-2 mb-3">
                    @foreach ($galleryCollection as $img)
                        @php $src = $img->publicUrl(); @endphp
                        @if ($src !== '')
                            <a href="{{ $src }}" target="_blank" rel="noopener">
                                <img src="{{ $src }}" alt="" class="img-thumbnail rounded border border-secondary" style="max-height: 100px; width: auto;">
                            </a>
                        @endif
                    @endforeach
                </div>
            @endif
            <small class="text-muted d-block mb-2">Upload new images below only when you want to replace the gallery; leave empty to keep current images.</small>
            <div id="gallery_images" class="dropzone"></div>
        @endif
    </div>
</div>
