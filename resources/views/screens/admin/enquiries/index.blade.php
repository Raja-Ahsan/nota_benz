@extends('layouts.admin.master')
@section('title', __('Enquiries'))

@section('content')
<div class="container-fluid user-list-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header card-no-border">
                    <h5 class="mb-0">{{ __('Enquiries') }}</h5>
                </div>
                <div class="card-body pt-0 px-0">
                    <div class="list-product user-list-table">
                        <div class="table-responsive custom-scrollbar">
                            <table class="table" id="enquiries-table">
                                <thead>
                                    <tr>
                                        <th><span class="c-o-light f-w-600">{{ __('Name') }}</span></th>
                                        <th><span class="c-o-light f-w-600">{{ __('Email') }}</span></th>
                                        <th><span class="c-o-light f-w-600">{{ __('Subject') }}</span></th>
                                        <th><span class="c-o-light f-w-600">{{ __('Status') }}</span></th>
                                        <th><span class="c-o-light f-w-600">{{ __('Received') }}</span></th>
                                        <th><span class="c-o-light f-w-600">{{ __('Actions') }}</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($enquiries as $enquiry)
                                        <tr class="product-removes inbox-data" data-enquiry-id="{{ $enquiry->id }}">
                                            <td>
                                                <a href="{{ route('enquiries.show', $enquiry) }}">{{ $enquiry->name }}</a>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $enquiry->email }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $enquiry->subject ?: '—' }}</p>
                                            </td>
                                            <td>
                                                @php
                                                    $statusBadge = match ($enquiry->status) {
                                                        'new' => 'badge-light-info',
                                                        'read' => 'badge-light-secondary',
                                                        'replied' => 'badge-light-success',
                                                        'archived' => 'badge-light-warning',
                                                        default => 'badge-light-secondary',
                                                    };
                                                @endphp
                                                <span class="badge {{ $statusBadge }}">{{ ucfirst($enquiry->status) }}</span>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $enquiry->created_at->format('d M Y, h:i A') }}</p>
                                            </td>
                                            <td>
                                                <div class="common-align gap-2 justify-content-start">
                                                    <a class="square-white" href="{{ route('enquiries.show', $enquiry) }}" title="{{ __('View') }}">
                                                        <span><i class="fa-solid fa-eye"></i></span>
                                                    </a>
                                                    <a
                                                        class="square-white enquiry-delete"
                                                        href="#!"
                                                        data-url="{{ route('enquiries.destroy', $enquiry) }}"
                                                        title="{{ __('Delete') }}"
                                                    >
                                                        <span><i class="fa-solid fa-trash"></i></span>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-4">{{ __('No enquiries yet.') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        @if ($enquiries->hasPages())
                            <div class="px-4 py-3">
                                {{ $enquiries->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).on('click', '.enquiry-delete', function (e) {
        e.preventDefault();
        const url = $(this).data('url');
        const row = $(this).closest('tr');

        Swal.fire({
            title: @json(__('Delete this enquiry?')),
            text: @json(__('This cannot be undone.')),
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: @json(__('Yes, delete')),
            cancelButtonText: @json(__('Cancel')),
        }).then(function (result) {
            if (!result.isConfirmed) return;

            $.ajax({
                url: url,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Accept': 'application/json',
                },
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: response.message || @json(__('Deleted')),
                        timer: 1500,
                        showConfirmButton: false,
                    });
                    row.fadeOut(300, function () {
                        $(this).remove();
                    });
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: @json(__('Could not delete enquiry')),
                    });
                },
            });
        });
    });
</script>
@endpush
