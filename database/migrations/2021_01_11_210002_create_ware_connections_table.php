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
            $table->integer('change');
            $table->foreign('characteristic_id')->references('id')
                ->on('characteristics');
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
