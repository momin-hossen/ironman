<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Order_detail;
use App\Models\Contact;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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
        $related_products = Product::where('category_id', $product_info->category_id)->where('id', '!=', $product_info->id)->limit(4)->get();
        $show_review_form = 0;
        if (Order_detail::where('user_id', Auth::id())->where('product_id', $product_info->id)->whereNull('review')->exists()) {
            $show_review_form = 1;
            $order_details_id = Order_detail::where('user_id', Auth::id())->where('product_id', $product_info->id)->whereNull('review')->first()->id;
        }
        else {
            $show_review_form = 2;
            $order_details_id = 0;
        }
        $reviews = Order_detail::where('product_id', $product_info->id)->whereNotNull('review')->get();
        return view('frontend.productdetails', [
            'product_info' => $product_info,
            'related_products' => $related_products,
            'show_review_form' => $show_review_form,
            'order_details_id' => $order_details_id,
            'reviews' => $reviews
        ]);
    }


    public function contact(){
        return view('frontend.contact');
    }

    public function contactinsert(Request $request){
        $contact_id = Contact::insertGetId($request->except('_token')+[
            'created_at' => Carbon::now(),
        ]);
        if ($request->hasFile('contact_attachement')) {
            // $uploaded_path = $request->file('contact_attachement')->store('public/contact_uploads');
            $path = $request->file('contact_attachement')->storeAs(
                'public/contact_uploads', $contact_id.".".$request->file('contact_attachement')->getClientOriginalExtension()
            );
            Contact::find($contact_id)->update([
                'contact_attachement' => $path
            ]);
        }
        return back()->with('success_status', 'We recieved your message');
    }

    public function about(){
        return view('about');
    }
    public function shop(){
        return view('frontend.shop', [
            'categorices' => Category::all(),
            'products' => Product::all()
        ]);
    }
    public function customerregister(){
        return view('frontend.customerregister');
    }
    public function customerregisterpost(Request $request){
        User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 2,
            'password' => Hash::make($request->password),
            'created_at' => Carbon::now()
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('customer/home');
        }
    }

    public function reviewpost(Request $request){
        Order_detail::find($request->order_details_id)->update([
            'stars' => $request->stars,
            'review' => $request->review
        ]);
        return back();
    }
}
