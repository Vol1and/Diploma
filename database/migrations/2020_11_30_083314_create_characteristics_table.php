<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharacteristicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characteristics', function (Blueprint $table) {
            $table->id();
            $table->string('serial');
            $table->date('expiry_date');
            $table->bigInteger('nomenclature_id')->unsigned();
            $table->bigInteger('characteristic_price_id')->unsigned();

            $table->foreign('nomenclature_id')->references('id')
                ->on('nomenclatures');
            $table->foreign('characteristic_price_id')->references('id')
                ->on('characteristic_prices');

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
        Schema::dropIfExists('characteristics');
    }
}
