<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class FrontendController extends Controller
{
    public function index(){
        return view('frontend.index', [
            'active_products' => Product::latest()->get(),
            'active_categories' => Category::all()
        ]);
    }
    public function productdetails($slug)
    {
        return view('frontend.productdetails', [
            'product_info' => Product::where('slug', $slug)->firstOrFail()
        ]);
    }


    public function contact(){
        return view('frontend.contact');
    }
    public function about(){
        return view('about');
    }
}
