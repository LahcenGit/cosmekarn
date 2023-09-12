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
        Schema::create('couponcodes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('code');
            $table->tinyInteger('type');
            $table->double('value');
            $table->tinyInteger('free_delivery')->nullable();
            $table->string('expiration_date')->nullable();
            $table->double('minimum_spend')->nullable();
            $table->double('maximum_spend')->nullable();
            $table->json('products')->nullable();
            $table->json('exclude_products')->nullable();
            $table->json('categories')->nullable();
            $table->json('exclude_categories')->nullable();
            $table->tinyInteger('exclude_promo_product')->nullable();
            $table->tinyInteger('individual_use')->nullable();
            $table->integer('usage_limit_code')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('couponcodes');
    }
};
