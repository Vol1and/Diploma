<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinanceDocumentTableRowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finance_document_table_rows', function (Blueprint $table) {
            $table->id();
            $table->integer('table_id')->unsigned();
            $table->bigInteger('characteristic_id')->unsigned();
            $table->bigInteger('document_id')->unsigned();
            $table->integer('count');
            $table->decimal('price');
            $table->foreign('characteristic_id')->references('id')
                ->on('characteristics');
            $table->foreign('document_id')->references('id')
                ->on('finance_documents');
            //вычисляемый столбец
            $table->double('income_sum')->virtualAs('count * price')->nullable();
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
        Schema::dropIfExists('finance_document_table_rows');
    }
}
