<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Log;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return response()->json(["products" => $products],200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        Log::info('Store method hit!');

        try {
            $validatedData = $request->validated();
            $product = Product::create($validatedData);
            return response()->json(["product" => $product], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Product creation failed'], 500);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return response()->json(["product" => $product],200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product -> update($request->validated());
        return response()->json(["product" => $product],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(["message" => "Product deleted successfully"], 200);
    }
}
