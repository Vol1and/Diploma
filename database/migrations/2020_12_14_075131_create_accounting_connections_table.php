<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountingConnectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_connections', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date');
            $table->integer('change');
            $table->bigInteger('document_id')->unsigned();
            $table->foreign('document_id')->references('id')
                ->on('finance_documents');
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
        Schema::dropIfExists('accounting_connections');
    }
}
