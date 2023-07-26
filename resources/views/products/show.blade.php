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
                        @can('update', $product)
                            <a href="{{ route('products.edit', ['product' => $product->id]) }}"
                               class="card-link">edit</a>
                        @endcan
                        @can('delete', $product)
                            <a href="#" class="card-link">delete</a>
                        @endcan

                        <div class="row pt-4 d-flex justify-content-around">
                            @foreach($product->images as $image)
                                <div class="col-md-4 pb-4 product-image">
                                    <div>
                                        <img class="img-fluid"
                                             src="{{ asset('storage/products/' . $product->id . '/' . $image->name) }}"
                                             alt="{{ $image->name }}">
                                    </div>
                                    <div>
                                        @can('delete', $image)
                                            <button class="btn btn-sm btn-danger mt-2 delete-product-image"
                                                    data-id="{{ $image->id }}">Delete
                                            </button>
                                        @endcan
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{--            reviews--}}
            @if($product->canUserRateProduct($product->id))
                <div class="col-md-12 mt-4">
                    <div class="card">
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('reviews.store', ['product' => $product]) }}" method="POST">
                                @csrf
                                <div class="col-md-3 mb-3">
                                    <label for="rating" class="form-label">Rating</label>
                                    <input type="number" name="rating" value="{{ old('rating') }}" class="form-control"
                                           id="rating">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="comment" class="form-label">Comment</label>
                                    <textarea name="comment" class="form-control" id="comment"
                                              rows="3">{{ old('comment') }}</textarea>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <select class="form-select" name="status" aria-label="Default select example">
                                        @foreach(\App\Enums\ReviewStatusEnum::cases() as $status)
                                            <option
                                                value="{{ $status->value }}" @selected(old('status'))>{{ $status->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-sm btn-dark">Save</button>
                            </form>

                        </div>
                    </div>
                </div>
            @endif
            {{--            end review form--}}

            {{--            reviews start--}}
            <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="card-body">
                        <section>
                            <div class="row d-flex justify-content-center">
                                <div class="col-md-10 col-xl-8 text-center">
                                    <h3 class="mb-4">Reviews</h3>
                                </div>
                            </div>

                            <div class="row text-center">
                                @foreach($product->reviews as $review)

                                    <div class="col-md-4 mb-5 mb-md-0">
                                        <h5 class="mb-3">{{ $review->user->name }}</h5>
                                        <h6 class="text-danger mb-3">{{ $review->rating }} stars</h6>
                                        <p class="px-xl-3">{{ $review->comment }}</p>
                                        {{--<ul class="list-unstyled d-flex justify-content-center mb-0">
                                            <li>
                                                <i class="fas fa-star fa-sm text-warning"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star fa-sm text-warning"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star fa-sm text-warning"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star fa-sm text-warning"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star-half-alt fa-sm text-warning"></i>
                                            </li>
                                        </ul>--}}
                                    </div>

                                @endforeach
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
