@extends('layouts.dashboard_app')

@section('dashboard_content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
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
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Mark</th>
                                    <th>Serial No.</th>
                                    <th>Category Name</th>
                                    <th>Category Description</th>
                                    <th>Category Created By</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $category)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="category_id[]" value="{{ $category->id }}">
                                    </td>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $category->category_name }}</td>
                                    <td>{{ $category->category_description }}</td>
                                    <td>{{ App\Models\User::find($category->user_id)->name }}</td>
                                    <td>{{ $category->created_at->format('d/m/y  h:i:s A') }}</td>
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
                                @endforelse
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-danger btn-sm">Mark Deleted</button>
                    </form>
                </div>
            </div>
            <div class="card mt-5">
                <div class="card-header bg-danger text-light">
                    List Category (Deleted)
                </div>
                <div class="card-body">
                    @if (session('restore_status'))
                        <div class="alert alert-success">
                            {{ session('restore_status') }}
                        </div>   
                    @endif
                    @if (session('forcedelete_status '))
                        <div class="alert alert-danger">
                            {{ session('forcedelete_status ') }}
                        </div>   
                    @endif
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Serial No.</th>
                                <th>Category Name</th>
                                <th>Category Description</th>
                                <th>Category Created By</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($deleted_categories as $deleted_category)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $deleted_category->category_name }}</td>
                                <td>{{ $deleted_category->category_description }}</td>
                                <td>{{ App\Models\User::find($deleted_category->user_id)->name }}</td>
                                <td>{{ $deleted_category->created_at->format('d/m/y  h:i:s A') }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{ url('force/delete/category') }}/{{ $deleted_category->id }}" type="button" class="btn btn-danger btn-sm">F.D</a>
                                        <a href="{{ url('restore/category') }}/{{ $deleted_category->id }}" type="button" class="btn btn-success btn-sm">Restore</a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="50" class="text-center text-danger">No Data available</td>
                                </tr>
                            @endforelse
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
@endsection