<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateEvidences extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create(
                'evidences',
                function (Blueprint $table) {
                    $table->bigIncrements('id');
                    $table->enum('type', ['OC', 'TCT'])->comment('OC - Ocorrencias , TCT - Ticket');
                    $table->unsignedBigInteger('ticket_id')->index();
                    $table->string('path');
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
            Schema::dropIfExists('evidences');
        }
    }
