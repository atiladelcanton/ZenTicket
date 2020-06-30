<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDocumetsOccurrences extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_occurrences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('occurence_id')->index();
            $table->foreign('occurence_id')->references('id')
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
        Schema::dropIfExists('document_occurrences');
    }
}
