<?php

namespace App\Http\Controllers;

use App\Classes\FileClass;
use App\Classes\HelperClass;
use App\Enums\UserTypeEnum;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product;
use App\Services\FileService;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:update,product')->only('edit', 'update');
    }

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
        FileService::saveMultipleFiles($images, $product);

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

    public function update(UpdateProductRequest $request, Product $product)
    {
        $validatedRequest = $request->validated();
        if (isset($validatedRequest['images'])) {
            FileService::saveMultipleFiles($validatedRequest['images'], $product);
            unset($validatedRequest['images']);
        }
        $product->update($validatedRequest);

        return redirect()->route('products.index');
    }

    public function destroy($product)
    {
        if (!($DBProduct = Product::find($product))) {
            return response()->json([
                'data' => 'Product not found'
            ], Response::HTTP_NOT_FOUND);
        }

        if (request()->user()->cannot('delete', $DBProduct)) {
            abort(403);
        }

        //delete physical files
        FileClass::deleteDirectory(HelperClass::fetchFilePath(get_class($DBProduct)) . '/' . $DBProduct->id);
        $DBProduct->images()->delete();
        $DBProduct->delete();

        return response()->json([
            'data' => 'Product was deleted successfully!'
        ], Response::HTTP_OK);
    }
}
