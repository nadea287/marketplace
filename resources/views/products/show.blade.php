@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $product->price }}</h6>
                        <p class="card-text">{{ $product->description }}</p>
                        <a href="#" class="card-link">edit</a>
                        <a href="#" class="card-link">delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
