<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function onetoonerelationwithcategorytable(){
        return $this->hasOne('App\Models\Category', 'id', 'category_id');
    }

    public function onetomanyrelationwithproductimagetable() {
        return $this->hasMany('App\Models\Product_image', 'product_id', 'id');
    }
}
