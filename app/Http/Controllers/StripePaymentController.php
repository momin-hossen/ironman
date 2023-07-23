<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Stripe;

class StripePaymentController extends Controller
{
    public function stripe()
    {
        return view('test.stripe');
    }
    
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        Stripe\Charge::create ([
                "amount" => 1000 * 100,
                "currency" => "bdt",
                "source" => $request->stripeToken,
                "description" => "Payment From Ironman." 
        ]);
      
        Session::flash('success', 'Payment successful!');
              
        return back();
    }
}
