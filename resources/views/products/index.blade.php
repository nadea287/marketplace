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

                        <a href="{{ route('products.create') }}">Create Product</a>

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
                                                src="{{ asset('storage/products/' . $product->id . '/' . $product->mainImage->name) }}"
                                                alt="{{ $product->name }}" class="img-fluid w-25 h-25">
                                        </td>
                                        <td>
                                            <a href="{{ route('products.show', ['product' => $product->id]) }}">
                                                {{ $product->name }}
                                            </a>
                                        </td>
                                        <td>{{ $product->user->company->name }}</td>
                                        <td>5.2</td>
                                        <td></td>
                                    </tr>
                                    here
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
