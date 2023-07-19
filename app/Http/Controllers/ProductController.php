<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Product;
use App\Models\Product_image;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.product.index', [
            'active_categories' => Category::all(),
            'products' => Product::with('onetoonerelationwithcategorytable')->get(),
        ]);
    }

    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $slug_link = Str::slug($request->product_name."-".Str::random(5));
        $product_id = Product::insertGetId($request->except('_token', 'product_thumbnail_photo', 'product_multiple_photo') + [
            'slug' => $slug_link,
            'created_at' => Carbon::now(),
        ]);


        if ($request->hasFile('product_thumbnail_photo')) {

            $uploaded_photo = $request->file('product_thumbnail_photo');
            $new_photo_name = $product_id.".".$uploaded_photo->getClientOriginalExtension();
            $new_photo_location = 'public/uploads/product_photos/'.$new_photo_name;
            Image::make($uploaded_photo)->resize(600,622)->save(base_path($new_photo_location));
            Product::find($product_id)->update([
                'product_thumbnail_photo' => $new_photo_name
            ]);
        }

        if ($request->hasFile('product_multiple_photo')) {
            $flag =1;
            foreach ($request->file('product_multiple_photo') as $single_photo) {
                $uploaded_photo = $single_photo;
                $new_photo_name = "$product_id"."-"."$flag".".".$uploaded_photo->getClientOriginalExtension();
                $new_photo_location = 'public/uploads/product_multiple_photos/'.$new_photo_name;
                Image::make($uploaded_photo)->resize(600,622)->save(base_path($new_photo_location));

                Product_image::insert([
                    'product_id' => $product_id,
                    'product_multiple_image_name' => $new_photo_name,
                    'created_at' => Carbon::now()
                ]);
                $flag++;
            }
        }
        return back()->with('product_status', 'Product Added Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('admin.product.edit', [
            'active_categories' => Category::all(),
            'product_info' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->except('_tolen', '_method' ));
        return redirect('product');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return back();
    }
}
