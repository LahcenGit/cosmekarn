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
        Schema::create('productlines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('attributeline_id')->nullable();
            $table->unsignedBigInteger('attribute_id')->nullable();
            $table->integer('price')->nullable();
            $table->integer('promo_price')->nullable();
            $table->integer('qte')->nullable();
            $table->float('weight')->nullable();
            $table->string('dimension')->nullable();
            $table->string('status')->nullable();
            $table->string('attribute_image')->nullable();
            $table->string('attribute_icone')->nullable();
            $table->string('slug')->nullable();
            $table->string('flug')->nullable();
            $table->string('bare_code')->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('attributeline_id')->references('id')->on('attributelines')->onDelete('cascade');
            $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');
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
        Schema::dropIfExists('productlines');
    }
};
