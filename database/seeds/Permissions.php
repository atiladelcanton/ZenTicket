<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Permissions extends Seeder
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
                'modules_id' => $module->id,
                'name' => $module->slug . '.index',
                'readable_name' => $module->name . ' Listar',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            array_push($permissions, [
                'modules_id' => $module->id,
                'name' => $module->slug . '.create',
                'readable_name' => $module->name . ' Criar',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            array_push($permissions, [
                'modules_id' => $module->id,
                'name' => $module->slug . '.edit',
                'readable_name' => $module->name . ' Editar',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            array_push($permissions, [
                'modules_id' => $module->id,
                'name' => $module->slug . '.show',
                'readable_name' => $module->name . ' Visualizar',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            array_push($permissions, [
                'modules_id' => $module->id,
                'name' => $module->slug . '.destroy',
                'readable_name' => $module->name . ' Excluir',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }

        DB::table('permissions')->insert($permissions);
    }
}
