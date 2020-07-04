<?php

namespace App\ZenTicket\Services;

use App\ZenTicket\Repositories\RoleRepository;

/**
 * Class RoleService
 * @package App\eCidade\Services
 * @version 1.0.0
 */
class RoleService
{
    /**
     * @var RoleRepository
     */
    private $repository;
    /**
     * @var ModuloService
     */
    private $moduleService;

    /**
     * MenuService constructor.
     * @param RoleRepository $roleRepository
     * @param ModuloService $moduloService
     */
    public function __construct(RoleRepository $roleRepository, ModuloService $moduloService)
    {
        $this->repository = $roleRepository;
        $this->moduleService = $moduloService;
    }

    /**
     * returns an array of data from all Roles
     *
     * @return mixed
     */
    public function renderList()
    {
        return $this->repository->getAll();
    }

    /**
     * returns data from a role by its ID
     *
     * @param $id
     * @return mixed
     */
    public function renderEdit($id)
    {
        $role = $this->repository->getById($id);

        $permissions = $role->permissions()->pluck('id', 'id')->toArray();

        return [
            'role' => $role,
            'permissions' => $permissions
        ];
    }

    /**
     * update a role's data by its ID
     *
     * @param $id
     * @param $data
     * @return mixed
     */
    public function buildUpdate($id, $data)
    {
        $this->repository->update($id, $data);

        return $this->moduleService->updatePermissionsAdministrator($id, $data['permissions']);
    }

    /**
     * inserts a new role
     *
     * @param $data
     * @return mixed
     */
    public function buildInsert($data)
    {
        $role = $this->repository->create($data);
        return $this->moduleService->createPermissionsAdministrator($role->id, $data['permissions']);
    }

    /**
     * delete a role by its id
     *
     * @param $id
     * @return mixed
     */
    public function buildDelete($id)
    {
        return $this->repository->delete($id);
    }
}
