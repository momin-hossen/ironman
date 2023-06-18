@extends('layouts.dashboard_app')

@section('dashboard_content')
    <div class="row "> 
        <div class="col-md-6">
            
            @if (session('name_change_status_error'))
            <div class="alert alert-danger">
                {{ session('name_change_status_error') }}
            </div>
            @endif
            @if (session('name_change_status'))
            <div class="alert alert-success">
                {{ session('name_change_status') }}
            </div>
            @endif
            <div class="card shadow p-3 mb-5 bg-white rounded">
                <div class="card-header bg-dark text-light">
                    Name Edit
                </div>
                <div class="card-body">
                    
                    <form method="POST" action="{{ url('edit/profile/post') }}">
                        @csrf
                        <div class="form-group mb-3">
                          <label>Name</label>
                          <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}">
                          @error('category_name')
                          <span class="text-danger">{{ $message }}</span>   
                          @enderror
                        </div>
                        <button type="submit" class="btn btn-warning">Change Name</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            
            @if (session('name_change_status_error'))
            <div class="alert alert-danger">
                {{ session('name_change_status_error') }}
            </div>
            @endif
            @if (session('name_change_status'))
            <div class="alert alert-success">
                {{ session('name_change_status') }}
            </div>
            @endif
            <div class="card shadow p-3 mb-5 bg-white rounded">
                <div class="card-header bg-dark text-light">
                    Change Profile Photo
                </div>
                <div class="card-body">
                    
                    <form method="POST" action="{{ url('change/profile/photo') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                          <label>Profile Photo</label>
                          <input type="file" class="form-control" name="profile_photo">
                          @error('category_name')
                          <span class="text-danger">{{ $message }}</span>   
                          @enderror
                        </div>
                        <button type="submit" class="btn btn-warning">Change Profile Photo</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-4 m-auto">
            @if (session('password_error'))
            <div class="alert alert-danger">
                {{ session('password_error') }}
            </div>
            @endif
            @error('password')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
            <div class="card shadow p-3 mb-5 bg-white rounded">
                <div class="card-header bg-dark text-light">
                    Change Password
                </div>
                <div class="card-body">
                    
                    <form method="POST" action="{{ url('edit/password/post') }}">
                        @csrf
                        <div class="form-group mb-3">
                          <label>Old Password</label>
                          <input type="password" class="form-control" name="old_password" placeholder="Inter your old password">
                        </div>
                        <div class="form-group mb-3">
                            <label>New Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Inter your new password">
                        </div>
                        <div class="form-group mb-3">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control" name="password_confirmation" placeholder="Inter your confirm password">
                        </div>
                          

                        <button type="submit" class="btn btn-warning">Change Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection