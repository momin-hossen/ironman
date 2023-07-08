@extends('layouts.dashboard_app')

@section('dashboard_content')
@section('title')
    Home | Dashboard
@endsection

                        <div class="row justify-content-center">
                            <div class="col-md-12  shadow p-3 mb-5 bg-white rounded">
                                <div class="card">
                                    <div class="card-header">
                                        <a href="{{ url('send/newsletter') }}" class="btn btn-success">Send Newsletter to {{ $total_users }} users</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12  shadow p-3 mb-5 bg-white rounded">
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






                            <div class="col-md-12  shadow p-3 mb-5 bg-white rounded">
                                <div class="card">
                                    <div class="card-header">
                                        Contact
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-dark table-striped">
                                            <thead>
                                              <tr>
                                                <th>SL. No</th>
                                                <th>Name</th>
                                                <th>Email Address</th>
                                                <th>Subject</th>
                                                <th>Message</th>
                                                <th>File</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($contacts as $contact)
                                              <tr>
                                                <td>{{ $loop->index+1 }}</td>
                                                <td>{{ $contact->contact_name }}</td>
                                                <td>{{ $contact->contact_email }}</td>
                                                <td>{{ $contact->contact_subject }}</td>
                                                <td>{{ $contact->contact_message }}</td>
                                                <td>
                                                    @if ($contact->contact_attachement)
                                                    <a href="{{ url('contact/upload/download') }}/{{ $contact->id }}"><em class="icon ni ni-download"></em></a>
                                                    <a target="_blank" href="{{ asset('storage') }}/{{ $contact->contact_attachement }}"><em class="icon ni ni-file"></em></a>
                                                    @endif
                                                </td>
                                              </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                
@endsection


                
                