@extends('layouts.admin.master')
@section('title', __('Newsletter'))

@section('content')
<div class="container-fluid user-list-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header card-no-border d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <h5 class="mb-0">{{ __('Newsletter subscribers') }}</h5>
                    <span class="badge badge-light-primary">{{ $subscribers->total() }} {{ __('total') }}</span>
                </div>
                <div class="card-body pt-0 px-0">
                    <div class="list-product user-list-table">
                        <div class="table-responsive custom-scrollbar">
                            <table class="table" id="newsletter-table">
                                <thead>
                                    <tr>
                                        <th><span class="c-o-light f-w-600">{{ __('Email') }}</span></th>
                                        <th><span class="c-o-light f-w-600">{{ __('Status') }}</span></th>
                                        <th><span class="c-o-light f-w-600">{{ __('Subscribed') }}</span></th>
                                        <th><span class="c-o-light f-w-600">{{ __('Actions') }}</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($subscribers as $subscriber)
                                        <tr class="product-removes inbox-data">
                                            <td>
                                                <a href="mailto:{{ $subscriber->email }}">{{ $subscriber->email }}</a>
                                            </td>
                                            <td>
                                                @php
                                                    $statusBadge = $subscriber->status === 'active'
                                                        ? 'badge-light-success'
                                                        : 'badge-light-secondary';
                                                @endphp
                                                <span class="badge {{ $statusBadge }}">{{ ucfirst($subscriber->status) }}</span>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $subscriber->created_at->format('d M Y, h:i A') }}</p>
                                            </td>
                                            <td>
                                                <div class="common-align gap-2 justify-content-start">
                                                    <a
                                                        class="square-white newsletter-delete"
                                                        href="#!"
                                                        data-url="{{ route('newsletter-subscribers.destroy', $subscriber) }}"
                                                        title="{{ __('Delete') }}"
                                                    >
                                                        <span><i class="fa-solid fa-trash"></i></span>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-4">{{ __('No subscribers yet.') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        @if ($subscribers->hasPages())
                            <div class="px-4 py-3">
                                {{ $subscribers->links() }}
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
    $(document).on('click', '.newsletter-delete', function (e) {
        e.preventDefault();
        const url = $(this).data('url');
        const row = $(this).closest('tr');

        Swal.fire({
            title: @json(__('Remove this subscriber?')),
            text: @json(__('This cannot be undone.')),
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: @json(__('Yes, remove')),
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
                        title: response.message || @json(__('Removed')),
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
                        title: @json(__('Could not remove subscriber')),
                    });
                },
            });
        });
    });
</script>
@endpush
