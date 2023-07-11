<?php
use Illuminate\Support\Facades\Cookie;

function total_product_count(){
    echo App\Models\Product::count();
}
function cart_count(){
    echo App\Models\Cart::where('generated_cart_id', Cookie::get('g_cart_id'))->count();
}
function cart_items(){
    return App\Models\Cart::where('generated_cart_id', Cookie::get('g_cart_id'))->get();
}