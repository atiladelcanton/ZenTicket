<?php

namespace App\ProTicket\Services;


use App\ProTicket\Repositories\ModuleRepository;

/**
 * Class ModuloService
 * @package App\ProTicket\Services
 * @version 1.0.0
 */
class ModuloService
{
    /**
     * @var ModuleRepository
     */
    private $moduleRepository;

    /**
     * MenuService constructor.
     * @param ModuleRepository $moduleRepository
     */
    public function __construct(ModuleRepository $moduleRepository)
    {

        $this->moduleRepository = $moduleRepository;
    }

    /**
     * @param $role_id
     * @return \Illuminate\Support\Collection
     */
    public function renderList($role_id)
    {
        $modules = $this->moduleRepository->getByRoleId($role_id);

        return $modules;
    }

    public function renderEdit($id){
        return $this->moduleRepository->renderEdit($id);
    }
    /**
     * @param $prefecture_id
     * @return \Illuminate\Support\Collection
     */
    public function renderWithPermission()
    {
        $modules = $this->moduleRepository->getByUsersIdWithPermissions();
        return $modules;
    }

    /**
     * @param $administratorId
     * @param $permissions
     * @return bool
     */
    public function updatePermissionsAdministrator($administratorId, $permissions)
    {
        return $this->moduleRepository->updatePermissionByAdministrator($administratorId, $permissions);
    }

    /**
     * @param $administratorId
     * @param $permissions
     * @return mixed
     */
    public function createPermissionsAdministrator($administratorId, $permissions)
    {
        return $this->moduleRepository->createPermissionByAdministrator($administratorId, $permissions);
    }

    /**
     * @param $administratorId
     * @return bool
     */
    public function deletePermissionsAdministrator($administratorId)
    {
        return $this->moduleRepository->deletePermissionsAdministrator($administratorId);
    }

    /**
     * Return All Modules
     * @return ModuleRepository[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllModules(){
        return $this->moduleRepository->getAllModules();
    }

    /**
     * Return all modules active
     * @param $user_id
     *
     * @return mixed
     */
    public function getAllModulesActive($user_id){
        return $this->moduleRepository->getAllModulesActive($user_id);
    }

}
