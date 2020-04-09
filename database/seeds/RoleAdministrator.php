<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleAdministrator extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_user')->insert(['user_id' => 1 , 'role_id' => 1]);
    }
}
