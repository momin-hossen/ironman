<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function addcategory(){
        return view('admin.category.index');
    }
    public function addcategorypost(Request $request){
        $request->validate([
            'category_name' => 'required|alpha',
            'category_description' => 'required'
        ]);
        echo $request->category_name;
    }
}
