<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class CustomerController extends Controller
{
    public function home()
    {
        return view('customer.home', [
            'orders' => Order::with('order_detail')->where('user_id', Auth::id())->get()
        ]);
    }
    public function customerinvoicedownload($order_id){
    $order_info = Order::find($order_id);    
    $pdf = Pdf::loadView('pdf.invoice', compact('order_info'));
    return $pdf->download('ironman.pdf');
    }
}
