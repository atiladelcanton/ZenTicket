<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissionAdministrator = [];
        $permissions = DB::table('permissions')->get();
        foreach($permissions as $permission) {
            array_push($permissionAdministrator, [
                'role_id' => 1,
                'permission_id' => $permission->id,
                'value' => 1
            ]);
        }

        DB::table('permission_role')->insert($permissionAdministrator);
    }
}
