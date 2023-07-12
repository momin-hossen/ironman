@extends('layouts.dashboard_app')

@section('title')
    Product Edit | Dashboard
@endsection
@section('dashboard_content')
<div class="row "> 
        <div class="col-md-6 m-auto ">
            <div class="card shadow p-3 mb-5 bg-white rounded">
                <div class="card-header bg-dark text-light">
                    Edit Product
                </div>
                <div class="card-body">
                    @if (session('product_status'))
                        <div class="alert alert-success">
                            {{ session('product_status') }}
                        </div>    
                    @endif

                    @if ($errors->all())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div> 
                    @endif
                    <form method="POST" action="{{ route('product.update', $product_info->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group mb-3">
                          <label>Category Name</label>
                          <select name="category_id" id="" class="form-control">
                            <option value="">-Select One-</option>
                            @foreach ($active_categories as $active_category)
                            <option {{ ($active_category->id == $product_info->category_id) ? "selected":"" }} value="{{ $active_category->id }}">{{ $active_category->category_name }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group mb-3">
                            <label>Product Name</label>
                            <input type="text" class="form-control" name="product_name" value="{{ $product_info->product_name }}">
                        </div>
                        <div class="form-group mb-3">
                            <label>Product Short Description</label>
                            <textarea name="product_short_description" id="" rows="4" class="form-control">{{ $product_info->product_short_description }}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label>Product Long Description</label>
                            <textarea name="product_long_description" id="" rows="4" class="form-control">{{ $product_info->product_long_description }}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label>Product Price</label>
                            <input type="text" class="form-control" name="product_price" value="{{ $product_info->product_price }}">
                        </div>
                        <div class="form-group mb-3">
                            <label>Product Quantity</label>
                            <input type="text" class="form-control" name="product_quantity" value="{{ $product_info->product_quantity }}">
                        </div>
                        <div class="form-group mb-3">
                            <label>Alert Quantity</label>
                            <input type="text" class="form-control" name="product_alert_quantity" value="{{ $product_info->product_alert_quantity }}">
                        </div>
                        <div class="form-group mb-3">
                            <label>Product Photo</label>
                            <input type="file" name="product_photo" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Edit Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
