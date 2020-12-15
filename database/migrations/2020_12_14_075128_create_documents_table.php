<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->bigInteger('doc_type_id')->unsigned();
            $table->bigInteger('agent_id')->unsigned();
            $table->foreign('doc_type_id')->references('id')
                ->on('doc_types');
            $table->foreign('agent_id')->references('id')
                ->on('agents');
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
        Schema::dropIfExists('documents');
    }
}