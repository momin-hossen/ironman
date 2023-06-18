@extends('layouts.dashboard_app')

@section('dashboard_content')
    <div class="row"> 
        <div class="col-md-4 m-auto">
            <div class="card">
                <div class="card-header">
                    Edit Category
                </div>
                <div class="card-body">
                    <ol class="breadcrumb">
                        <li><a href="{{ url('add/category') }}">Add Category</a> / </li>
                        <li class="active"> {{ $category_info->category_name }}</li>
                    </ol>
                    
                    <form method="POST" action="{{ url('edit/category/post') }}">
                        @csrf
                        <div class="form-group mb-3">
                          <label>Category Name</label>
                          <input type="hidden" name="category_id" value="{{ $category_info->id }}">
                          <input type="text" class="form-control" placeholder="Enter Category Name" name="category_name" value="{{ $category_info->category_name }}">
                          @error('category_name')
                          <span class="text-danger">{{ $message }}</span>   
                          @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label>Category Description</label>
                            <textarea name="category_description" class="form-control" rows="4">{{ $category_info->category_description }}</textarea>
                            @error('category_description')
                            <span class="text-danger">{{ $message }}</span>   
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-warning">Edit Category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection