@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Products</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <a href="{{ route('products.create') }}" class="btn btn-sm btn-dark mb-4">Create Product</a>

                        <div class="table-responsive">
                            <table class="table table-hover align-items-center justify-content-center mb-0">
                                <thead>
                                <tr>
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Company</th>
                                    <th scope="col">Rate AVG</th>
                                    <th scope="col">Options</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td class="w-50">
                                            <img
                                                src="{{ \App\Classes\HelperClass::getFileForWeb($product, $product->mainImage?->name) }}"
                                                alt="{{ $product->name }}" class="img-fluid w-25 h-25">
                                        </td>
                                        <td>
                                            <a href="{{ route('products.show', ['product' => $product->id]) }}">
                                                {{ $product->name }}
                                            </a>
                                        </td>
                                        <td>{{ $product->user->company->name }}</td>
                                        <td>5.2</td>
                                        <td>
                                            @can('update', $product)
                                                <a href="{{ route('products.edit', ['product' => $product->id]) }}"class="text-decoration-none pe-2">Edit</a>
                                                <button style="all: unset; cursor: pointer" class="text-danger delete-product"
                                                        data-id="{{ $product->id }}">Delete
                                                </button>
                                            @else
                                                --
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                        {!! $products->links() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
