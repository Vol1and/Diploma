<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinanceDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finance_documents', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date');
            $table->boolean('is_set');
            $table->bigInteger('doc_type_id')->unsigned();
            $table->bigInteger('agent_id')->unsigned()->default(1);
            $table->bigInteger('storage_id')->unsigned();
            $table->foreign('doc_type_id')->references('id')
                ->on('doc_types');

            $table->foreign('agent_id')->references('id')
                ->on('agents');
            $table->foreign('storage_id')->references('id')
                ->on('storages');
            $table->bigInteger('doc_sum')->default(0);
            $table->text('comment')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('finance_documents');
    }
}
