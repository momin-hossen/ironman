<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->float('sub_total');
            $table->float('discount_amount')->default(0);
            $table->string('coupon_name'); 
            $table->float('total');
            $table->integer('payment_option');
            $table->integer('billing_id');
            $table->integer('shipping_id');
            $table->integer('payment_stutas')->default(1);
            $table->timestamps();
            $table->softDeletes();

            // payment_status name a kono field oi create koros nai, to oi filed a data insert hobe kmne?
            // taile mone hoy ata payment option hobe
            // Field create korsos 1ta instert kortasoso arekta te.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
