@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><b class="fs-6">Name: </b>{{ $product->name }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted"><b class="fs-6">Price: </b>{{ $product->price }}</h6>
                        <p class="card-text"><b class="fs-6">Description: </b>{{ $product->description }}</p>
                        <a href="{{ route('products.edit', ['product' => $product->id]) }}" class="card-link">edit</a>
                        <a href="#" class="card-link">delete</a>

                        <div class="row pt-4 d-flex justify-content-around">
                            @foreach($product->images as $image)
                                <div class="col-md-4 pb-4">
                                    <div>
                                        <img class="img-fluid"
                                             src="{{ asset('storage/products/' . $product->id . '/' . $image->name) }}"
                                             alt="{{ $image->name }}">
                                    </div>
                                    <div>
                                        <button class="btn btn-sm btn-danger mt-2">Delete</button>
                                    </div>
                                </div>

                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
