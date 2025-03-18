<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Http\Requests\StoreCart_ItemsRequest;
use App\Http\Requests\UpdateCart_ItemsRequest;

class CartItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = CartItem::all();
        return response()->json(["items" => $items],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCart_ItemsRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $item = CartItem::create($validatedData);
            return response()->json(["item" => $item], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Cart item creation failed'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $cartItem = CartItem::find($id);
        if (!$cartItem) {
            return response()->json(["error" => "Cart item not found"], 404);
        }
        return response()->json(["Cart Item" => $cartItem], 200);
    }
    
    public function update(UpdateCart_ItemsRequest $request, $id)
    {
        $cartItem = CartItem::find($id);
        if (!$cartItem) {
            return response()->json(["error" => "Cart item not found"], 404);
        }
        $cartItem->update($request->validated());
        return response()->json(["cart item" => $cartItem], 200);
    }
    
    public function destroy($id)
    {
        $cartItem = CartItem::find($id);
        if (!$cartItem) {
            return response()->json(["error" => "Cart item not found"], 404);
        }
        $cartItem->delete();
        return response()->json(["message" => "Cart item deleted successfully"], 200);
    }
    public function getItemsByCartId($cart_id)
{
    $cartItems = CartItem::where('cart_id', $cart_id)->get();

    if ($cartItems->isEmpty()) {
        return response()->json(["message" => "No items found for this cart"], 404);
    }

    return response()->json(["cart_items" => $cartItems], 200);
}

    
}
