<?php

namespace Tests\Unit\App\Zenticket\Models;

use Artesaos\Defender\Role;
use Tests\Unit\ModelTestCase;
use App\ZenTicket\Models\User;
use PHPUnit\Framework\TestCase;
use App\ZenTicket\Models\Module;
use Illuminate\Support\Facades\DB;
use App\ZenTicket\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use App\ZenTicket\Models\Role as ModelRole;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PermissionTest extends ModelTestCase
{
    use RefreshDatabase;
    protected function model(): Model {
        return new Permission();
    }

    protected function traits(): array {
        return [];
    }

    protected function fillables(): array {
        return [
            'name',
            'readable_name',
            'modules_id',
        ];
    }

    protected function casts(): array {
        return [
            'id' => 'int'
        ];
    }

    public function testHasRole(){
        $role = factory(ModelRole::class)->create();

        $module = factory(Module::class)->create();
        $permission = Permission::create([
            'modules_id' => $module->id,
            'name' => $module->slug . '.index',
            'readable_name' => $module->name . ' Listar',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('permission_role')->insert(['permission_id'=>$permission->id,'role_id'=>$role->id]);
        $permission->refresh();

        $this->assertInstanceOf(Role::class,$permission->roles[0]);
    }
    public function testHasUser(){
        $role = factory(ModelRole::class)->create();
        $user = factory(User::class)->create();
        $user->roles()->save($role);
        $user->refresh();
        $module = factory(Module::class)->create();
        $permission = Permission::create([
            'modules_id' => $module->id,
            'name' => $module->slug . '.index',
            'readable_name' => $module->name . ' Listar',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('permission_user')->insert(['permission_id'=>$permission->id,'user_id'=>$user->id]);
        $permission->refresh();
        $this->assertInstanceOf(User::class,$permission->users[0]);
    }
}
