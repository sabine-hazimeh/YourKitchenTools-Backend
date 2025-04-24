<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Log;
use App\Models\Image;

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
    // public function store(StoreProductRequest $request)
    // {
    //     Log::info('Store method hit!');

    //     try {
    //         $validatedData = $request->validated();
    //         $product = Product::create($validatedData);
    //         return response()->json(["product" => $product], 200);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => 'Product creation failed'], 500);
    //     }
    // }
    public function store(StoreProductRequest $request)
    {
        try {
            $validatedData = $request->validated();
    
            // Create the product
            $product = Product::create($validatedData);
    
            // Handle image uploads
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    $path = $file->store('product_images', 'public'); // Store file
    
                    // Save image record
                    Image::create([
                        'image_url' => $path,
                        'product_id' => $product->id,
                    ]);
                }
            }
    
            return response()->json(["product" => $product->load('images')], 200);
    
        } catch (\Exception $e) {
            return response()->json(['error' => 'Product creation failed', 'message' => $e->getMessage()], 500);
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
    public function newArrivals()
{
    $products = Product::orderBy('created_at', 'desc')
                        ->take(6)
                        ->get();

    return response()->json(["new_arrivals" => $products], 200);
}
public function newArrivalsWithImages()
{
    $products = Product::with('images')
                ->orderBy('created_at', 'desc')
                ->take(6)
                ->get();

    return response()->json(["new_arrivals" => $products], 200);
}

}
