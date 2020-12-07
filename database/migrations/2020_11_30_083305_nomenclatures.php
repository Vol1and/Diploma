<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Nomenclatures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nomenclatures', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->integer('producer_id')->unsigned();
            $table->integer('price_type_id')->unsigned();

            $table->foreign('producer_id')->references('id')
                ->on('producers');

            $table->foreign('price_type_id')->references('id')
                ->on('price_types');


            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nomenclatures');
    }
}
