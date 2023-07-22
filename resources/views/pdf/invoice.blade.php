<h1>This is a pdf file</h1>
<p>Order ID: {{ $order_info->id }}</p>
<p>Sub Total: {{ $order_info->sub_total }}</p>
<p>Discount Amount <b>(@if ($order_info->coupon_name == '-')
    No Coupon Used
    @else
    {{ $order_info->coupon_name }}
@endif)</b> : {{ $order_info->discount_amount }}</p>
<p>Total: {{ $order_info->total }}</p>