<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesModules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles_modules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('roles_id');
            $table->index('roles_id');
          //  $table->foreign('roles_id')->references('id')->on('roles')->onDelete('cascade');

            $table->integer('modules_id');
            $table->index('modules_id');
          //  $table->foreign('modules_id')->references('id')->on('modules')->onDelete('cascade');

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
        Schema::dropIfExists('roles_modules');
    }
}
