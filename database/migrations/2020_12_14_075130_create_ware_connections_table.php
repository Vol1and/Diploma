<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWareConnectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ware_connections', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('characteristic_id')->unsigned();
            $table->bigInteger('butch_number_connection_id')->unsigned();
            $table->integer('change');
            $table->foreign('characteristic_id')->references('id')
                ->on('characteristics');
            $table->bigInteger('storage_id')->unsigned()->default(2);
            $table->foreign('butch_number_connection_id')->references('id')
                ->on('butch_number_connections');
            $table->foreign('storage_id')->references('id')
                ->on('storages');
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
        Schema::dropIfExists('ware_connections');
    }
}
