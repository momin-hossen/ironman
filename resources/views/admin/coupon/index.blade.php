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
                    List Coupon (Active)
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
                    <form method="post" action="{{-- url('mark/delete') --}}">
                        @csrf
                            <table class="datatable-init table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Serial No.</th>
                                        <th>Coupon Name</th>
                                        <th>Discount Amount</th>
                                        <th>Minimum Purchase Amount</th>
                                        <th>Validity Till</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($coupons as $coupon)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $coupon->coupon_name }}</td>
                                        <td>{{ $coupon->discount_amount }}%</td>
                                        <td>${{ $coupon->minimum_purchase_amount }}</td>
                                        <td>{{ $coupon->validity_till }}</td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="50" class="text-center text-danger">No Data available</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        {{-- <button type="submit" class="btn btn-danger btn-sm">Mark Deleted</button> --}}
                    </form>
                </div>
            </div>
        </div>   
        <div class="col-md-3 ">
            <div class="card shadow p-3 mb-5 bg-white rounded">
                <div class="card-header bg-dark text-light">
                    Add Coupon
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
                    <form method="POST" action="{{ route('coupon.store') }}" >
                        @csrf
                        <div class="form-group mb-3">
                            <label>Coupon Name</label>
                            <input type="text" class="form-control" name="coupon_name">
                        </div>
                        <div class="form-group mb-3">
                            <label>Discount Amount</label>
                            <input type="text" class="form-control" name="discount_amount">
                        </div>
                        <div class="form-group mb-3">
                            <label>Minimum Purchase Amount</label>
                            <input type="text" class="form-control" name="minimum_purchase_amount">
                        </div>
                        <div class="form-group mb-3">
                            <label>Validity Till</label>
                            <input type="date" class="form-control" name="validity_till">
                        </div>
                        <button type="submit" class="btn btn-primary">Add Coupon</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
