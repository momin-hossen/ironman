<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;
use PhpParser\Node\Stmt\Echo_;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('frontend.checkout', [
            'user' => User::find(Auth::id())
        ]);
    }
    public function checkoutpost(Request $request){
        print_r($request->all());
        Billing::insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'country_id' => $request->country_id,
            'city_id' => $request->city_id,
            'address' => $request->address,
            'created_at' => Carbon::now()
        ]);
        echo "ok";
    }
}
