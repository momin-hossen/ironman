<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Cart;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    public function index()
    {
      return view('frontend.cart'); 
    }

    public function store(Request $request)
    {
        if (Cookie::get('g_cart_id')) {
            $generated_cart_id = Cookie::get('g_cart_id');
        }
        else {
            $generated_cart_id = Str::random(7).rand(1, 1000);
            Cookie::queue('g_cart_id', $generated_cart_id, 1400);
        }
        if (Cart::where('generated_cart_id', $generated_cart_id)->where('product_id', $request->product_id)->exists()) {
            Cart::where('generated_cart_id', $generated_cart_id)->where('product_id', $request->product_id)->increment('product_quantity', $request->product_quantity);
        }
        else{
            Cart::insert([
            'generated_cart_id' => $generated_cart_id,
            'product_id' => $request->product_id,
            'product_quantity' => $request->product_quantity,
            'created_at' => Carbon::now()
           ]);
        }
        return back();
        
    }
    public function remove($cart_id)
    {
        Cart::find($cart_id)->delete();
        return back()->with('remove_status', 'Product remove from cart!');
    }
    public function update(Request $request)
    {
        foreach ($request->product_info as $cart_id => $product_quantity) {
            echo "<br>";
            echo $cart_id;
            Cart::find($cart_id)->update([
                'product_quantity' => $product_quantity
            ]);
        }
        return back();
    }
}
