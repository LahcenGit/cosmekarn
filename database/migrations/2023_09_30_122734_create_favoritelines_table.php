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
        Schema::create('favoritelines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('favorite_id')->nullable();
            $table->unsignedBigInteger('productline_id')->nullable();
            $table->foreign('productline_id')->references('id')->on('productlines')->onDelete('cascade');
            $table->foreign('favorite_id')->references('id')->on('favorites')->onDelete('cascade');
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
        Schema::dropIfExists('favoritelines');
    }
};
