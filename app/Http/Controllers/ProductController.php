<?php

namespace App\Http\Controllers;

use App\Enums\UserTypeEnum;
use App\Http\Requests\Product\StoreProductRequest;
use App\Models\Product;
use App\Traits\Fileable;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use Fileable;


    public function index()
    {
        $products = Product::paginate(10);
        if (auth()->user()->type == UserTypeEnum::Seller->value) {
            $products = Product::query()
                ->filteredByCompany(auth()->user()->company_id)
                ->with('user.company', 'mainImage')
                ->paginate(10);
        }
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(StoreProductRequest $request)
    {
        $validatedRequest = $request->validated();
        $images = $validatedRequest['images'];
        unset($validatedRequest['images']);

        $product = auth()->user()->products()->create($validatedRequest);
        //upload images
        $this->saveMultipleFiles($images, $product);

        return redirect()->route('products.index');
    }

    public function show(Product $product)
    {
        $product->load('images');
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        //
    }

    public function destroy(Product $product)
    {
        //
    }
}
