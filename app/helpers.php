<?php
function total_product_count(){
    echo App\Models\Product::count();
}