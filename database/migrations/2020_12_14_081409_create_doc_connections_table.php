<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocConnectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doc_connections', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('characteristic_id')->unsigned();
            $table->bigInteger('document_id')->unsigned();
            $table->integer('amount');
            $table->decimal('price');
            $table->foreign('characteristic_id')->references('id')
                ->on('characteristics');
            $table->foreign('document_id')->references('id')
                ->on('documents');
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
        Schema::dropIfExists('doc_connections');
    }
}