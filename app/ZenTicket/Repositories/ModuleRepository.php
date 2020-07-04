<?php

namespace App\ZenTicket\Repositories;

use App\ZenTicket\Models\Module;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Class ModuleRepository
 * @package App\ZenTicket\Repositories
 * @version 1.0.0
 */
class ModuleRepository
{
    /**
     * @var Module
     */
    private $model;

    /**
     * ModuleRepository constructor.
     * @param Module $module
     */
    public function __construct(Module $module)
    {

        $this->model = $module;
    }

    /**
     * @param $role_id
     * @return Collection
     */
    public function getByRoleId($role_id): Collection
    {
        $role = $this->model->join(
            'roles_modules',
            function ($sql) use ($role_id) {
                $sql->on(
                    'roles_modules.modules_id',
                    '=',
                    'modules.id'
                )
                    ->where(
                        'roles_modules.roles_id',
                        '=',
                        $role_id
                    );
            }
        )
            ->whereNull('parent_id')
            ->select(
                'modules.id',
                'modules.name',
                'modules.slug',
                'modules.icon'
            )

            ->orderBy('modules.name', 'ASC')
            ->get();

        return $role;
    }

    /**
     * @param $user_id
     * @return Collection
     */
    public function getByUsersIdWithPermissions(): Collection
    {
        return $this->model->join(
            'roles_modules',
            function ($sql) {
                $sql->on(
                    'roles_modules.modules_id',
                    '=',
                    'modules.id'
                );
            }
        )
            ->select('modules.id', 'modules.name', 'modules.slug')
            ->orderBy('modules.name', 'ASC')
            ->with('permissions')
            ->get();
    }

    /**
     * @param $administratorId
     * @param $permissions
     * @return bool
     */
    public function updatePermissionByAdministrator($administratorId, $permissions)
    {
        $permissionsUpdate = $this->mapPermissions($administratorId, $permissions);

        DB::table('permission_role')->where('role_id', $administratorId)->delete();

        DB::table('permission_role')->insert($permissionsUpdate);
        $ids = [];
        foreach ($permissions as $key => $value) {
            array_push($ids, $key);
        }
        $modules_id = DB::table('permissions')->whereIn('id', $ids)->pluck('modules_id')->toArray();
        $modules_id = array_unique($modules_id);
        DB::table('roles_modules')->where('roles_id', $administratorId)->delete();
        foreach ($modules_id as $key => $value) {
            DB::table('roles_modules')->insert([
                'roles_id' => $administratorId,
                'modules_id' => $value,
            ]);
        }
        return true;
    }

    /**
     * @param $administratorId
     * @param array $permissions
     * @return array
     */
    private function mapPermissions($administratorId, array $permissions)
    {
        $permissionsUpdate = [];
        foreach ($permissions as $permission => $value) {
            $permissionsUpdate[] = [
                'role_id' => (int) $administratorId,
                'permission_id' => $permission,
                'value' => 1,
            ];
        }

        return $permissionsUpdate;
    }

    /**
     * @param $administratorId
     * @param $permissions
     * @return bool
     */
    public function createPermissionByAdministrator($administratorId, $permissions)
    {
        $permissionsUpdate = $this->mapPermissions($administratorId, $permissions);

        DB::table('permission_role')->insert($permissionsUpdate);
        $ids = [];
        foreach ($permissions as $key => $value) {
            array_push($ids, $key);
        }
        $modules_id = DB::table('permissions')->whereIn('id', $ids)->pluck('modules_id')->toArray();
        $modules_id = array_unique($modules_id);

        foreach ($modules_id as $key => $value) {
            DB::table('roles_modules')->insert([
                'roles_id' => $administratorId,
                'modules_id' => $value,
            ]);
        }
        return true;
    }

    public function renderEdit($id)
    {
        return $this->model->find($id);
    }
    /**
     * @param $administratorId
     * @return bool
     */
    public function deletePermissionsAdministrator($administratorId)
    {
        DB::table('permission_role')->where('user_id', $administratorId)->delete();
        return true;
    }

    public function getAllModules()
    {
        return $this->model->all();
    }

    public function getAllModulesActive($user_id)
    {

        return $this->model->join(
            'permission_role',
            function ($sql) use ($user_id) {
                $sql->on(
                    'permission_role.modules_id',
                    '=',
                    'modules.id'
                )
                    ->where(
                        'permission_role.role_id',
                        '=',
                        $user_id
                    );
            }
        )->where('modules.status', 1)
            ->select(
                'modules.id',
                'modules.name',
                'modules.slug',
                'modules.icon'
            )
            ->orderBy('modules.name', 'ASC')
            ->get();
    }
}
