<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function home()
    {
        return view('customer.home', [
            'orders' => Order::with('order_detail')->where('user_id', Auth::id())->get()
        ]);
    }
}
