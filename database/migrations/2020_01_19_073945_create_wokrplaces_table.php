<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWokrplacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wokrplaces', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('is_opened');
            $table->dateTime('last_access');
            $table->bigInteger('storage_id')->unsigned();
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
        Schema::dropIfExists('wokrplaces');
    }
}
