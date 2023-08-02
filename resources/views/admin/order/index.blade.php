@extends('layouts.dashboard_app')

@section('title')
    Product | Dashboard
@endsection
@section('dashboard_content')
<div class="row">
        <div class="col-md-12">
            <div class="card shadow p-3 mb-5 bg-white rounded">
                <div class="card-header bg-dark text-light">
                    List Product (Active)
                </div>
                <div class="card-body">
                    {{-- @if (session('delete_status'))
                        <div class="alert alert-danger">
                            {{ session('delete_status') }}
                        </div>
                    @endif
                    @if (session('edit_status'))
                        <div class="alert alert-success">
                            {{ session('edit_status') }}
                        </div>
                    @endif --}}
                    <form method="post" action="">
                        @csrf
                            <table class="datatable-init table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Serial No.</th>
                                        <th>Order ID</th>
                                        <th>Order At</th>
                                        <th>Order By</th>
                                        <th>Payment Type</th>
                                        <th>Payment Status</th>
                                        <th>Price</th>
                                        <th>Discount Amount</th>
                                        <th>Coupon Name</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($orders as $order)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->created_at }}</td>
                                            <td>{{ App\Models\User::find($order->user_id)->name }}</td>
                                            <td>
                                                @if ($order->payment_option == 1)
                                                    Cash on Delivery
                                                @else  
                                                    Card  
                                                @endif
                                            </td>
                                            <td>
                                                {{ $order->payment_option }}
                                                @if ($order->payment_status == 1)
                                                    <span class="badge badge-danger">Unpaid</span>
                                                @else  
                                                    <span class="badge badge-success">Paid</span>
                                                @endif
                                            </td>
                                            <td>{{ $order->sub_total }}</td>
                                            <td>{{ $order->discount_amount }}</td>
                                            <td>{{ $order->coupon_name }}</td>
                                            <td>{{ $order->total }}</td>
                                            <td>
                                                @if ($order->payment_status == 1)
                                                <form action="{{ route('order.update', $order->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-success btn-sm">Paid</button>
                                                </form>
                                                @endif
                                                <a class="btn btn-danger text-light btn-sm">Cencel</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="50" class="text-center text-danger">No data available in table</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        {{-- <button type="submit" class="btn btn-danger btn-sm">Mark Deleted</button> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
