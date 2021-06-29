<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\Product as ProductResource;

class ProductController extends Controller
{
    public function index()
    {
        return ProductResource::collection(Product::paginate());
    }

    public function store(ProductRequest $request)
    {
        $data = $request->validated();

        $product = Product::create($data);

        return (new ProductResource($product))
            -> response()
            ->setStatusCode(200);
    }

    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();
        
        $product->update($data);

        return (new ProductResource($product))
            ->response()
            ->setStatusCode(201);
    }

    public function show(Product $product)
    {
        return (new ProductResource(Product::find($product)));
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json(null, 204);
    }

    public function jsonUpload(Request $request)
    {
        $data = $request->validate([
            'jsonFile' => 'required|file'
        ]);

        $file = $request->file('jsonFile');
        $filePath = Storage::put('products', $file);
        $fileName = basename($filePath);
        
        
        return response()->json("uploaded", 201);
    }
}
