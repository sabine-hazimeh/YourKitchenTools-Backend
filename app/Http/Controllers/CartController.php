<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use Illuminate\Support\Facades\Auth;
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carts = Cart::all();
        return response()->json(["carts" => $carts],200);
        
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCartRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $cart = Cart::create($validatedData);
            return response()->json(["cart" => $cart], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Cart creation failed'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        return response()->json(["Cart" => $cart],200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCartRequest $request, Cart $cart)
    {
        $cart -> update($request->validated());
        return response()->json(["cart" => $cart],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();
        return response()->json(["message" => "Cart deleted successfully"], 200);
    }
    public function getCartForUser()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Check if the user has an associated cart
        $cart = Cart::where('user_id', $user->id)->first();

        // If no cart is found, return an error message
        if (!$cart) {
            return response()->json(["error" => "No cart found for this user"], 404);
        }

        return response()->json(["cart" => $cart], 200);
    }
}
