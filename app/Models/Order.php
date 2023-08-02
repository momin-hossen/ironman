<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'sub_total',
        'discount_amount',
        'coupon_name',
        'total',
        'payment_option',
        'billing_id',
        'shipping_id',
        'payment_stutas',
    ];

    public function order_detail() {
        return $this->hasMany('App\Models\Order_detail');
    }
}
