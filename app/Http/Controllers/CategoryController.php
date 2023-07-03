<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryForm;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function addcategory(){
        return view('admin.category.index',[
            'categories' => Category::all(),
            'deleted_categories' => Category::onlyTrashed()->get()
        ]);
    }

    public function addcategorypost(CategoryForm $request){
        
        $category_id = Category::insertGetId([
            'category_name' => $request->category_name,
            'category_description' => $request->category_description,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);
        if ($request->hasFile('category_photo')) {
            echo "$category_id";

            $uploaded_photo = $request->file('category_photo');
            $new_photo_name = $category_id.".".$uploaded_photo->getClientOriginalExtension();
            $new_photo_location = 'public/uploads/category_photos/'.$new_photo_name;
            Image::make($uploaded_photo)->resize(270,250)->save(base_path($new_photo_location));
            Category::find($category_id)->update([
                'category_photo' => $new_photo_name
            ]);
        }
        return back()->with('succss_status', $request->category_name . ' category added successfully!');
    }

    public function deletecategory($category_id){
        Category::find($category_id)->delete();
        Product::where('category_id', $category_id)->delete();
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

    public function markdelete(Request $request){
        if ($request->category_id) {
            foreach ($request->category_id as $cat_id) {
                Category::find($cat_id)->delete();
            }
        }
        return back();
    }
    public function markrestore(Request $request){
        if ($request->category_id) {
            foreach ($request->category_id as $cat_id) {
                Category::withTrashed()->find($cat_id)->restore();
            }
        }
        return back();
    }
}
