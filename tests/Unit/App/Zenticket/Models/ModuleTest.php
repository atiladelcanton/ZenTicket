<?php

namespace Tests\Unit\App\Zenticket\Models;

use App\ZenTicket\Models\Module;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\TestCase;
use Tests\Unit\ModelTestCase;

class ModuleTest extends ModelTestCase
{
    use RefreshDatabase;

    protected function model(): Model
    {
        return new Module();
    }

    protected function traits(): array
    {
        return [];
    }

    protected function fillables(): array
    {
        return [
            "name", "slug", "icon", "parent_id"
        ];
    }

    protected function casts(): array
    {
       return [
            "id"=>'string'
        ];
    }

    public function testHasPermissions()
    {
        $module = factory(Module::class)->create();
        $permissions=[];
        $permissions[] = [
            'modules_id' => $module->id,
            'name' => $module->slug . '.index',
            'readable_name' => $module->name . ' Listar',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $permissions[] = [
            'modules_id' => $module->id,
            'name' => $module->slug . '.create',
            'readable_name' => $module->name . ' Criar',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $permissions[] = [
            'modules_id' => $module->id,
            'name' => $module->slug . '.edit',
            'readable_name' => $module->name . ' Editar',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $permissions[] = [
            'modules_id' => $module->id,
            'name' => $module->slug . '.show',
            'readable_name' => $module->name . ' Visualizar',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $permissions[] = [
            'modules_id' => $module->id,
            'name' => $module->slug . '.destroy',
            'readable_name' => $module->name . ' Excluir',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];


        DB::table('permissions')->insert($permissions);
        $module->refresh();

        $this->assertGreaterThan(1,count($module->permissions));
    }
}
