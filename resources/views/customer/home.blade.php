@extends('layouts.dashboard_app')

@section('dashboard_content')
<div class="row justify-content-center">
    
    <div class="col-md-12  shadow p-3 mb-5 bg-white rounded">
        <div class="card">
            <div class="card-header">
                {{ __('Dashboard') }}
                <h4>
                    @if (Auth::user()->role == 1)
                        you are admin
                        @else
                        you are customer
                    @endif
                </h4>
            </div>
        </div>
    </div>






    <div class="col-md-12  shadow p-3 mb-5 bg-white rounded">
        <div class="card">
            <div class="card-header">
                Your Orders
            </div>
            <div class="card-body">
                <table class="table table-dark table-striped">
                    <thead>
                      <tr>
                        <th>SL. No</th>
                        <th>Date</th>
                        <th>Payment Method</th>
                        <th>Sub Total</th>
                        <th>Discount Amount</th>
                        <th>Coupon Name</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                      <tr>
                        <td>{{ $loop->index+1 }}</td>
                        <td>{{ $order->created_at }}</td>
                        <td>{{ $order->payment_option }}</td>
                        <td>{{ $order->sub_total }}</td>
                        <td>{{ $order->discount_amount }}</td>
                        <td>{{ $order->coupon_name }}</td>
                        <td>{{ $order->total }}</td>
                        <td>
                            {{-- @if ($contact->contact_attachement)
                            <a href="{{ url('contact/upload/download') }}/{{ $contact->id }}"><em class="icon ni ni-download"></em></a>
                            <a target="_blank" href="{{ asset('storage') }}/{{ $contact->contact_attachement }}"><em class="icon ni ni-file"></em></a>
                            @endif --}}
                        </td>
                      </tr>
                      <tr>
                        <td colspan="50">
                            @foreach ($order->order_detail as $order_product)
                                <p>{{ $order_product->product->product_name }}</p>
                            @endforeach
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