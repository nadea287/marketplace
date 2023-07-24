<?php

namespace App\Http\Controllers;

use App\Http\Requests\Review\StoreReviewRequest;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(StoreReviewRequest $request, Product $product)
    {
        $product->reviews()->create(array_merge(
            ['user_id' => auth()->user()->id],
            $request->validated()
        ));

        return redirect()->back();
    }
}
