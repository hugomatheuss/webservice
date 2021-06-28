<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Product;
use App\Http\Resources\Product as ProductResource;

class ProductController extends Controller
{
    public function index()
    {
        return ProductResource::collection(Product::paginate());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'filename' => 'required|string|max:255',
            'height' => 'required|numeric',
            'width' => 'required|numeric',
            'price' => 'required|numeric',
            'rating' => 'required|numeric',
        ]);

        $product = Product::create($data);

        return (new ProductResource($product))
            -> response()
            ->setStatusCode(200);
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'filename' => 'required|string|max:255',
            'height' => 'required|numeric',
            'width' => 'required|numeric',
            'price' => 'required|numeric',
            'rating' => 'required|numeric',
        ]);

        $product->update($data);
        //var_dump($product); exit;

        return (new ProductResource($product))
            ->response()
            ->setStatusCode(201);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(null, 204);
    }

    public function jsonUpload(Request $request)
    {   var_dump("OI");
        /* $data = $request->validate([
            'jsonFile' => 'required|file'
        ]); */
        $data = $request->all();
        var_dump($data);
        exit;

        return $data;
    }
}
