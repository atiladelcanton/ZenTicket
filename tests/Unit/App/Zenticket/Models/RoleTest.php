<?php

namespace Tests\Unit\App\Zenticket\Models;


use Tests\Unit\ModelTestCase;
use App\ZenTicket\Models\Role;
use App\ZenTicket\Models\Module;
use Illuminate\Support\Facades\DB;
use App\ZenTicket\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Artesaos\Defender\Permission as DefenderPermission;

class RoleTest extends ModelTestCase {

    protected function model(): Model {
        return new Role();
    }

    protected function traits(): array {
        return [];
    }

    protected function fillables(): array {
        return [
            'type',
            'name'
        ];
    }

    protected function casts(): array {
        return [
            'id' => 'int'
        ];
    }
    public function testHasPermissions(){
        $role = factory(Role::class)->create();

        $module = factory(Module::class)->create();
        $permission = Permission::create([
            'modules_id' => $module->id,
            'name' => $module->slug . '.index',
            'readable_name' => $module->name . ' Listar',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('permission_role')->insert(['permission_id'=>$permission->id,'role_id'=>$role->id]);
        $role->refresh();
        $this->assertInstanceOf(DefenderPermission::class,$role->permissions[0]);
    }
}
