<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    public function index(Request $request)
    {
        return Cart::where('user_id', $request->user()->id)->get();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);
    
        $validatedData['user_id'] = $request->user()->id;
    
        $cartItem = Cart::create($validatedData);
    
        return response()->json($cartItem, 201);
    }
    
    public function update(Request $request, Cart $cart)
    {
        if ($request->user()->id !== $cart->user_id) {
            return response()->json(['error' => 'You can only edit your own items.'], 403);
        }
    
        $validatedData = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);
    
        $cart->update($validatedData);
    
        return response()->json($cart);
    }
    
    public function destroy(Cart $cart)
    {
        if ($request->user()->id !== $cart->user_id) {
            return response()->json(['error' => 'You can only delete your own items.'], 403);
        }
    
        $cart->delete();
    
        return response()->json(null, 204);
    }
}
