@php
    error_reporting(0);
@endphp
@extends('layouts.dashboard_app')

@section('title')
    Product | Dashboard
@endsection
@section('dashboard_content')
<div class="row ">
        <div class="col-md-9">
            <div class="card shadow p-3 mb-5 bg-white rounded">
                <div class="card-header bg-dark text-light">
                    List Category (Active)
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
                                        <th>Mark</th>
                                        <th>Serial No.</th>
                                        <th>Category Name</th>
                                        <th>Category Description</th>
                                        <th>Category Created By</th>
                                        <th>Photos</th>
                                        <th>Last Updated At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @forelse ($categories as $category)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="category_id[]" value="{{ $category->id }}">
                                        </td>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $category->category_name }}</td>
                                        <td>{{ $category->category_description }}</td>
                                        <td>{{ App\Models\User::find($category->user_id)->name ?? ''}}</td>
                                        <td>
                                            <img src="{{ asset('uploads/category_photos') }}/{{ $category->category_photo }}" class="img-fluid" alt="not found">
                                        </td>
                                        <td>
                                            @isset($category->updated_at)
                                            {{ $category->updated_at->diffForHumans() }}
                                            @endisset
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ url('edit/category') }}/{{ $category->id }}" type="button" class="btn btn-info btn-sm">Edit</a>
                                                <a href="{{ url('delete/category') }}/{{ $category->id }}" type="button" class="btn btn-danger btn-sm">Delete</a>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="50" class="text-center text-danger">No Data available</td>
                                        </tr>
                                    @endforelse --}}
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
                    @if (session('succss_status'))
                        <div class="alert alert-success">
                            {{ session('succss_status') }}
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
