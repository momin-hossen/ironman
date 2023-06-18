@extends('layouts.dashboard_app')

@section('dashboard_content')

                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        {{ __('Dashboard') }}
                                        <h1>Total users: {{ $total_users }}</h1>
                                    </div>
                    
                                    <div class="card-body">
                                        @if (session('status'))
                                            <div class="alert alert-success" role="alert">
                                                {{ session('status') }}
                                            </div>
                                        @endif
                    
                                        <table class="table table-dark table-striped">
                                            <thead>
                                              <tr>
                                                <th>SL. No</th>
                                                <th>ID. No</th>
                                                <th>Name</th>
                                                <th>Email Address</th>
                                                <th>Created At</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($users as $user)
                                              <tr>
                                                <td>{{ $users->firstItem() + $loop->index }}</td>
                                                <td>{{ $user->id }}</td>
                                                <td>{{ Str::title($user->name) }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    <li>Date: {{ $user->created_at->format('d/m/Y') }}</li>
                                                    <li>Time: {{ $user->created_at->format('h:i:s:A') }}</li>
                                                    <li>{{ $user->created_at->diffForHumans() }}</li>
                                                </td>
                                              </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        {{  $users->links('vendor.pagination.bootstrap-5') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                
@endsection


                
                