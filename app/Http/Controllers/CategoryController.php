<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryForm;
use App\Models\Category;
use Carbon\Carbon;
use Auth;

class CategoryController extends Controller
{
    public function addcategory(){
        return view('admin.category.index',[
            'categories' => Category::all()
        ]);
    }
    public function addcategorypost(CategoryForm $request){
        Category::insert([
            'category_name' => $request->category_name,
            'category_description' => $request->category_description,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);
        return back()->with('succss_status', $request->category_name . ' category added successfully!');
    }
    public function deletecategory($category_id){
        Category::find($category_id)->delete();
        return back()->with('delete_status', 'Your category deleted successfully!');
    }
    
}