@extends('layouts.admin.master')
@section('title', 'All Categories')

@section('content')
    <div class="container-fluid user-list-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-no-border d-flex flex-wrap justify-content-end align-items-center gap-2">
                        <div class="card-header-right-icon">
                            <button
                                type="button"
                                class="btn btn-primary f-w-500"
                                data-bs-toggle="modal"
                                data-bs-target="#categoryCreateModal"
                            >
                                <i class="fa-solid fa-plus pe-2"></i>{{ __('Add category') }}
                            </button>
                        </div>
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
                                            @include('screens.admin.product-categories.partials.table-row', ['category' => $category])
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

    {{-- Create category --}}
    <div class="modal fade" id="categoryCreateModal" tabindex="-1" aria-labelledby="categoryCreateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryCreateModalLabel">{{ __('Add category') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close') }}"></button>
                </div>
                <form id="category-create-form" action="{{ route('product-categories.store') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label f-w-500" for="category-create-name">{{ __('Name') }} <span class="text-danger">*</span></label>
                            <input
                                type="text"
                                class="form-control"
                                id="category-create-name"
                                name="name"
                                required
                                maxlength="255"
                            />
                        </div>
                        <div class="mb-3">
                            <label class="form-label f-w-500" for="category-create-slug">{{ __('Slug') }}</label>
                            <input
                                type="text"
                                class="form-control"
                                id="category-create-slug"
                                name="slug"
                                maxlength="255"
                                placeholder="{{ __('Leave empty to auto-generate from name') }}"
                            />
                        </div>
                        <div class="mb-0">
                            <label class="form-label f-w-500" for="category-create-status">{{ __('Status') }}</label>
                            <select class="form-select" id="category-create-status" name="status" required>
                                <option value="active">{{ __('Active') }}</option>
                                <option value="inactive">{{ __('Inactive') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
                    </div>
                </form>
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

            $('#category-create-form').on('submit', function(e) {
                e.preventDefault();
                var form = $(this);
                var submitBtn = form.find('button[type="submit"]');
                var btnText = submitBtn.text();
                var fd = new FormData(this);
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: fd,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        Accept: 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    beforeSend: function() {
                        submitBtn.prop('disabled', true).text(@json(__('Saving...')));
                    },
                    success: function(res) {
                        submitBtn.prop('disabled', false).text(btnText);
                        var table = $('#categories-table').DataTable();
                        $('#categories-table tbody tr').has('td[colspan]').remove();
                        var $row = $(String(res.html).trim());
                        table.row.add($row[0]).draw(false);
                        form[0].reset();
                        $('#categoryCreateModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: res.message || @json(__('Created successfully.')),
                            showConfirmButton: false,
                            timer: 1500,
                        });
                    },
                    error: function(xhr) {
                        submitBtn.prop('disabled', false).text(btnText);
                        if (xhr.status === 422) {
                            var response = xhr.responseJSON;
                            form.find('.invalid-feedback').remove();
                            form.find('.is-invalid').removeClass('is-invalid');
                            if (response.success === false && response.message) {
                                Swal.fire({ icon: 'error', title: 'Error!', text: response.message });
                            }
                            var globalErrors = [];
                            if (response.errors) {
                                $.each(response.errors, function(key, messages) {
                                    var input = form.find('[name="' + key + '"]');
                                    if (input.length) {
                                        input.addClass('is-invalid');
                                        input.after('<div class="invalid-feedback d-block">' + messages[0] + '</div>');
                                    } else {
                                        globalErrors.push(messages[0]);
                                    }
                                });
                            }
                            if (globalErrors.length > 0) {
                                Swal.fire({ icon: 'error', title: 'Validation Error', html: globalErrors.join('<br>') });
                            }
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text:
                                    xhr.responseJSON && xhr.responseJSON.message
                                        ? xhr.responseJSON.message
                                        : @json(__('Something went wrong!')),
                            });
                        }
                    },
                });
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
