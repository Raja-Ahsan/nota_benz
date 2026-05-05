@extends('layouts.admin.master')
@section('title', 'All Categories')

@section('content')
    <div class="container-fluid user-list-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-no-border text-end">
                        <div class="card-header-right-icon"></div>
                    </div>
                    <div class="card-body pt-0 px-0">
                        <div class="list-product user-list-table">
                            <div class="table-responsive custom-scrollbar">
                                <table class="table" id="categories-table">
                                    <thead>
                                        <tr>
                                            <th><span class="c-o-light f-w-600">Name</span></th>
                                            <th><span class="c-o-light f-w-600">Slug</span></th>
                                            <th><span class="c-o-light f-w-600">Status</span></th>
                                            <th><span class="c-o-light f-w-600">Actions</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($categories as $category)
                                            @php
                                                $statusBadge =
                                                    $category->status === 'active'
                                                        ? 'badge-light-success'
                                                        : 'badge-light-secondary';
                                            @endphp
                                            <tr class="product-removes inbox-data" data-category-id="{{ $category->id }}">
                                                <td class="category-name">{{ $category->name }}</td>
                                                <td class="category-slug">
                                                    <code class="text-reset">{{ $category->slug }}</code>
                                                </td>
                                                <td class="category-status">
                                                    <span class="badge {{ $statusBadge }}">{{ ucfirst($category->status) }}</span>
                                                </td>
                                                <td>
                                                    <div class="common-align gap-2 justify-content-start">
                                                        <a
                                                            class="square-white"
                                                            href="{{ route('artifacts.index', ['category_id' => $category->id]) }}"
                                                            target="_blank"
                                                            rel="noopener noreferrer"
                                                            title="{{ __('View on storefront') }}"
                                                        >
                                                            <span><i class="fa-solid fa-eye"></i></span>
                                                        </a>
                                                        <button
                                                            type="button"
                                                            class="square-white js-category-edit border-0 p-0"
                                                            title="{{ __('Edit') }}"
                                                            data-update-url="{{ route('product-categories.update', $category) }}"
                                                            data-name="{{ $category->name }}"
                                                            data-slug="{{ $category->slug }}"
                                                            data-status="{{ $category->status }}"
                                                        >
                                                            <span><i class="fa-solid fa-pen"></i></span>
                                                        </button>
                                                        <form
                                                            action="{{ route('product-categories.destroy', $category) }}"
                                                            method="POST"
                                                            class="d-inline"
                                                        >
                                                            @csrf
                                                            @method('DELETE')
                                                            <button
                                                                type="submit"
                                                                class="square-white border-0 js-category-delete"
                                                                title="{{ __('Delete') }}"
                                                            >
                                                                <span><i class="fa-solid fa-trash"></i></span>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">
                                                    <h3 class="pt-5">{{ __('No categories found') }}</h3>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit category (Bootstrap modal; closed by ajax-update.js on success) --}}
    <div class="modal fade" id="crudModal" tabindex="-1" aria-labelledby="crudModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="crudModalLabel">{{ __('Edit category') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close') }}"></button>
                </div>
                <form id="category-edit-form" action="#" method="POST" autocomplete="off">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label f-w-500" for="category-name">{{ __('Name') }}</label>
                            <input
                                type="text"
                                class="form-control"
                                id="category-name"
                                name="name"
                                required
                                maxlength="255"
                            >
                        </div>
                        <div class="mb-3">
                            <label class="form-label f-w-500" for="category-slug">{{ __('Slug') }}</label>
                            <input
                                type="text"
                                class="form-control"
                                id="category-slug"
                                name="slug"
                                required
                                maxlength="255"
                                pattern="[a-z0-9]+(?:-[a-z0-9]+)*"
                                title="{{ __('Lowercase letters, numbers, and hyphens only') }}"
                            >
                        </div>
                        <div class="mb-0">
                            <label class="form-label f-w-500" for="category-status">{{ __('Status') }}</label>
                            <select class="form-select" id="category-status" name="status" required>
                                <option value="active">{{ __('Active') }}</option>
                                <option value="inactive">{{ __('Inactive') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            $('#categories-table').DataTable({
                order: [
                    [0, 'desc']
                ],
                columnDefs: [{
                    orderable: false,
                    targets: 3
                }]
            });

            $(document).on('click', '.js-category-edit', function() {
                var btn = $(this);
                $('#category-edit-form').attr('action', btn.data('update-url'));
                $('#category-name').val(btn.data('name'));
                $('#category-slug').val(btn.data('slug'));
                $('#category-status').val(btn.data('status'));
                $('#crudModal').modal('show');
            });

            window.updateCategoryRow = function(data) {
                var row = $('tr[data-category-id="' + data.id + '"]');
                if (!row.length) {
                    return;
                }
                row.find('.category-name').text(data.name);
                row.find('.category-slug code').text(data.slug);
                var badgeClass = data.status === 'active' ? 'badge-light-success' : 'badge-light-secondary';
                row.find('.category-status').html(
                    '<span class="badge ' + badgeClass + '">' + data.status.charAt(0).toUpperCase() + data.status.slice(1) +
                    '</span>'
                );
                var editBtn = row.find('.js-category-edit');
                editBtn.attr('data-name', data.name);
                editBtn.attr('data-slug', data.slug);
                editBtn.attr('data-status', data.status);
            };

            ajaxUpdate('#category-edit-form');
            ajaxDelete('.js-category-delete', 'tr', null, '#categories-table');
        });
    </script>
@endpush
