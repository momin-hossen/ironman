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
            'categories' => Category::all(),
            'deleted_categories' => Category::onlyTrashed()->get()
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

    public function editcategory($category_id){
        return view('admin.category.edit', [
            'category_info' => Category::find($category_id)
        ]);
    }

    public function editcategorypost(Request $request){
        $request->validate([
            'category_name' => 'unique:categories,category_name,'. $request->category_id
        ]);
        Category::find($request->category_id)->update([
            'category_name' => $request->category_name,
            'category_description' => $request->category_description
        ]);
        return redirect('add/category')->with('edit_status', 'Your category edited successfully!');
    }

    public function restorecategory($category_id){
        Category::withTrashed()->find($category_id)->restore();
        return back()->with('restore_status', 'Your category restored successfully!');
    }
    
    public function forcedeletecategory($category_id){
        Category::withTrashed()->find($category_id)->forceDelete();
        return back()->with('forcedelete_status', 'Your category permanently deleted!');
    }
}
