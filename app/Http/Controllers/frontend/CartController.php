<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart($id)
    {
        // dd($id);
        if (!Auth::check()) {
            return redirect()->route('frontend.login')->with('error', 'You must be logged in');
        }

        $product = Product::findOrFail($id);
        //dd($product->price);
        // Define session if empty return the empty record
        $cart = session('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'id' => $product->id,
                "name" => $product->name,
                "quantity" => 1,
                "price"  => $product->price,
                "image" => $product->image,
                "description" => $product->description
            ];
        }

        session()->put("cart", $cart);
        
        // Store in database
        if(Auth::check()){
            $userId = Auth::id();
            $existing = ShoppingCart::where('user_id', $userId)->where('product_id', $id)->first();
            if($existing){
                $existing->increment('quantity');
                $existing->update([
                    'price' => $existing->quantity * $existing->price
                ]);
            }else{
                ShoppingCart::create([
                    'user_id' => $userId,
                    'product_id' => $id,
                    'quantity' => 1,
                    'price' => $product->price,
                    'total' => $product->price 
                ]);
            }
        }
       return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function cart()
    {
        return view('frontend.pages.shop-cart');
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = max((int) $request->quantity, 1);
            session()->put('cart', $cart);
        }

        return response()->json(['success' => true, 'cart' => $cart]);
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->route('cart');
    }
}
