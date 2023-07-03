<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $guarded = [];

    public function onetoonerelationwithcategorytable(){
        return $this->hasOne('App\Models\Category', 'id', 'category_id');
    }
}
