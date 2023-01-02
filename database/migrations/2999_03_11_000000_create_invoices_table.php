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
        Schema::create('epay_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->nullable();
            $table->tinyText('client_name');
            $table->tinyText('client_email');
            $table->integer('amount');
            $table->integer('discount');
            $table->string('fee')->nullable();
            $table->string('due_amount')->nullable();
            $table->string('mode');
            $table->string('description');
            $table->string('back_url');
            $table->string('invoice_token')->nullable();
            $table->string('checkout_url')->nullable();
            $table->boolean('paid')->default(0);
            $table->foreignId('user_id')->nullable()->constrained();
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
        Schema::dropIfExists('epay_invoices');
    }
};
