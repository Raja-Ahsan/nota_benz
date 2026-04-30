@section('title', 'All Categories')
@extends('layouts.admin.master')
@section('content')
<div class="container-fluid user-list-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header card-no-border text-end">
                    <div class="card-header-right-icon">
                    </div>
                </div>
                <div class="card-body pt-0 px-0">
                    <div class="list-product user-list-table">
                        <div class="table-responsive custom-scrollbar">
                            <table class="table" id="categories-table">
                                <thead>
                                    <tr>
                                        <th>
                                            <span class="c-o-light f-w-600">Name</span>
                                        </th>
                                        <th>
                                            <span class="c-o-light f-w-600">Slug</span>
                                        </th>
                                        <th>
                                            <span class="c-o-light f-w-600">Status</span>
                                        </th>
                                        <th>
                                            <span class="c-o-light f-w-600">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($categories as $category)
                                    <tr class="product-removes inbox-data">
                                        <td>{{ $category->name }}</td>
                                        <td>
                                            <p>{{ $category->slug }}</p>
                                        </td>
                                        <td>
                                            <p>{{ $category->status }}</p>
                                        </td>
                                        <td>
                                            <div class="common-align gap-2 justify-content-start">
                                                <a class="square-white" href="#!">
                                                    <span><i class="fa-solid fa-eye"></i></span>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center">
                                            <h3 class="pt-5">No @yield('title', 'Categories') Found</h3>
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
@push('scripts')
<script>
    var table = $('#categories-table').DataTable({
        order: [
            [0, 'desc']
        ],
        columnDefs: [{
            orderable: false,
            targets: 3
        }]
    });
</script>
@endpush
@endsection
