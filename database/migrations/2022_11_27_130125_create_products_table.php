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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('designation');
            $table->longText('short_description')->nullable();
            $table->longText('long_description')->nullable();
            $table->tinyInteger('is_brouillon');
            $table->string('note')->nullable();
            $table->integer('point')->nullable();
            $table->string('slug')->nullable();
            $table->tinyInteger('flug')->nullable();
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
        Schema::dropIfExists('products');
    }
};
