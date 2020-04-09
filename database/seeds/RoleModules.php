<?php

use Illuminate\Database\Seeder;

class RoleModules extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [];
        $modules = DB::table('modules')->get();
        foreach($modules as $module) {
            array_push($permissions, [
                'roles_id' => 1,
                'modules_id' => $module->id,
            ]);

        }
        DB::table('roles_modules')->insert($permissions);
    }
}
