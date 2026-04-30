@section('title', 'All Products')
@extends('layouts.admin.master')
@section('content')
<div class="container-fluid user-list-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header card-no-border text-end">
                    <div class="card-header-right-icon">
                        <a class="btn btn-primary f-w-500" href="{{ route('products.create') }}"><i
                                class="fa-solid fa-plus pe-2"></i>Add
                            Product</a>
                    </div>
                </div>
                <div class="card-body pt-0 px-0">
                    <div class="list-product user-list-table">
                        <div class="table-responsive custom-scrollbar">
                            <table class="table" id="users-table">
                                <thead>
                                    <tr>
                                        <th>
                                            <span class="c-o-light f-w-600">Name</span>
                                        </th>
                                        <th>
                                            <span class="c-o-light f-w-600">SKU</span>
                                        </th>
                                        <th>
                                            <span class="c-o-light f-w-600">Price</span>
                                        </th>
                                        <th>
                                            <span class="c-o-light f-w-600">Stock</span>
                                        </th>
                                        <th>
                                            <span class="c-o-light f-w-600">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($products as $product)
                                    <tr class="product-removes inbox-data">
                                        <td>{{$product->name}}</td>
                                        <td>
                                            @foreach ($product->variants as $variant)
                                            <p>{{$variant->sku}}</p>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($product->variants as $variant)
                                            <p>{{$variant->price ?? 'N/A'}}</p>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($product->variants as $variant)
                                            <p>{{$variant->stock ?? 'N/A'}}</p>
                                            @endforeach
                                        </td>
                                        <td>
                                            <div class="common-align gap-2 justify-content-start">
                                                {{-- <a class="square-white" href="add-user.html">
                                                            <span><i class="fa-solid fa-pen"></i></span>
                                                        </a>
                                                        <a class="square-white trash-7" href="#!">
                                                            <span><i class="fa-solid fa-trash"></i></span>
                                                        </a> --}}
                                                {{-- add view icon --}}
                                                <a class="square-white" href="#!">
                                                    <span><i class="fa-solid fa-eye"></i></span>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            <h3 class="pt-5">No @yield('title', 'Products') Found</h3>
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
    var table = $('#users-table').DataTable({
        order: [
            [4, 'desc']
        ],
        columnDefs: [{
            orderable: false,
            targets: 4
        }]
    });
</script>
@endpush
@endsection