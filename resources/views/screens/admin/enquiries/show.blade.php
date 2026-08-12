@extends('layouts.admin.master')
@section('title', __('Enquiry Details'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header card-no-border d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <h5 class="mb-0">{{ __('Enquiry') }} #{{ $enquiry->id }}</h5>
                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <a href="{{ route('enquiries.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fa-solid fa-arrow-left pe-1"></i> {{ __('Back to Enquiries') }}
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="mb-0">{{ __('Sender') }}</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-2"><strong>{{ __('Name') }}:</strong> {{ $enquiry->name }}</div>
                                    <div class="mb-2">
                                        <strong>{{ __('Email') }}:</strong>
                                        <a href="mailto:{{ $enquiry->email }}">{{ $enquiry->email }}</a>
                                    </div>
                                    <div class="mb-0">
                                        <strong>{{ __('Phone') }}:</strong>
                                        {{ $enquiry->phone ?: '—' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="mb-0">{{ __('Meta') }}</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-2">
                                        <strong>{{ __('Received') }}:</strong>
                                        {{ $enquiry->created_at->format('d M Y, h:i A') }}
                                    </div>
                                    <div class="mb-2">
                                        <strong>{{ __('Subject') }}:</strong>
                                        {{ $enquiry->subject ?: '—' }}
                                    </div>
                                    <div class="mb-0 d-flex align-items-center gap-2 flex-wrap">
                                        <strong>{{ __('Status') }}:</strong>
                                        <select
                                            id="enquiry-status"
                                            class="form-select form-select-sm"
                                            style="max-width: 10rem;"
                                            data-url="{{ route('enquiries.update-status', $enquiry) }}"
                                        >
                                            @foreach (['new', 'read', 'replied', 'archived'] as $status)
                                                <option value="{{ $status }}" @selected($enquiry->status === $status)>
                                                    {{ ucfirst($status) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="mb-0">{{ __('Message') }}</h6>
                                </div>
                                <div class="card-body">
                                    <p class="mb-0" style="white-space: pre-wrap;">{{ $enquiry->message }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $('#enquiry-status').on('change', function () {
        const select = $(this);
        const url = select.data('url');
        const status = select.val();

        $.ajax({
            url: url,
            type: 'PATCH',
            data: { status: status },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Accept': 'application/json',
            },
            success: function (response) {
                Swal.fire({
                    icon: 'success',
                    title: response.message || @json(__('Updated')),
                    timer: 1200,
                    showConfirmButton: false,
                });
            },
            error: function () {
                Swal.fire({
                    icon: 'error',
                    title: @json(__('Could not update status')),
                });
            },
        });
    });
</script>
@endpush
