<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    protected $fillable = ['payment_status'];
    use HasFactory;
    use SoftDeletes;

    public function order_detail() {
        return $this->hasMany('App\Models\Order_detail');
    }
}
