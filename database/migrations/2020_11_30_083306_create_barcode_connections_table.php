<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarcodeConnectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barcode_connections', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('barcode_id')->unsigned();
            $table->bigInteger('nomenclature_id')->unsigned();

            $table->foreign('barcode_id')->references('id')
                ->on('barcodes');
            $table->foreign('nomenclature_id')->references('id')
                ->on('nomenclatures');
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
        Schema::dropIfExists('barcode_connections');
    }
}
