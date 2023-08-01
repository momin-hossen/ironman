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
function review_customer_count($product_id){
    return App\Models\Order_detail::where('product_id', $product_id)->whereNotNull('review')->count();
}
function average_star($product_id){
    $count_amount = App\Models\Order_detail::where('product_id', $product_id)->whereNotNull('review')->count();
    $sum_amount = App\Models\Order_detail::where('product_id', $product_id)->whereNotNull('review')->sum('stars');
    if ($sum_amount == 0) {
        return 0;
    }
    else{
        return round($sum_amount / $count_amount);
    }
}