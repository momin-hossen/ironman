@extends('layouts.dashboard_app')

@section('title')
    Product | Dashboard
@endsection
@section('dashboard_content')
<div class="row ">
        <div class="col-md-9">
            <div class="card shadow p-3 mb-5 bg-white rounded">
                <div class="card-header bg-dark text-light">
                    List Product (Active)
                </div>
                <div class="card-body">
                    @if (session('delete_status'))
                        <div class="alert alert-danger">
                            {{ session('delete_status') }}
                        </div>
                    @endif
                    @if (session('edit_status'))
                        <div class="alert alert-success">
                            {{ session('edit_status') }}
                        </div>    
                    @endif
                    <form method="post" action="{{ url('mark/delete') }}">
                        @csrf
                        
                            <table class="datatable-init table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Serial No.</th>
                                        <th>Category Name</th>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Alert Quantity</th>
                                        <th>Photo</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($products as $product)
                                    <tr>
                                        {{-- <td>
                                            <input type="checkbox" name="category_id[]" value="{{ $category->id }}">
                                        </td> --}}
                                        <td>{{ $loop->index + 1 }}</td>
                                        {{-- <td>{{ App\Models\Category::find($product->category_id)->category_name }}</td> --}}
                                        <td>{{ $product->onetoonerelationwithcategorytable->category_name }}</td>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->product_price }}</td>
                                        <td>{{ $product->product_quantity }}</td>
                                        <td>{{ $product->product_alert_quantity }}</td>
                                        <td>
                                            <img style="height: 40px" src="{{ asset('uploads/product_photos') }}/{{ $product->product_thumbnail_photo }}" alt="{{ $product->product_thumbnail_photo }}">
                                        </td>
                                        <td>
                                            <a href="{{ route('product.edit', $product->id) }}" type="button" class="btn btn-info btn-sm">Edit</a>
                                            <form action="{{ route('product.destroy', $product->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="50" class="text-center text-danger">No Data available</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        <button type="submit" class="btn btn-danger btn-sm">Mark Deleted</button>
                    </form>
                </div>
            </div>
        </div>   
        <div class="col-md-3 ">
            <div class="card shadow p-3 mb-5 bg-white rounded">
                <div class="card-header bg-dark text-light">
                    Add Product
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
                    <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                          <label>Category Name</label>
                          <select name="category_id" id="" class="form-control">
                            <option value="">-Select One-</option>
                            @foreach ($active_categories as $active_category)
                            <option value="{{ $active_category->id }}">{{ $active_category->category_name }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group mb-3">
                            <label>Product Name</label>
                            <input type="text" class="form-control" name="product_name">
                        </div>
                        <div class="form-group mb-3">
                            <label>Product Short Description</label>
                            <textarea name="product_short_description" id="" rows="4" class="form-control"></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label>Product Long Description</label>
                            <textarea name="product_long_description" id="" rows="4" class="form-control"></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label>Product Price</label>
                            <input type="text" class="form-control" name="product_price">
                        </div>
                        <div class="form-group mb-3">
                            <label>Product Quantity</label>
                            <input type="text" class="form-control" name="product_quantity">
                        </div>
                        <div class="form-group mb-3">
                            <label>Alert Quantity</label>
                            <input type="text" class="form-control" name="product_alert_quantity">
                        </div>
                        <div class="form-group mb-3">
                            <label>Product Photo</label>
                            <input type="file" name="product_photo" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Add Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
