<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\City;
use App\Models\User;
use App\Models\Order;
use App\Models\Billing;
use App\Models\Country;
use App\Models\Product;
use App\Models\Shipping;
use App\Models\Order_detail;
use Illuminate\Http\Request;
use App\Mail\PurchaseConfirm;
use PhpParser\Node\Stmt\Echo_;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('frontend.checkout', [
            'user' => User::find(Auth::id()),
            'countries' => Country::all(),
        ]);
    }
    public function getcitylistajax(Request $request){
        $stringTOsend ="";  
        $citis = City::where('country_id', $request->country_id)->get();
        foreach ($citis as $city) {
             $stringTOsend .= "<option value='".$city->id."'>".$city->name."</option>";
        }
        return $stringTOsend;
    }
    public function checkoutpost(Request $request){
        if (isset($request->shipping_address_status)) {
            $shipping_id = Shipping::insertGetId([
                'name' => $request->shipping_name,
                'email' => $request->shipping_email,
                'phone_number' => $request->shipping_phone_number,
                'country_id' => $request->shipping_country_id,
                'city_id' => $request->shipping_city_id,
                'address' => $request->shipping_address,
                'created_at' => Carbon::now()
            ]);
        }
        else {
            
            $shipping_id = Shipping::insertGetId([
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'country_id' => $request->country_id,
                'city_id' => $request->city_id,
                'address' => $request->address,
                'created_at' => Carbon::now()
            ]);
        }
        $billing_id = Billing::insertGetId([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'country_id' => $request->country_id,
            'city_id' => $request->city_id,
            'address' => $request->address,
            'notes' => $request->notes,
            'created_at' => Carbon::now()
        ]);
        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'sub_total' => session('cart_sub_total'),
            'discount_amount' => session('discount_amount'),
            'coupon_name' => session('coupon_name'),
            'total' => (session('cart_sub_total') - session('discount_amount')),
            'payment_option' => $request->payment_option,
            'billing_id' => $billing_id,
            'shipping_id' => $shipping_id,
            'created_at' => Carbon::now()
        ]);
        foreach (cart_items() as $cart_item) {
            Order_detail::insert([
                'order_id' => $order_id,
                'product_id' => $cart_item->product_id,
                'product_quantity' => $cart_item->product_quantity,
                'product_price' => $cart_item->product->product_price,
                'created_at' => Carbon::now()
            ]);
            // product table decrement
            Product::find($cart_item->product_id)->decrement('product_quantity', $cart_item->product_quantity);

            // Delete from cart table
            $cart_item->forceDelete();
        }
        $order_details = Order_detail::where('order_id', $order_id)->get();
        Mail::to($request->email)->send(new PurchaseConfirm($order_details));
        return redirect('cart');  
    }

    public function testmail(){
        // Mail::to($request->email)->send(new PurchaseConfirm);
        $order_details = Order_detail::where('order_id', 1)->get();
        return(new PurchaseConfirm($order_details))->render();
    }
}
