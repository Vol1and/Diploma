<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStorageDocumentTableRowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storage_document_table_rows', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('characteristic_id')->unsigned();
            $table->bigInteger('storage_document_id')->unsigned();
            $table->bigInteger('ware_connection_id')->unsigned()->default(1);
            $table->integer('count');
            $table->decimal('price');
            $table->foreign('characteristic_id')->references('id')
                ->on('characteristics');
            $table->foreign('storage_document_id')->references('id')
                ->on('storage_documents');
            $table->foreign('ware_connection_id')->references('id')
                ->on('ware_connections');
            //вычисляемый столбец
            $table->double('sum')->virtualAs('count * price')->nullable();
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
        Schema::dropIfExists('storage_document_table_rows');
    }
}
