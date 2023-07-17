@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Products</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <a href="{{ route('products.create') }}">Create Product</a>

                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Company</th>
                                <th scope="col">Rate AVG</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>image</td>
                                    <td>{{ $product->name }}</td>
                                    <td>comp name</td>
                                    <td>5.2</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                            {!! $products->links() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
