<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Product;
use Carbon\Carbon;

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
        $product_info = Product::where('slug', $slug)->firstOrFail();
        $related_products = Product::where('category_id', $product_info->category_id)->where('id', '!=', $product_info->id)->get();
        return view('frontend.productdetails', [
            'product_info' => $product_info,
            'related_products' => $related_products
        ]);
    }


    public function contact(){
        return view('frontend.contact');
    }

    public function contactinsert(Request $request){
        Contact::insert($request->except('_token')+[
            'created_at' => Carbon::now(),
        ]);
        return back();
    }

    public function about(){
        return view('about');
    }
}
