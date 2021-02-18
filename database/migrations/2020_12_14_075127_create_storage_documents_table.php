<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStorageDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storage_documents', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date');
            $table->boolean('is_set');
            $table->bigInteger('doc_type_id')->unsigned();
            $table->bigInteger('source_storage_id')->unsigned();
            $table->bigInteger('destination_storage_id')->unsigned();
            $table->foreign('doc_type_id')->references('id')
                ->on('doc_types');

            $table->foreign('source_storage_id')->references('id')
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
        Schema::dropIfExists('storage_documents');
    }
}
