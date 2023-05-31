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
        Schema::create('deliverycosts', function (Blueprint $table) {
            $table->id();
            $table->string('wilaya');
            $table->string('commune');
            $table->string('extention');
            $table->float('price_b');
            $table->float('price_a');
            $table->float('supp');
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
        Schema::dropIfExists('deliverycosts');
    }
};
