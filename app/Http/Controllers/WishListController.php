<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class WishlistController extends Controller
{
    /**
     * Display all wishlist items for the authenticated user.
     */
    public function index()
    {
        $userId = Auth::id();       
        $wishlistItems = Wishlist::where('user_id', $userId)->with('product')->get();
        return response()->json($wishlistItems);
    }
    

    /**
     * Add a product to the wishlist.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $exists = Wishlist::where('user_id', Auth::id())
                          ->where('product_id', $request->product_id)
                          ->exists();

        if ($exists) {
            return response()->json(['message' => 'Product is already in wishlist'], 409);
        }

        Wishlist::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
        ]);

        return response()->json(['message' => 'Product added to wishlist'], 201);
    }

    /**
     * Remove a product from the wishlist.
     */
    public function destroy($product_id)
    {
        $wishlistItem = Wishlist::where('user_id', Auth::id())
                                ->where('product_id', $product_id)
                                ->first();

        if (!$wishlistItem) {
            return response()->json(['message' => 'Product not found in wishlist'], 404);
        }

        $wishlistItem->delete();
        return response()->json(['message' => 'Product removed from wishlist']);
    }
}
