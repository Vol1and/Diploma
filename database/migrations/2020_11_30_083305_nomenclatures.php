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
            $table->id();

            $table->string('name');
            $table->bigInteger('producer_id')->unsigned();
            $table->bigInteger('price_type_id')->unsigned();
            $table->bigInteger('med_form_id')->unsigned();

            $table->foreign('producer_id')->references('id')
                ->on('producers');

            $table->foreign('price_type_id')->references('id')
                ->on('price_types');

            $table->foreign('med_form_id')->references('id')
                ->on('med_forms');


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
