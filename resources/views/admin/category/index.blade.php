@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    List Category
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Serial No.</th>
                                <th>Category Name</th>
                                <th>Category Description</th>
                                <th>Category Created By</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $category->category_name }}</td>
                                <td>{{ $category->category_description }}</td>
                                <td>{{ App\Models\User::find($category->user_id)->name }}</td>
                                <td>{{ $category->created_at->format('d/m/y  h:i:s A') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>   
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Add Category
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
                    <form method="POST" action="{{ url('add/category/post') }}">
                        @csrf
                        <div class="form-group mb-3">
                          <label>Category Name</label>
                          <input type="text" class="form-control" placeholder="Enter Category Name" name="category_name" value="{{ old('category_name') }}">
                          @error('category_name')
                          <span class="text-danger">{{ $message }}</span>   
                          @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label>Category Description</label>
                            <textarea name="category_description" class="form-control" rows="4">{{ old('category_description') }}</textarea>
                            @error('category_description')
                            <span class="text-danger">{{ $message }}</span>   
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Add Category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection