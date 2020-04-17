<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDefenderRoleUserTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create(config('defender.role_user_table', 'role_user'), function (Blueprint $table) {
            $table->unsignedInteger('user_id')->index();


            $table->unsignedInteger(config('defender.role_key', 'role_id'))->index();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table(config('defender.role_user_table', 'role_user'), function (Blueprint $table) {
            if (DB::getDriverName() !== 'sqlite') {
                $table->dropForeign(config('defender.role_user_table', 'role_user').'_user_id_foreign');
                $table->dropForeign(config('defender.role_user_table', 'role_user').'_'.config('defender.role_key', 'role_id').'_foreign');
            }
        });

        Schema::drop(config('defender.role_user_table', 'role_user'));
    }
}
