<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\JsonFileRequest;
use App\Jobs\JsonProcess;
use App\Http\Resources\Product as ProductResource;

class ProductController extends Controller
{
    public function index()
    {
        return ProductResource::collection(Product::all());
    }

    public function store(ProductRequest $request)
    {
        $data = $request->validated();

        $product = Product::create($data);

        return (new ProductResource($product))
            -> response()
            ->setStatusCode(201);
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validated();

        $product->update($data);

        return (new ProductResource($product))
            ->response()
            ->setStatusCode(201);
    }

    public function show(Product $product)
    {
        return (new ProductResource(Product::find($product)))
            ->response()
            ->setStatusCode(200);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json("Deleted!", 200);
    }

    public function jsonUpload(JsonFileRequest $request)
    {
        $data = $request->validated();

        $filePath = $request->file('jsonFile')->storeAs(
            'products', 'products.json'
        );

        $file = Storage::get($filePath);
        $jsonFile = json_decode($file, true);
        
        JsonProcess::dispatch($jsonFile);
        
        return response()->json("Successful operation", 200);
    }
}
