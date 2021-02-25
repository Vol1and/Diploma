<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkplaceDocumentConnectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workplace_document_connections', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('workplace_id')->unsigned();
            $table->bigInteger('document_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();

            $table->foreign('workplace_id')->references('id')
                ->on('workplaces');
            $table->foreign('document_id')->references('id')
                ->on('finance_documents');
            $table->foreign('user_id')->references('id')
                ->on('users');
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
        Schema::dropIfExists('workplace_document_connections');
    }
}
