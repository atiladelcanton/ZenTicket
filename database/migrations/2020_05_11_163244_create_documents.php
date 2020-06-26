<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateDocuments extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::dropIfExists('evidences');
            Schema::create(
                'documents',
                function (Blueprint $table) {
                    $table->bigIncrements('id');
                    $table->unsignedBigInteger('ticket_id')->index();
                    $table->foreign('ticket_id')->references('id')
                        ->on('tickets')
                        ->onDelete('cascade');
                    $table->string('extension_document',5)->index();
                    $table->string('name');
                    $table->timestamps();
                }
            );
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
