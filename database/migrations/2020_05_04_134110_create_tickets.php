<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateTickets extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create(
                'tickets',
                function (Blueprint $table) {
                    $table->bigIncrements('id');
                    $table->unsignedBigInteger('sub_ticket_id')->index();
                    $table->unsignedBigInteger('type_id')->index();
                    $table->unsignedBigInteger('project_id')->index();
                    $table->unsignedBigInteger('user_open_ticket')->index();
                    $table->unsignedBigInteger('priority_id')->index();
                    $table->unsignedBigInteger('role_id')->index();
                    $table->unsignedBigInteger('impact_id')->index();
                    $table->enum('status', ['E', 'T', 'P', 'AC', 'ARC', 'AE', 'C'])->comment('
                                    E - Em Espera
                                    T - Em Tratamento
                                    P - Pausado
                                    AC - Aguardando Cliente
                                    AE - Aguardando Evidencia
                                    AT - Aguardando T.I
                                    ATRA - Atrasado
                                    C - Conclúido
                        ')->index();
                    $table->unsignedBigInteger('responsible_ticket')->index();
                    $table->string('ticket_number')->index();
                    $table->string('title');
                    $table->longText('description');
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
            Schema::dropIfExists('tickets');
        }
    }
