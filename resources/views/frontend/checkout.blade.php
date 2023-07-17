@extends('layouts.frontend_app')

@section('frontend_conten')
<!-- .breadcumb-area start -->
<div class="breadcumb-area bg-img-4 ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap text-center">
                    <h2>Checkout</h2>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><span>Checkout</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .breadcumb-area end -->
<!-- checkout-area start -->
<div class="checkout-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="checkout-form form-style">
                    <h3>Billing Details</h3>
                    <form action="{{ url('checkout/post') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <p>Name *</p>
                                <input type="text" value="{{ $user->name }}" name="name">
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Email Address *</p>
                                <input type="email" value="{{ $user->email }}" name="email">
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Phone No. *</p>
                                <input type="text" name="phone_number">
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Country *</p>
                                <select id="country_list_1" name="country_id">
                                    <option value="">Select a country</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>City *</p>
                                <select id="s_country" name="city_id">
                                    <option value="1">Select a City</option>
                                    {{-- @foreach ($cities as $city)
                                        <option value="2">{{ $city->name }}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                            <div class="col-12">
                                <p>Your Address *</p>
                                <input type="text" name="address">
                            </div>
                            <div class="col-12">
                                <input id="toggle2" type="checkbox" name="shipping_address_status" value="1">
                                <label class="fontsize" for="toggle2">Ship to a different address?</label>
                                <div class="row" id="open2">
                                    <div class="col-12">
                                        <p>Name *</p>
                                        <input type="text" name="shipping_name">
                                    </div>
                                    <div class="col-12">
                                        <p>Email Address *</p>
                                        <input type="email" name="shipping_email">
                                    </div>
                                    <div class="col-12">
                                        <p>Phone No. *</p>
                                        <input type="text" name="shipping_phone_number">
                                    </div>
                                    <div class="col-12">
                                        <p>Country *</p>
                                        <select id="s_country"name="shipping_country_id">
                                            <option value="1">Select a country</option>
                                            {{-- @foreach ($countriies as $country)
                                                <option value="2">{{ $country->name }}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <p>City *</p>
                                        <select id="s_country" name="shipping_city_id">
                                            <option value="1">Select a City</option>
                                            {{-- @foreach ($cities as $city)
                                                <option value="2">{{ $city->name }}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <p>Your Address *</p>
                                        <input type="text" name="shipping_address">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <p>Order Notes </p>
                                <textarea name="notes" placeholder="Notes about Your Order, e.g.Special Note for Delivery"></textarea>
                            </div>
                        </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="order-area">
                    <h3>Your Order</h3>
                    <ul class="total-cost">
                        @foreach (cart_items() as $cart_item)
                        <li>{{ $cart_item->product->product_name }}  x  {{ $cart_item->product_quantity }}<span class="pull-right">${{ $cart_item->product->product_price * $cart_item->product_quantity}}</span></li>
                        @endforeach
                        <li>Subtotal <span class="pull-right"><strong>${{ session('cart_sub_total') }}</strong></span></li>
                        <li>Discount <span class="pull-right">${{ session('discount_amount') }}</span></li>
                        <li>Total<span class="pull-right">${{ session('cart_sub_total') - session('discount_amount') }}</span></li>
                    </ul>
                    <ul class="payment-method">
                        <li>
                            <input name="payment_option" type="radio" value="1" checked>
                            <label for="delivery">Cash on Delivery</label>
                        </li>
                        <li>
                            <input name="payment_option" value="2" type="radio">
                            <label for="card">Credit Card</label>
                        </li>
                    </ul>
                    <button type="submit">Place Order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- checkout-area end -->
@endsection

@section('footer_scripts')
    <script>
        $(document).ready(function() {
            $('#country_list_1').select2();
            $('#country_list_1').change(function(){
                var country_id = $(this).val();
                // ajax setup
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // ajax response start
                $.ajax({
                    type : 'GET',
                    url : 'get/city/list/ajax/'+country_id,
                    success : function (data) {
                        console.log(data)
                    }
                });
                // ajax response end
            });
        });
    </script>
@endsection