<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class FrontendController extends Controller
{
    public function index(){
        return view('frontend.index', [
            'active_categories' => Category::all()
        ]);
    }
    public function contact(){
        return view('frontend.contact');
    }
    public function about(){
        return view('about');
    }
}
