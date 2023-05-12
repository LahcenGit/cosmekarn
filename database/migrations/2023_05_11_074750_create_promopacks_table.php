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
        Schema::create('promopacks', function (Blueprint $table) {
            $table->id();
            $table->string('designation');
            $table->float('price')->nullable();
            $table->float('price_promo')->nullable();
            $table->string('description');
            $table->string('date_debut');
            $table->string('date_fin');
            $table->integer('qte');
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
        Schema::dropIfExists('promopacks');
    }
};
