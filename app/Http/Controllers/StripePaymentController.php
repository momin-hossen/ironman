<?php

namespace App\Http\Controllers;

use Stripe;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StripePaymentController extends Controller
{
    public function stripe()
    {
        if (session('order_id_from_checkout_page')) {
            return view('test.stripe');
        }
        else {
            abort(404);
        }
    }
    
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        $amount = session('cart_sub_total') - session('discount_amount');
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => $amount * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Payment From Ironman." 
        ]);
      
        Session::flash('success', 'Payment successful!');

        Order::find(session('order_id_from_checkout_page'))->update([
            'payment_option' => 2
        ]);
        session([
            'cart_sub_total' => '',
            'coupon_name' => '',
            'discount_amount' => '',
            'order_id_from_checkout_page' => ''
        ]);
        return redirect('cart');
    }
}
