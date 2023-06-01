<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('epay_invoice_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->tinyInteger('status');
            $table->string('delivery_code')->nullable();
            $table->string('wilaya');
            $table->string('commune');
            $table->string('name');
            $table->string('address');
            $table->string('phone');
            $table->string('note')->nullable();
            $table->string('payment_method');
            $table->double('total');
            $table->double('total_f');
            $table->double('value')->nullable();
            $table->double('delivery_cost')->nullable();
            $table->string('code')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('epay_invoice_id')->references('id')->on('epay_invoices')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
