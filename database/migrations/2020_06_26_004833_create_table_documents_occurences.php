<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDocumentsOccurences extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_documents_occurences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('occurences_id')->index();
            $table->foreign('occurences_id')->references('id')
                ->on('occurences')
                ->onDelete('cascade');
            $table->string('extension_document', 5)->index();
            $table->string('name');
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
        Schema::dropIfExists('table_documents_occurences');
    }
}
